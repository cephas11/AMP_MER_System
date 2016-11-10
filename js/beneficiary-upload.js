/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


getBneficiaryTempData();
function getBneficiaryTempData()
{

    var info = {
        type: "retreiveBeneficiaryTempData"
    };
    $.ajax({
        url: '../controllers/BeneficiaryController.php?_=' + new Date().getTime(),
        type: "GET",
        data: info,
        success: function (data) {

            console.log('' + data);
            var obj = jQuery.parseJSON(data);
            if (obj.length == 0) {
                console.log("NO DATA!");
            } else {

                $.each(obj, function (key, value) {
                    var trd = "";
                    trd += "<tr>";

                    trd += '<td>' + value.fiscalyear + '</td>';
                    trd += '<td>' + value.dateregistered + '</td>';
                    trd += '<td>' + value.name + '</td>';
                    trd += '<td>' + value.business_name + '</td>';
                    trd += '<td>' + value.gender + '</td>';
                    trd += '<td>' + value.email + '</td>';
                    trd += '<td>' + value.contactno + '</td>';
                    trd += "<td>";
                    trd += "<select class='form-control region select2'></select>";
                    trd += "</td>";
                    trd += "<td>";
                    trd += "<select class='form-control districts  select2'></select>";
                    trd += "</td>";
                    trd += "<td>";
                    trd += "<select class='form-control categories   select2'></select>";
                    trd += "</td>";
                    trd += "<td>";
                    trd += "<select class='form-control  description select2'></select>";
                    trd += "</td>";

                    trd += '<td>' + value.community + '</td>';
                    trd += '<td>' + value.longitude + '</td>';
                    trd += '<td>' + value.latitude + '</td>';
                    trd += '<td>' + value.registeredby + '</td>';
                    trd += "</tr>";



                    $('table#beneficiaryTbl TBODY').append(trd);



                });
            }

        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

getRegions();
function getRegions() {


    var info = {
        type: "retreiveRegion"
    };

    $.ajax({
        url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
        type: "GET",
        data: info,
        dataType: 'json',
        success: function (data) {


            $.each(data, function (i, item) {

                $('.region').append("<option value=" + item.code + ">" + item.name + "</option>"
                        );
            });

        }
    });
}
getCategories();

function getCategories(){
    var info = {
    type: "retreiveCategories"
};

$.ajax({
    url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    dataType: 'json',
    success: function (data) {

      console.log('data'+data);
        $.each(data, function (i, item) {

            $('.categories').append($('<option>', {
                value: item.code,
                text: item.name
            }));
        });

    }
});

}