/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//var datatable = $('#beneficiaresListTbl').DataTable({
//    responsive: true,
//    language: {
//        paginate:
//                {previous: "&laquo;", next: "&raquo;"},
//        search: "_INPUT_",
//        searchPlaceholder: "Search…"
//    },
//    order: [[0, "asc"]],
//    "columnDefs": [
//            {
//                "targets": [2],
//                "visible": false,
//                "searchable": false
//            },
//            {
//                "targets": [3],
//                "visible": false
//            }
//        ]
//});

var datatable = $('#beneficiaresListTbl').DataTable();

datatable.columns([0]).visible(false, false);
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
                    r[++j] = '<td>' + value.fiscalyear + '</td>';
                    r[++j] = '<td>' + value.dateregistered + '</td>';
                    r[++j] = '<td>' + value.category_name + '</td>';
                    r[++j] = '<td>' + value.description_name + '</td>';
                    r[++j] = '<td >' + value.name + '</td>';
                    r[++j] = '<td>' + value.business_name + '</td>';
                    r[++j] = '<td>' + value.gender + '</td>';
                    r[++j] = '<td>' + value.region_name + '</td>';
                    r[++j] = '<td>' + value.district_name + '</td>';
                    r[++j] = '<td>' + value.community + '</td>';
                    r[++j] = '<td>' + value.registeredby + '</td>';
                    r[++j] = '<td><button type="button" onclick="editBeneficiary(\'' + value.code + '\')" class="btn btn-outline-info btn-sm  col-sm-6 btn-edit"><i class="fa fa-edit""></i><span class="hidden-md hidden-sm hidden-xs"> </span></</button>\n\
                              <button onclick="deleteBeneficiary(\'' + value.code + '\',\'' + value.name + '\')" class="btn btn-outline-danger btn-sm  col-sm-6 " type="button"><i class="fa fa-trash-o""></i><span class="hidden-md hidden-sm hidden-xs"> </span></</button></td>';

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

function deleteBeneficiary(code, title) {
    console.log(code + title + 'aaaaa');
    $('#code').val(code);
    $('#beneficiaryholder').html(title);
    $('#confirmModal').modal('show');
}


function editBeneficiary() {
    $('#editModal').modal('show');

   // document.getElementById('ecthh').html = this.parentElement.parentElement.getElementsByClassName('beneficiary-name')[0].innerText;

}

$('#deleteBeneficiaryForm').on('submit', function (e) {
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
            document.getElementById("deleteBeneficiaryForm").reset();

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
                getAllBeneficiaries();
            }
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });

});

