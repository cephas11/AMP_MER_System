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

//datatable.columns([0]).visible(false, false);
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
                    r[++j] = '<td> ' + value.fiscalyear + '</td>';
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
                    r[++j] = '<td><button type="button" onclick="editBeneficiary(\'' + value.code + '\')" class="btn btn-outline-info btn-sm  col-sm-6 btn-edit editBtn" disabled><i class="fa fa-edit""></i><span class="hidden-md hidden-sm hidden-xs"> </span></</button>\n\
                              <button onclick="deleteBeneficiary(\'' + value.code + '\',\'' + value.name + '\')" class="btn btn-outline-danger btn-sm  col-sm-6  deleteBtn" disabled type="button"><i class="fa fa-trash-o""></i><span class="hidden-md hidden-sm hidden-xs"> </span></</button></td>';

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


function editBeneficiary(code) {
    getBeneficiaryInfo(code);
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

function getBeneficiaryInfo(code) {
    // $('#loaderModal').modal('show');
    var info = {
        type: "getBeneficiaryinfo",
        code: code
    };

    $.ajax({
        url: '../controllers/BeneficiaryController.php',
        type: "GET",
        data: info,
        dataType: 'json',
        success: function (data) {
            //    $('#loaderModal').modal('show');
            console.log('response: ' + data.ownership_type);
            $('.holder').html(data.name);
            $("#fiscalYear").val(data.fiscalyear);
            $('#dateRegistered').val(data.dateregistered);

            $("#category").val(data.category_name);
            $("#description").val(data.description_name);
            $('#beneficiaryCode').val(code);
            $('#beneficiaryName').val(data.name);
            $('#businessName').val(data.business_name);
            $("#gender").val(data.gender);
            $("#educational_level  option[value=" + data.educational_level + "]").prop("selected", true);
            $("#region").val(data.region_name);
            $('#address').val(data.address);
            $('#community').val(data.community);
            $('#contactno').val(data.contactno);
            $('#altcontactno').val(data.altcontactno);
            $('#email').val(data.email);
            $('#ownership_type').val(data.ownership_type);

            //$("#registered_business  option[value=" + data.registered_business + "]").prop("selected", true);
            $('#longitude').val(data.longitude);
            $('#latitude').val(data.latitude);
            $('#registeredBy').val(data.registeredby);
            $('#establishment_years').val(data.establishment_years);
            $('#district').val(data.district_name);


        }
    });

}


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

var districtinfo = {
    type: "retreiveDistrict"
};

$.ajax({
    url: '../controllers/ConfigurationController.php',
    type: "GET",
    data: districtinfo,
    dataType: 'json',
    success: function (data) {


        $.each(data, function (i, item) {

            $('#district').append($('<option>', {
                value: item.code,
                text: item.name
            }));
        });

    }
});
var descriptioninfo = {
    type: "retreiveDescription"
};

$.ajax({
    url: '../controllers/ConfigurationController.php',
    type: "GET",
    data: descriptioninfo,
    dataType: 'json',
    success: function (data) {


        $.each(data, function (i, item) {

            $('#description').append($('<option>', {
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
            $('#description').html('');
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

    var infotype = {
        type: 'retreiveDistrictsBasedOnRegion',
        region_code: region_code
    };

    $.ajax({
        url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
        type: "GET",
        data: infotype,
        dataType: 'json',
        success: function (data) {
            console.log(data);

            $('#district').html('');
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

$('#updatebeneficiaryForm').on('submit', function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    console.log(formData);
    $('#loader').modal('show');
    $.ajax({
        url: '../controllers/PostController.php?_=' + new Date().getTime(),
        type: "POST",
        data: formData,
        dataType: "json",
        success: function (data) {
            console.log(data);
            $('#editModal').modal('hide');
            $('#loader').modal('hide');
            var successStatus = data.success;

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
                getAllBeneficiaries();
            }
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });

});


var info = {
    type: "formPermmission",
    formid: 3
};
$.ajax({
    url: '../controllers/AccountController.php?_=' + new Date().getTime(),
    type: "POST",
    data: info,
    dataType: 'json',
    success: function (data) {

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