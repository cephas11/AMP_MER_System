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
                    r[++j] = '<td>' + value.name + '</td>';
                    r[++j] = '<td>' + value.business_name + '</td>';
                    r[++j] = '<td>' + value.gender + '</td>';
                    r[++j] = '<td>' + value.email + '</td>';
                    r[++j] = '<td>' + value.contactno + '</td>';
                    r[++j] = "<td><select class='form-control region select2' id='region_" + rowNum + "' ><option value=''>Choose</option></select></td>";
                    r[++j] = "<td><select class='form-control districts  select2' id='districts_" + rowNum + "'></select></td>";
                    r[++j] = "<td><select class='form-control categories select2' id='categories_" + rowNum + "'><option value=''>Choose</option></select></td>";
                    r[++j] = "<td><select class='form-control description select2' id='description_" + rowNum + "'></select></td>";
                    r[++j] = '<td>' + value.community + '</td>';
                    r[++j] = '<td>' + value.longitude + '</td>';
                    r[++j] = '<td>' + value.latitude + '</td>';
                    r[++j] = '<td>' + value.registeredby + '</td>';

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

                $('.region').append($('<option>', {
                    value: item.code,
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

                $('.categories').append($('<option>', {
                    value: item.code,
                    text: item.name
                }));
            });

        }
    });

}


//retreive districts based on region selected for a row
$(function () {

    $(document).on("change", ".region", function (e) {
        e.preventDefault();

        var _this = $(this);
        var rowid = $(this).attr('id');
        var rowArray = rowid.split('_');
        var district_dropdown_id = 'districts_' + rowArray[1];
        var region_code = _this.val();

        //console.log(region_code + district_dropdown_id);

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

                console.log(data);
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

        //console.log(region_code + district_dropdown_id);
        $('#' + description_dropdown_id).html("");
        $('#' + description_dropdown_id).html("<option value=''>choose</option>");

        var info = {
            type: 'retreiveDescriptionBasedOnCategory',
            category_code: category_code
        };
        console.log('data');
        $.ajax({
            url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
            type: "GET",
            data: info,
            dataType: 'json',
            success: function (data) {

                console.log(data);
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

$('#saveBeneficiary').click(function () {
    $('#confirmModal').modal('hide');
    $('#loaderModal').modal('show');
    var TableData;
    // TableData = storeBeneficiarieslData();
    TableData = JSON.stringify(storeBeneficiarieslData());
    console.log('beneficiaries data:' + TableData);



    $.ajax({
        type: "POST",
        url: "../controllers/bulkBeneficiaryController.php?_=" + new Date().getTime(),
        data: "pTableData=" + TableData,
        dataType: "json",
        success: function (data) {
            var successStatus = data.success;
            if (successStatus == 1) {
                $('#loaderModal').modal('hide');


                swal({
                    title: "Success",
                    text: data.message,
                    type: "success",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false,
                }, function (isConfirm) {
                    if (isConfirm) {
                        window.location = "beneficiaries-list";

                    }
                });

            }

        }
    });
});


$('#clearBeneficiary').click(function () {
    $('#clearModal').modal('hide');
    $('#loaderModal').modal('show');

    console.log('data is');
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



function storeBeneficiarieslData()
{

    var TableData = new Array();

    $('#beneficiaryTbl tr').each(function (row, tr) {
        TableData[row] = {
            "fiscalYear": $(tr).find('td:eq(0)').text()
            , "dateRegistered": $(tr).find('td:eq(1)').text()
            , "name": $(tr).find('td:eq(2)').text()
            , "businessName": $(tr).find('td:eq(3)').text()
            , "gender": $(tr).find('td:eq(4)').text()

            , "email": $(tr).find('td:eq(5)').text()
            , "contactno": $(tr).find('td:eq(6)').text()
            , "region": $(tr).find('td:eq(7) .region').val()
            , "district": $(tr).find('td:eq(8) .districts').val()
            , "category": $(tr).find('td:eq(9) .categories').val()
            , "description": $(tr).find('td:eq(10) .description').val()
            , "community": $(tr).find('td:eq(11)').text()
            , "longitude": $(tr).find('td:eq(12)').text()
            , "latitude": $(tr).find('td:eq(13)').text()
            , "registeredBy": $(tr).find('td:eq(14)').text()

        }
    });
    TableData.shift();  // first row will be empty - so remove
    return TableData;

}