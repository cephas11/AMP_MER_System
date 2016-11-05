//retreive all regions


var info = {
    type: "retreiveCategories"
};

$.ajax({
    url: '../controllers/ConfigurationController.php',
    type: "GET",
    data: info,
    dataType: 'json',
    success: function (data) {

      
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
        url: '../controllers/ConfigurationController.php',
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
        url: '../controllers/ConfigurationController.php',
        type: "GET",
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
                $('#categories').select2("");

                $('#descriptions').select2("destroy");
                $('#descriptions').select2("");
                getCategoryDescriptions();
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
                    r[++j] = '<td>' + value.category_name + '</td>';
                    r[++j] = '<td>' + value.description_name + '</td>';
                    r[++j] = '<td><button onclick="deleteRegion(\'' + value.code + '\',\'' + value.title + '\')" class="btn btn-outline-danger btn-sm" type="button">Delete</button></td>';

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
