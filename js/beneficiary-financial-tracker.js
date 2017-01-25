/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




var datatable = $('#amountTbl').DataTable({
    responsive: true,
    dom: 'Bfrtip',
    buttons: [
        'copyHtml5',
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5'
    ],
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    },
    order: [[0, "asc"]]


});


var datatable = $('#financialTbl').DataTable({
    responsive: true,
    dom: 'Bfrtip',
    buttons: [
        'copyHtml5',
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5'
    ],
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    },
    order: [[0, "asc"]]


});


$("#financialType").change(function () {
    var selectedval = this.value;
    console.log(selectedval);
    if (selectedval == 'Grant') {
        $('.loan').removeAttr('required');

        $('.grant').attr('required', 'required');

        $('#grant').show();
        $('#loan').hide();
    } else if (selectedval == 'Loan') {
        $('.grant').removeAttr('required');
        $('.loan').attr('required', 'required');

        $('#loan').show();
        $('#grant').hide();
    } else {
        $('#loan').hide();
        $('#grant').hide();
    }
    //  getDescriptionBasedOnCategory(category_code);
});


var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

var bene_code = getUrlParameter('code');
console.log('bene code is ' + bene_code);


//get Beneficiary Info 

var info = {
    type: "getBeneficiaryinfo",
    code: bene_code
};

$.ajax({
    url: '../controllers/BeneficiaryController.php',
    type: "GET",
    data: info,
    dataType: 'json',
    success: function (data) {
        console.log('response: ' + data.name);
        $('#beneficiaryCode').val(data.code);
        $('#beneficiaryType').val(data.category_name);
        $('#beneficiaryName').val(data.name);

    }
});


$('#financialTrackerForm').on('submit', function (e) {
    e.preventDefault();

    var formData = $(this).serialize();
    console.log(formData);
    $.ajax({
        url: '../controllers/ActivityController.php?_=' + new Date().getTime(),
        type: "POST",
        data: formData,
        dataType: "json",
        success: function (data) {

            console.log(data);
            var successStatus = data.success;


            if (successStatus == 1) {
                $('#amountDisbursed').val('');
                $('#disbursementDate').val('');

                $('#amountRepaid').val('');
                $('#repaymentDate').val('');

                $('#amountDisbursedGrant').val('');
                $('#disbursementDateGrant').val('');

                $('#financialType').select2("destroy");
                $('#financialType').empty();
                $('#financialType').select2();
                $('#financialType').append('<option value="">Choose...</option> <option value="Loan">Loan</option><option value="Grant">Grant</option>');
                $('#loanPurpose').select2("destroy");
                $('#loanPurpose').select2();
                $('#loan').hide();
                $('#grant').hide();
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

            getFinaceHistory(bene_code);

        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown + " " + textStatus + " New Error: " + jXHR);
        }
    });


});


getFinaceHistory(bene_code);
function getFinaceHistory(bene_code)
{

    var info = {
        type: "getBeneficiaryFinances",
        code: bene_code
    };

    $.ajax({
        url: '../controllers/ActivityController.php?_=' + new Date().getTime(),
        type: "POST",
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
                    r[++j] = '<td>' + value.fiscalYear + '</td>';
                    r[++j] = '<td>' + value.financial_type + '</td>';
                    r[++j] = '<td>' + value.amount_disbursed + '</td>';

                    r[++j] = '<td>' + value.disbursement_date + '</td>';
                    r[++j] = '<td>' + value.createdAt + '</td>';

                    r[++j] = '<td><button onclick="getFinanceDetail(\'' + value.code + '\')" disabled class="editBtn btn btn-outline-info btn-sm col-sm-6" ><i class="fa fa-eye"></i><span class="hidden-md hidden-sm hidden-xs"></span></a>\n\
                            <button onclick="deleteFinance(\'' + value.code + '\')" disabled class="deleteBtn btn btn-outline-danger btn-sm  col-sm-6" type="button"><i class="fa fa-trash-o"></i><span class="hidden-md hidden-sm hidden-xs"></span></button></td>';

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

function deleteFinance(code) {

    $('#code').val(code);
    $('#confirmModal').modal('show');
}

$('#deleteFinanceForm').on('submit', function (e) {
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
            console.log(data);
            // $("#loader").hide();
            $('input:submit').attr("disabled", false);
            $('#loaderModal').modal('hide');
            var successStatus = data.success;
            document.getElementById("deleteFinanceForm").reset();

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
                getFinaceHistory(bene_code);
            }
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });

});
var info = {
    type: "getFinancialinfo",
    code: bene_code
};

function getFinanceDetail(code) {
    $('#financeModal').modal('show');
    getFinanceInfo(code);
}

function getFinanceInfo(code) {


//get Beneficiary Info 

    var info = {
        type: "getFinanceinfo",
        code: code
    };

    $.ajax({
        url: '../controllers/ActivityController.php',
        type: "POST",
        data: info,
        dataType: 'json',
        success: function (data) {
            console.log('response: ' + data.financial_type);
            $('#financialTypeDetail').val(data.financial_type);
            if (data.financial_type == "Loan") {
                $('#loandiv').show();
                $('#grantdiv').hide();
                $('#loanhistorydiv').show();
            } else {
                $('#grantdiv').show();
                $('#loandiv').hide();
                   $('#loanhistorydiv').hide();
            }
            $('#fiscalYearDetail').val(data.fiscalYear);

            $('#loanPurposeDetail').val(data.loan_purpose);

            $('#grantPurposeDetail').val(data.grant_purpose);
            $('#amountDisbursedDetail').val(data.amount_disbursed);
            $('#disbursementDateDetail').val(data.disbursement_date);
            $('#amountRepaidDetail').val(data.amount_paid);
            $('#repaymentDateDetail').val(data.repayment_date);
            $('#amountOutstandingDetail').val(data.amount_outstanding);
        }
    });

}
$(document).ready(function () {

    $("#amountRepaid").focusout(function () {

        var amountPaid = $(this).val();
        var amountDisbursed = $('#amountDisbursed').val();
        var amountOutstanding = amountDisbursed - amountPaid;
        $('#amountOustanding').val(amountOutstanding);
        console.log(amountDisbursed - $(this).val());
        //     $(this).css("background-color", "#FFFFFF");
    });
});

var info = {
    type: "formPermmission",
    formid: 6
};
$.ajax({
    url: '../controllers/AccountController.php?_=' + new Date().getTime(),
    type: "POST",
    data: info,
    dataType: 'json',
    success: function (data) {
console.log(data.create_status);
//create staatus
        if (data.create_status == 'true') {
            $('#creatediv').show();
        }
       if (data.edit_status == 'true') {
            $('.editBtn').removeAttr('disabled');
        }
        if (data.delete_status == 'true') {
            $('.deleteBtn').removeAttr('disabled');
        }

    }
});