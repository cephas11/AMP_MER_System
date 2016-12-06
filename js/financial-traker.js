/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var datatable = $('#beneficiaresListTbl').DataTable();

datatable.columns([0, 11, 12, 13, 14, 15, 16, 17, 18, 19]).visible(false, false);
datatable.columns.adjust().draw(false); // adjust column sizing and redraw

getAllBeneficiaries();
function getAllBeneficiaries()
{

    var info = {
        type: "retreiveBeneficiariesList"
    };
    $.ajax({
        url: '../controllers/BeneficiaryController.php?_=' + new Date().getTime(),
        type: "GET",
        data: info,
        success: function (data) {


            datatable.clear().draw();
            var obj = jQuery.parseJSON(data);
            if (obj.length == 0) {
                console.log("NO DATA!");
            } else {

                var rowNum = 0;
                $.each(obj, function (key, value) {
                    var j = -1;
                    var r = new Array();
                    r[++j] = '<td>' + value.code + '</td>';
                    r[++j] = '<td lass="beneficiary-name">' + value.name + '</td>';
                    r[++j] = '<td>' + value.business_name + '</td>';
                    r[++j] = '<td>' + value.gender + '</td>';
                    r[++j] = '<td>' + value.email + '</td>';
                    r[++j] = '<td>' + value.contactno + '</td>';
                    r[++j] = '<td>' + value.fiscalyear + '</td>';
                    r[++j] = '<td>' + value.category_name + '</td>';
                    r[++j] = '<td>' + value.description_name + '</td>';
                    r[++j] = '<td>' + value.region_name + '</td>';
                    r[++j] = '<td>' + value.district_name + '</td>';
                    r[++j] = '<td>' + value.community + '</td>';
                    r[++j] = '<td>' + value.longitude + '</td>';
                    r[++j] = '<td>' + value.latitude + '</td>';
                    r[++j] = '<td>' + value.dateregistered + '</td>';
                    r[++j] = '<td>' + value.registeredby + '</td>';
                    r[++j] = '<td>' + value.createdby + '</td>';
                    r[++j] = '<td>' + value.datecreated + '</td>';
                    r[++j] = '<td>' + value.modon + '</td>';
                    r[++j] = '<td>' + value.modby + '</td>';
                    r[++j] = '<td><a  href="beneficiary-financial-services-tracker?code='+value.code+'" class="btn btn-outline-info btn-sm btn-edit"><i class="fa fa-eye""></i><span class="hidden-md hidden-sm hidden-xs">View </span></a></td>';

                    rowNum = rowNum + 1;


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
