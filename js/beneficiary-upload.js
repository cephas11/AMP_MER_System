/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var datatable = $('#beneficiaryTbl').DataTable({
    responsive: true,
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    },
    order: [[0, "asc"]]
});

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

            console.log('server response' + data);
             datatable.clear().draw();
            var obj = jQuery.parseJSON(data);
            if (obj.length == 0) {
                console.log("NO DATA!");
            } else {

                $.each(obj, function (key, value) {
                    var j = -1;
                    var r = new Array();
                   
                     

                     r[++j]= '<td>' + value.fiscalyear + '</td>';
                     r[++j]= '<td>' + value.dateregistered + '</td>';
                     r[++j]= '<td>' + value.name + '</td>';
                     r[++j]= '<td>' + value.business_name + '</td>';
                     r[++j]= '<td>' + value.gender + '</td>';
                     r[++j]= '<td>' + value.email + '</td>';
                     r[++j]= '<td>' + value.contactno + '</td>';
                
                     r[++j]= "<td><select class='form-control region select2'></select></td>";
               
                     r[++j]= "<td><select class='form-control districts  select2'></select></td>";
               
                     r[++j]= "<td><select class='form-control categories   select2'></select></td>";
                 
                     r[++j]= "<td><select class='form-control  description select2'></select></td>";
                    
                     r[++j]= '<td>' + value.community + '</td>';
                     r[++j]= '<td>' + value.longitude + '</td>';
                     r[++j]= '<td>' + value.latitude + '</td>';
                     r[++j]= '<td>' + value.registeredby + '</td>';
                    



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

        $.each(data, function (i, item) {

            $('.categories').append($('<option>', {
                value: item.code,
                text: item.name
            }));
        });

    }
});

}