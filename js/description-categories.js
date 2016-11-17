//retreive all regions


var info = {
    type: "retreiveCategories"
};

$.ajax({
    url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    dataType: 'json',
    success: function (data) {

        console.log('data' + data);
        $.each(data, function (i, item) {

            $('#categories').append($('<option>', {
                value: item.code,
                text: item.name
            }));
        });

    }
});



getUnAssignedDescription();

function getUnAssignedDescription() {
    var infotype = {
        type: 'retreiveUnAssignedDescription'
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




$('#saveCategoryDescriptionForm').on('submit', function (e) {
    e.preventDefault();


    var formData = $(this).serialize();
    console.log(formData);

    $('input:submit').attr("disabled", true);

    $.ajax({
        url: '../controllers/pairCategoryDescriptionsController.php?_=' + new Date().getTime(),
        type: "POST",
        data: formData,
        dataType: 'json',
        success: function (data) {

            console.log(data);
            $('input:submit').attr("disabled", false);

            $('#descriptionCategoryModal').modal('hide');
            var successStatus = data.success;

            document.getElementById("saveCategoryDescriptionForm").reset();

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
                $('#categories').select2("destroy");
                $('#categories').select2();

                $('#descriptions').select2("val", "destroy");
                $('#descriptions').select2();
                $('#descriptions').html("");

                getCategoryDescriptions();
                getUnAssignedDescription();

            }
//            
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });




});


//regionDistrictTbl

var datatable = $('#categoryDescriptionsTbl').DataTable({
    responsive: true,
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    },
    order: [[0, "asc"]]
});

getCategoryDescriptions();

function getCategoryDescriptions()
{

    var info = {
        type: "retreiveCategoryDescriptions"
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
                    r[++j] = '<td>' + value.category_name + '</td>';
                    r[++j] = '<td>' + value.description_name + '</td>';
                    r[++j] = '<td><button onclick="deleteDescriptionCategory(\'' + value.code + '\',\'' + value.title + '\')" class="btn btn-outline-danger btn-sm" type="button">Delete</button></td>';

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

function deleteDescriptionCategory(code) {
    console.log(code);
    $('#code').val(code);
    $('#confirmModal').modal('show');
}

$('#deleteDescriptionCategoryForm').on('submit', function (e) {
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
            document.getElementById("deleteDescriptionCategoryForm").reset();

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
                $('#descriptions').select2("val", "");
                $('#descriptions').select2();
                $('#descriptions').html("");

                
                getUnAssignedDescription();
                getCategoryDescriptions();

            }
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });

});
