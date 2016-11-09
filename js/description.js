var datatable = $('#descriptionTbl').DataTable({
    responsive: true,
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    },
    order: [[0, "asc"]]
});


$('#saveDescriptionForm').on('submit', function (e) {
    e.preventDefault();
    // var validator = $("#saveRegionForm").validate();
   $('input:submit').attr("disabled", true);
    var formData = $(this).serialize();
    console.log(formData);
         
       
        $.ajax({
            url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
            type: "GET",
            data: formData,
            dataType: "json",
            success: function (data) {
                // $("#loader").hide();
                      $('input:submit').attr("disabled", false);
                $('#descriptionModal').modal('hide');
                var successStatus = data.success;
                document.getElementById("saveDescriptionForm").reset();

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
                    getDescription();
                }
            },
            error: function (jXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

    


});
getDescription();
function getDescription()
{

    var info = {
        type: "retreiveDescription"
    };


    $.ajax({
        url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
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
                              <button onclick="deleteDistrict(\'' + value.code + '\',\'' + value.name +'\')" class="btn btn-outline-danger btn-sm" type="button">Delete</button></td>';

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


