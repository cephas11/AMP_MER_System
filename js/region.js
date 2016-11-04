/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



//save region



$('#saveRegionForm').on('submit', function (e) {
    e.preventDefault();
    // var validator = $("#saveRegionForm").validate();
    var region = $('#region').val();
    var formData = $(this).serialize();
    console.log(formData);
    if (region == "") {

        alert('empty');
    } else {
        var info = {
            region: region
        };
        $.ajax({
            url: '../controllers/ConfigurationController.php',
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (data) {
                console.log(data);
                // $("#loader").hide();
                $('#regionModal').modal('hide');
                var successStatus = data.success;
                document.getElementById("saveRegionForm").reset();

                if (successStatus == 1) {
                    Command: toastr["success"](data.message, "Success");

                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                  getRegions();
                }
            },
            error: function (jXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

    }


});

//retreive regions

var datatable = $('#regionTbl').DataTable({
    responsive: true,
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    },
    order: [[0, "asc"]]
});

getRegions();

function getRegions()
{

    var info = {
        type: "retreiveRegion"
    };
       console.log('new code here');

    $.ajax({
        url: '../controllers/ConfigurationController.php',
        type: "POST",
        data: info,
      
        success: function (data) {
	   // alert(data);
            console.log('new code here');
	    console.log(data);
            datatable.clear().draw();
         
            var obj = jQuery.parseJSON(data);
            console.log('size' + obj.length);
            if (obj.length == 0) {
                console.log("NO DATA!");
            } else {
                $.each(obj, function (key, value) {


                    var j = -1;
                    var r = new Array();
                    // represent columns as array
                    r[++j] = '<td class="subject">' + value.name + '</td>';
                    r[++j] = '<td><button onclick="editRegion(\'' + value.code + '\',\'' + value.name + '\')" class="btn btn-outline-info btn-sm" type="button">Edit</button>\n\
                              <button onclick="deleteRegion(\'' + value.code + '\',\'' + value.title +'\')" class="btn btn-outline-danger btn-sm" type="button">Delete</button></td>';

                    rowNode = datatable.row.add(r);
                });

                rowNode.draw().node();
            }

        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown +" "+textStatus+" New Error: "+jXHR );
        }
    });
}







