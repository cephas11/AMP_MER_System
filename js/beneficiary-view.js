/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$('#beneficiaryForm').on('submit', function (e) {
    e.preventDefault();

    var formData = $(this).serialize();
    console.log(formData);
    $('input:submit').attr("disabled", true);
$("#loaderModal").modal('show');

    $.ajax({
        url: '../controllers/PostController.php?_=' + new Date().getTime(),
        type: "POST",
        data: formData,
        dataType: 'json',
        success: function (data) {
            $('input:submit').attr("disabled", false);
            console.log(data);
             $("#loaderModal").modal('hide');

            var successStatus = data.success;
            console.log(successStatus);
            document.getElementById("beneficiaryForm").reset();
            $('#description').select2("destroy");
            $('#description').empty();
            $('#description').select2();
            $('#description').append('<option value = ""> Loading... </option>');

            $('#district').select2("destroy");
            $('#district').empty();
            $('#district').select2();
            $('#district').append('<option value = ""> Loading... </option>');

            $('#region').select2("destroy");
            $('#region').select2();

            $('#gender').select2("destroy");
            $('#gender').select2();

            $('#category').select2("destroy");
            $('#category').select2();

            $('#registeredBy').select2("destroy");
            $('#registeredBy').select2();

            $('#fiscalYear').select2("destroy");
            $('#fiscalYear').select2();

            $('#ownership_type').select2("destroy");
            $('#ownership_type').select2();

            $('#registered_business').select2("destroy");
            $('#registered_business').select2();



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
            }
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });


});


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
            var code = item.shortcode + '-' + item.code;
            $('#category').append($('<option>', {
                value: code,
                text: item.name
            }));
        });

    }
});

var reginfo = {
    type: "retreiveRegion"
};

$.ajax({
    url: '../controllers/ConfigurationController.php',
    type: "GET",
    data: reginfo,
    dataType: 'json',
    success: function (data) {


        $.each(data, function (i, item) {
            var code = item.shortcode + '-' + item.code;

            $('#region').append($('<option>', {
                value: code,
                text: item.name
            }));
        });

    }
});


var reginfo = {
    type: "retreiveRegisters"
};

$.ajax({
    url: '../controllers/ConfigurationController.php',
    type: "GET",
    data: reginfo,
    dataType: 'json',
    success: function (data) {


        $.each(data, function (i, item) {

            $('#registeredBy').append($('<option>', {
                value: item.name,
                text: item.name
            }));
        });

    }
});

function getDescriptionBasedOnCategory(category_code) {
    category_code = category_code.split('-');
    var code = category_code[1];

    var infotype = {
        type: 'retreiveDescriptionBasedOnCategory',
        category_code: code
    };

    $.ajax({
        url: '../controllers/BeneficiaryController.php?_=' + new Date().getTime(),
        type: "GET",
        data: infotype,
        dataType: 'json',
        success: function (data) {

            console.log(data);
            $('#description').select2("destroy");
            $('#description').empty();

            $('#description').select2();
            $('#description').append('<option value = ""> Choose... </option>');


            $.each(data, function (i, item) {

                $('#description').append($('<option>', {
                    value: item.description_code,
                    text: item.description_name
                }));
            });
            $('#description').trigger("chosen:updated");


        }
    });
}

function getDistrictsBasedOnRegion(region_code) {

    region_code = region_code.split('-');
    var code = region_code[1];

    var infotype = {
        type: 'retreiveDistrictsBasedOnRegion',
        region_code: code
    };

    $.ajax({
        url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
        type: "GET",
        data: infotype,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $('#district').select2("destroy");
            $('#district').empty();

            $('#district').select2();
            $('#district').append('<option value = ""> Choose... </option>');


            $.each(data, function (i, item) {

                $('#district').append($('<option>', {
                    value: item.districts_code,
                    text: item.district_name
                }));
            });


        }
    });
}


$("#category").change(function () {
    var category_code = this.value;
    console.log(category_code);

    getDescriptionBasedOnCategory(category_code);
});
$("#region").change(function () {

    var region_code = this.value;
    console.log(region_code);

    getDistrictsBasedOnRegion(region_code);
});