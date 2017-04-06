/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$('#saveButton').hide();
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

//datatable.columns([21]).visible(false, false);
datatable.columns.adjust().draw(false); // adjust column sizing and redraw


getBneficiaryTempData();
console.log('dataaaaaaa here:');

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


            datatable.clear().draw();
            var obj = jQuery.parseJSON(data);
            if (obj.length == 0) {
                console.log("NO DATA!");
            } else {
                $('#saveButton').show();

                var rowNum = 0;
                $.each(obj, function (key, value) {
                    var j = -1;
                    var r = new Array();



                    r[++j] = '<td>' + value.fiscalyear + '</td>';
                    r[++j] = '<td>' + value.dateregistered + '</td>';
                    r[++j] = "<td><select class='form-control categories select2' id='categories_" + rowNum + "'><option value=''>Choose</option></select></td>";
                    r[++j] = "<td><select class='form-control description select2' id='description_" + rowNum + "'></select></td>";
                    r[++j] = '<td>' + value.name + '</td>';
                    r[++j] = '<td>' + value.business_name + '</td>'
                    r[++j] = '<td>' + value.gender + '</td>';
                    r[++j] = '<td>' + value.educational_level + '</td>';
                    r[++j] = '<td>' + value.address + '</td>';
                    r[++j] = "<td><select class='form-control regions select2' id='region_" + rowNum + "' ><option value=''>Choose</option></select></td>";
                    r[++j] = "<td><select class='form-control districts  select2' id='districts_" + rowNum + "'></select></td>";
                    r[++j] = '<td>' + value.community + '</td>';
                    r[++j] = '<td>' + value.contactno + '</td>';
                    r[++j] = '<td>' + value.altcontactno + '</td>';
                    r[++j] = '<td>' + value.email + '</td>';
                    r[++j] = '<td>' + value.registered_business + '</td>';
                    r[++j] = '<td>' + value.ownership_type + '</td>';
                    r[++j] = '<td>' + value.establishment_years + '</td>';
                    r[++j] = '<td>' + value.longitude + '</td>';
                    r[++j] = '<td>' + value.latitude + '</td>';
                    r[++j] = '<td>' + value.registeredby + '</td>';
                    r[++j] = '<td>' + value.beneficiary_id + '</td>';
                    r[++j] = '<td><button type="button"  class="btn btn-outline-info btn-sm  col-sm-6 btn-edit saveInfo"><i class="fa fa-edit""></i><span class="hidden-md hidden-sm hidden-xs"> </span></</button>\n\
                              <button  class="btn btn-outline-danger btn-sm  col-sm-6 btn-delete deleteInfo" type="button"><i class="fa fa-trash-o""></i><span class="hidden-md hidden-sm hidden-xs"> </span></</button></td>';

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
                var code = item.shortcode + '-' + item.code;

                $('.regions').append($('<option>', {
                    value: code,
                    text: item.name
                }));
            });

        }
    });
}

getCategories();
function getCategories() {
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
                var code = item.shortcode + '-' + item.code;

                $('.categories').append($('<option>', {
                    value: code,
                    text: item.name
                }));
            });

        }
    });

}


//retreive districts based on region selected for a row
$(function () {

    $(document).on("change", ".regions", function (e) {



        e.preventDefault();

        var _this = $(this);
        var rowid = $(this).attr('id');
        var rowArray = rowid.split('_');
        var district_dropdown_id = 'districts_' + rowArray[1];
        var region_code = _this.val();

        console.log(region_code + district_dropdown_id);

        var info = {
            type: 'retreiveDistrictsBasedOnRegion',
            region_code: region_code
        };
        console.log('data');
        $('#' + district_dropdown_id).html("");
        $('#' + district_dropdown_id).html("<option value=''>choose</option>");

        $.ajax({
            url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
            type: "GET",
            data: info,
            dataType: 'json',
            success: function (data) {

                console.log('districts data : ' + data);
                $.each(data, function (i, item) {

                    $('#' + district_dropdown_id).append($('<option>', {
                        value: item.districts_code,
                        text: item.district_name
                    }));
                });
            }
        });


    });





});

//retreive description based on category selected for a row
$(function () {

    $(document).on("change", ".categories", function (e) {
        e.preventDefault();

        var _this = $(this);
        var rowid = $(this).attr('id');
        var rowArray = rowid.split('_');
        var description_dropdown_id = 'description_' + rowArray[1];
        var category_code = _this.val();


        $('#' + description_dropdown_id).html("");
        $('#' + description_dropdown_id).html("<option value=''>choose</option>");

        var info = {
            type: 'retreiveDescriptionBasedOnCategory',
            category_code: category_code
        };
        $.ajax({
            url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
            type: "GET",
            data: info,
            dataType: 'json',
            success: function (data) {

                $.each(data, function (i, item) {

                    $('#' + description_dropdown_id).append($('<option>', {
                        value: item.description_code,
                        text: item.description_name
                    }));
                });
            }
        });


    });
});
//
//$('#saveBeneficiary').click(function () {
//    $('#confirmModal').modal('hide');
//    $('#loaderModal').modal('show');
//    var TableData;
//    // TableData = storeBeneficiarieslData();
//    TableData = JSON.stringify(storeBeneficiarieslData());
//    console.log('beneficiaries data:' + TableData);
//
//
//
//    $.ajax({
//        type: "POST",
//        url: "../controllers/bulkBeneficiaryController.php?_=" + new Date().getTime(),
//        data: "pTableData=" + TableData,
//        dataType: "json",
//        success: function (data) {
//            var successStatus = data.success;
//            if (successStatus == 1) {
//                $('#loaderModal').modal('hide');
//
//
//                swal({
//                    title: "Success",
//                    text: data.message,
//                    type: "success",
//                    confirmButtonText: "Ok",
//                    closeOnConfirm: false,
//                }, function (isConfirm) {
//                    if (isConfirm) {
//                        window.location = "beneficiaries-list";
//
//                    }
//                });
//
//            }
//
//        }
//    });
//});


$('#clearBeneficiary').click(function () {
    $('#clearModal').modal('hide');
    $('#loaderModal').modal('show');

    $.ajax({
        type: "GET",
        url: "../controllers/BeneficiaryController.php?_=" + new Date().getTime(),
        data: "type=clearTempData",
        success: function (data) {
            console.log('response server: ' + data);

            if (data == 1) {
                $('#loaderModal').modal('hide');


                swal({
                    title: "Success",
                    text: "Data cleared successfully",
                    type: "success",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false,
                }, function (isConfirm) {
                    if (isConfirm) {
                        window.location = "bulk-beneficiary-upload";

                    }
                });

            }

        }
    });
});


//
//function storeBeneficiarieslData()
//{
//
//    var TableData = new Array();
//
//    $('#beneficiaryTbl tr').each(function (row, tr) {
//        TableData[row] = {
//            "fiscalYear": $(tr).find('td:eq(0)').text()
//            , "dateRegistered": $(tr).find('td:eq(1)').text()
//            , "name": $(tr).find('td:eq(2)').text()
//            , "businessName": $(tr).find('td:eq(3)').text()
//            , "gender": $(tr).find('td:eq(4)').text()
//
//            , "email": $(tr).find('td:eq(5)').text()
//            , "contactno": $(tr).find('td:eq(6)').text()
//            , "region": $(tr).find('td:eq(7) .region').val()
//            , "district": $(tr).find('td:eq(8) .districts').val()
//            , "category": $(tr).find('td:eq(9) .categories').val()
//            , "description": $(tr).find('td:eq(10) .description').val()
//            , "community": $(tr).find('td:eq(11)').text()
//            , "longitude": $(tr).find('td:eq(12)').text()
//            , "latitude": $(tr).find('td:eq(13)').text()
//            , "registeredBy": $(tr).find('td:eq(14)').text()
//
//        }
//    });
//    TableData.shift();  // first row will be empty - so remove
//    return TableData;
//
//}
//

$('#beneficiaryTbl tbody').on('click', '.saveInfo', function () {

    var $row = $(this).closest("tr");    // Find the row
    var fisyear = $row.find('td:eq(0)').text();
    var dateRegisterd = $row.find('td:eq(1)').text();
    var category = $row.find('td:eq(2) .categories :selected').text();
    var categoryCode = $row.find('td:eq(2) .categories :selected').val();
    var description = $row.find('td:eq(3) .description :selected').text();
    var descriptionCode = $row.find('td:eq(3) .description :selected').val();
    var beneficiary = $row.find('td:eq(4)').text();
    var businessName = $row.find('td:eq(5)').text();
    var gender = $row.find('td:eq(6)').text();
    var educationalLevel = $row.find('td:eq(7)').text();
    var address = $row.find('td:eq(8)').text();
    var region = $row.find('td:eq(9)  .regions :selected').text();
    var regionCode = $row.find('td:eq(9)  .regions :selected').val();
    var district = $row.find('td:eq(10) .districts :selected').text();
    var districtCode = $row.find('td:eq(10) .districts :selected').val();
    var community = $row.find('td:eq(11)').text();
    var contactno = $row.find('td:eq(12)').text();
    var altcontactno = $row.find('td:eq(13)').text();
    var email = $row.find('td:eq(14)').text();
    var registerdBusiness = $row.find('td:eq(15)').text();
    var ownership_type = $row.find('td:eq(16)').text();
    var establishment_years = $row.find('td:eq(17)').text();
    var longitude = $row.find('td:eq(18)').text();
    var latitude = $row.find('td:eq(19)').text();
    var registeredBy = $row.find('td:eq(20)').text();
    var beneficiaryId = $row.find('td:eq(21)').text();
console.log('beneficiary id '+beneficiaryId);
    $('.fiscalyear').html(fisyear);
    $('.dateRegistered').html(dateRegisterd);
    $('.category').html(category);
    $('.description').html(description);
    $('.beneficiary').html(beneficiary);
    $('.business').html(businessName);
    $('.gender').html(gender);
    $('.level').html(educationalLevel);
    $('.address').html(address);
    $('.region').html(region);
    $('.district').html(district);
    $('.community').html(community);
    $('.contactno').html(contactno);
    $('.altcontactno').html(altcontactno);
    $('.email').html(email);
    $('.community').html(community);
    $('.contactno').html(contactno);
    $('.altcontactno').html(altcontactno);
    $('.email').html(email);
    $('.regBusiness').html(registerdBusiness);
    $('.ownership').html(ownership_type);
    $('.estabishment').html(establishment_years);
    $('.longitude').html(longitude);
    $('.latitude').html(latitude);
    $('.registeredBy').html(registeredBy);


    $('#fiscalYear').val(fisyear);
    $('#dateRegistered').val(dateRegisterd);
    $('#category').val(categoryCode);
    $('#description').val(descriptionCode);
    $('#beneficiaryName').val(beneficiary);
    $('#businessName').val(businessName);
    $('#gender').val(gender);
    $('#educational_level').val(educationalLevel);
    $('#address').val(address);
    $('#region').val(regionCode);
    $('#district').val(districtCode);
    $('#community').val(community);
    $('#contactno').val(contactno);
    $('#altcontactno').val(altcontactno);
    $('#email').val(email);
    $('#community').val(community);
    $('#contactno').val(contactno);
    $('#altcontactno').val(altcontactno);
    $('#registered_business').val(registerdBusiness);
    $('#ownership_type').val(ownership_type);
    $('#establishment_years').val(establishment_years);
    $('#longitude').val(longitude);
    $('#latitude').val(latitude);
    $('#registeredBy').val(registeredBy);
    $('#beneficiaryId').val(beneficiaryId);
    $('#editModal').modal('show');
//    console.log(fisyear);


});





$('#beneficiaryTbl tbody').on('click', '.deleteInfo', function () {
    var $row = $(this).closest("tr");
    var beneficiaryId = $row.find('td:eq(21)').text();
    console.log('beneficiary' + beneficiaryId);
    var info = {
        type: "deleteBeneficiaryTemp",
        beneficiaryId: beneficiaryId
    };

    $.ajax({
        url: '../controllers/deleteController.php?_=' + new Date().getTime(),
        type: "GET",
        data: info,
        dataType: 'json',
        success: function (data) {
            console.log(data);

            var successStatus = data.success;
            console.log(successStatus);

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
                getBneficiaryTempData();


            }
        }
    });

});



$('#saveBeneficiaryForm').on('submit', function (e) {
    e.preventDefault();
    console.log('right here :');
    //VALIDATE FOR region,districts,category,decription
    var category = $('#category').val();
    var description = $('#description').val();
    var region = $('#region').val();
    var district = $('#district').val();

    if (category == "") {
        alert('Category is not selected');
    } else if (description == "") {
        alert('description is not selected');
    } else if (region == "") {
        alert('region is not selected');
    } else if (district == "") {
        alert('district is not selected');
    } else {
        var formData = $(this).serialize();
        console.log(formData);
        $('input:submit').attr("disabled", true);
        $("#loader").show();
        $.ajax({
            url: '../controllers/PostController.php?_=' + new Date().getTime(),
            type: "POST",
            data: formData,
            dataType: 'json',
            success: function (data) {
                $('input:submit').attr("disabled", false);
                console.log(data);
                $("#loader").hide();
                $('#editModal').modal('hide');
                var successStatus = data.success;
                console.log(successStatus);

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
                    getBneficiaryTempData();
                } else {
                    Command: toastr["error"](data.message, "Error");

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

    }


});
