/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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

            $('#category').append($('<option>', {
                value: item.code,
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

            $('#region').append($('<option>', {
                value: item.code,
                text: item.name
            }));
        });

    }
});

function getDescriptionBasedOnCategory(category_code) {

    var infotype = {
        type: 'retreiveDescriptionBasedOnCategory',
        category_code: category_code
    };

    $.ajax({
        url: '../controllers/BeneficiaryController.php?_=' + new Date().getTime(),
        type: "GET",
        data: infotype,
        dataType: 'json',
        success: function (data) {

            console.log(data);
            $.each(data, function (i, item) {
                $('#description').select2("destroy");
                $('#description').select2("");
                $('#description').append($('<option>', {
                    value: item.description_code,
                    text: item.description_name
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