/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//activityDescriptionsTbl

var datatable = $('#activityDescriptionsTbl').DataTable({
    responsive: true,
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    },
    order: [[0, "asc"]]
});

var info = {
    type: "retreiveActivityTypes"
};

$.ajax({
    url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    dataType: 'json',
    success: function (data) {
        console.log('fff' + data);

        $.each(data, function (i, item) {

            $('#activityType').append($('<option>', {
                value: item.code,
                text: item.name
            }));
        });

    }
});

getUnAssignedDescription();

function getUnAssignedDescription() {
    var infotype = {
        type: 'retreivenassignedActivityDescriptions'
    };
    $.ajax({
        url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
        type: "GET",
        data: infotype,
        dataType: 'json',
        success: function (data) {


            $.each(data, function (i, item) {

                $('#descriptions').append($('<option>', {
                    value: item.code,
                    text: item.name
                }));
            });

        }
    });
}


$('#saveTypeDescriptionForm').on('submit', function (e) {
    e.preventDefault();


    var formData = $(this).serialize();
    console.log(formData);

    $('input:submit').attr("disabled", true);

    $.ajax({
        url: '../controllers/PostController.php?_=' + new Date().getTime(),
        type: "POST",
        data: formData,
        dataType: 'json',
        success: function (data) {

            console.log(data);

            $('#descriptionModal').modal('hide');
            var successStatus = data.success;
            document.getElementById("saveTypeDescriptionForm").reset();

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

                $('#descriptions').select2("val", "");
                $('#descriptions').select2();

                $('#descriptions').html("");

                $('#activityType').select2("destroy");
                $('#activityType').select2("");
                
                getUnAssignedDescription();
                getActivityDescriptions();

            }


        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });




});
getActivityDescriptions();

function getActivityDescriptions()
{

    var info = {
        type: "retreiveActivityDescriptions"
    };
    console.log('new code here');

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
                    r[++j] = '<td data-regioncode="' + value.code + '" data-region="' + value.name + '" class="subject">' + value.type_name + '</td>';
                    r[++j] = '<td data-regioncode="' + value.code + '" data-region="' + value.name + '" class="subject">' + value.description_name + '</td>';

                    r[++j] = '<td> <button onclick="deleteActivityDescription(\'' + value.code + '\')" class="btn btn-outline-danger btn-sm" type="button">Delete</button></td>';

                    rowNode = datatable.row.add(r);
                });

                rowNode.draw().node();
            }

        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown + " " + textStatus + " New Error: " + jXHR);
        }
    });
}


function deleteActivityDescription(code) {
    console.log(code);
    $('#code').val(code);

    $('#confirmModal').modal('show');
}

$('#deleteTypeDescriptionForm').on('submit', function (e) {
    e.preventDefault();
    $('input:submit').attr("disabled", true);
    var formData = $(this).serialize();
    console.log(formData);
    $('#confirmModal').modal('hide');
    $('#loaderModal').modal('show');

    $.ajax({
        url: '../controllers/deleteController.php?_=' + new Date().getTime(),
        type: "POST",
        data: formData,
        dataType: "json",
        success: function (data) {
            // $("#loader").hide();
            $('input:submit').attr("disabled", false);
            $('#loaderModal').modal('hide');
            var successStatus = data.success;
            document.getElementById("deleteTypeDescriptionForm").reset();

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
                };
                 $('#descriptions').select2("val", "");
                $('#descriptions').select2();

                $('#descriptions').html("");
               getUnAssignedDescription();
                getActivityDescriptions();

            }
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });

});


