/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */





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
$('#loaderModal').modal('show');
$.ajax({
    url: '../controllers/BeneficiaryController.php',
    type: "GET",
    data: info,
    dataType: 'json',
    success: function (data) {
        console.log('response: ' + data);
        $('#beneficiaryCode').val(data.code);
        $('#fiscalYear').val(data.fiscalyear);
        $('#beneficiaryName').val(data.name);
        $('#fiscalYear').val(data.fiscalyear);
        $('#gender').val(data.gender);
        $('#businessName').val(data.business_name);
        $('#beneficiaryCategory').val(data.category_name);
        $('#region').val(data.region_name);
        $('#district').val(data.district_name);
        $('#community').val(data.community);
        $('#loaderModal').modal('hide');
    }
});



$('#adoptionTrackerForm').on('submit', function (e) {
    e.preventDefault();

    var formData = $(this).serialize();
    console.log(formData);

    $('#loaderModal').modal('show');
    $.ajax({
        url: '../controllers/ActivityController.php?_=' + new Date().getTime(),
        type: "POST",
        data: formData,
        dataType: "json",
        success: function (data) {
            $('#loaderModal').modal('hide');
            console.log(data);
            var successStatus = data.success;


            if (successStatus == 1) {
                $('select').select2().select2('val', $('.select2 option:eq(1)').val());
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
                //  getSales(bene_code);
                getAdoption(bene_code);
            }



        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown + " " + textStatus + " New Error: " + jXHR);
        }
    });

});

var datatable = $('#adoptionTbl').DataTable({
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

getAdoption(bene_code);
console.log(bene_code + '  ');
function getAdoption(bene_code)
{

    var info = {
        type: "getdoptionTracker",
        code: bene_code
    };

    $.ajax({
        url: '../controllers/ActivityController.php?_=' + new Date().getTime(),
        type: "POST",
        data: info,
        success: function (data) {
            var holder = '';
            console.log(data);
            datatable.clear().draw();

            var obj = jQuery.parseJSON(data);
            console.log('size' + obj.length);
            if (obj.length == 0) {
                console.log("NO DATA!");
            } else {
                $.each(obj, function (key, value) {
                    if (value.technique == "") {
                        holder = value.reason;
                    } else {
                        holder = value.technique;
                    }

                    var j = -1;
                    var r = new Array();
                    // represent columns as array
                    r[++j] = '<td>' + value.fiscalYear + '</td>';

                    r[++j] = '<td>' + value.applied + '</td>';
                    r[++j] = '<td>' + holder + '</td>';
                    r[++j] = '<td>' + value.datecreated + '</td>';

                    r[++j] = '<td><button onclick="deleteSale(\'' + value.code + '\')" disabled class="btn btn-outline-danger btn-sm deleteBtn" type="button">Delete</button></td>';

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





$("#applied").change(function () {
    var selectedval = this.value;
    console.log(selectedval);
    if (selectedval == 'yes') {

        $('#techniques').attr('required', 'required');
        $('#techniquesdiv').show();
        $('#reasondiv').hide();
    } else if (selectedval == 'no') {

        $('#techniques').removeAttr('required');
        $('#reasondiv').show();
        $('#techniquesdiv').hide();
    } else {
        $('#reasondiv').hide();
        $('#techniquesdiv').hide();
    }
    //  getDescriptionBasedOnCategory(category_code);
});



var info = {
    type: "formPermmission",
    formid: 7
};
$.ajax({
    url: '../controllers/AccountController.php?_=' + new Date().getTime(),
    type: "POST",
    data: info,
    dataType: 'json',
    success: function (data) {

//create staatus
        if (data.create_status == 'true') {
            $('#saveBtn').show();
        }
        if (data.edit_status == 'true') {
            $('.editBtn').removeAttr('disabled');
        }


    }
});