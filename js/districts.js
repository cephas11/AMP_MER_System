/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



//save region


$('#saveDistrictForm').on('submit', function (e) {
    e.preventDefault();
    // var validator = $("#saveRegionForm").validate();
    var district = $('#district').val();
    var formData = $(this).serialize();
    console.log(formData);
    if (district == "") {

        alert('field is required');
    } else {
        $('input:submit').attr("disabled", true);
        $.ajax({
            url: '../controllers/ConfigurationController.php',
            type: "GET",
            data: formData,
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#districtModal').modal('hide');
                var successStatus = data.success;

                document.getElementById("saveDistrictForm").reset();

                if (successStatus == 1) {
                    $('input:submit').attr("disabled", false);
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
                    getDistricts();
                }
            },
            error: function (jXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

    }


});

//retreive regions

var datatable = $('#districtTbl').DataTable({
    responsive: true,
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    },
    order: [[0, "asc"]]
});

getDistricts();

function getDistricts()
{

    var info = {
        type: "retreiveDistrict"
    };


    $.ajax({
        url: '../controllers/ConfigurationController.php',
        type: "GET",
        data: info,
        success: function (data) {

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
                    r[++j] = '<td><button onclick="editDistrict(\'' + value.code + '\',\'' + value.name + '\')" class="btn btn-outline-info btn-sm" type="button">Edit</button>\n\
                              <button onclick="deleteDistrict(\'' + value.code + '\',\'' + value.name + '\')" class="btn btn-outline-danger btn-sm" type="button">Delete</button></td>';

                    rowNode = datatable.row.add(r);
                });

                rowNode.draw().node();
            }

        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}






