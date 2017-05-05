/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//beneficiaresListTbl









var datatable = $('#beneficiaresListTbl').DataTable({
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
    "order": [[12, "desc"]]

});


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

            $('#region').append($('<option>', {
                value: item.code,
                text: item.name
            }));
        });

    }
});
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

var info = {
    type: "retreiveDescription"
};

$.ajax({
    url: '../controllers/ConfigurationController.php',
    type: "GET",
    data: info,
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

var info = {
    type: "retreiveDistrict"
};

$.ajax({
    url: '../controllers/ConfigurationController.php',
    type: "GET",
    data: info,
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
                    r[++j] = '<td>' + value.datecreated + '</td>';

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


//generateReport

$('#generateReport').on('submit', function (e) {
    e.preventDefault();
    $('input:submit').attr("disabled", true);
    var formData = $(this).serialize();
    console.log(formData);
    $('#loaderModal').modal('show');
    var query = "SELECT * FROM beneficiaries_view WHERE active = 0";
    var fiscalYear = $('#fiscalYear').val();
    if (fiscalYear !== null)
    {
        arr = ("" + fiscalYear + "").split(',');
        newarr = [];
        $.each(arr, function () {
            newarr.push("'" + this + "'");
        });
        var languages = newarr.toString();
        query = query + " AND fiscalyear IN(" + languages + ")";
    }
    var category = $('#category').val();
    if (category !== null)
    {
        arr = ("" + category + "").split(',');
        newarr = [];
        $.each(arr, function () {
            newarr.push("'" + this + "'");
        });
        var category = newarr.toString();
        query = query + " AND category_code IN(" + category + ")";
    }
    var description = $('#description').val();
    if (description !== null)
    {
        arr = ("" + description + "").split(',');
        newarr = [];
        $.each(arr, function () {
            newarr.push("'" + this + "'");
        });
        var description = newarr.toString();
        query = query + " AND description_code IN(" + description + ")";
    }
    var gender = $('#gender').val();
    if (gender !== null)
    {
        arr = ("" + gender + "").split(',');
        newarr = [];
        $.each(arr, function () {
            newarr.push("'" + this + "'");
        });
        var gender = newarr.toString();
        query = query + " AND gender IN(" + gender + ")";
    }
    var region = $('#region').val();
    if (region !== null)
    {
        arr = ("" + region + "").split(',');
        newarr = [];
        $.each(arr, function () {
            newarr.push("'" + this + "'");
        });
        var region = newarr.toString();
        query = query + " AND region_code IN(" + region + ")";
    }
    var district = $('#district').val();
    if (district !== null)
    {
        arr = ("" + district + "").split(',');
        newarr = [];
        $.each(arr, function () {
            newarr.push("'" + this + "'");
        });
        var district = newarr.toString();
        query = query + " AND district_code IN(" + district + ")";
    }

    $.ajax({
        url: '../controllers/ReportController.php?_=' + new Date().getTime(),
        type: "GET",
        data: {query: query, type: "beneficiariesreport"},
        success: function (data) {
            $('#loaderModal').modal('hide');

            console.log('response:' + data);
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
                    r[++j] = '<td>' + value.datecreated + '</td>';

                    rowNum = rowNum + 1;


                    rowNode = datatable.row.add(r);
                });

                rowNode.draw().node();
            }

        }
    });
    // console.log(query);
});




var activitydatatable = $('#activityTbl').DataTable({
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
    }

});


$.ajax({
    url: '../controllers/ReportController.php?_=' + new Date().getTime(),
    type: "GET",
    data: {type: "generateActivityReport"},
    success: function (data) {
//acctivityTbl

        console.log('response activity:' + data);
        activitydatatable.clear().draw();
        var obj = jQuery.parseJSON(data);
        if (obj.length == 0) {
            console.log("NO DATA!");
        } else {

            var rowNum = 0;
            $.each(obj, function (key, value) {
                var j = -1;
                var r = new Array();
                r[++j] = '<td>' + value.activity_type_name + '</td>';
                r[++j] = '<td> ' + value.activity_description_name + '</td>';
                r[++j] = '<td>' + value.region_name + '</td>';
                r[++j] = '<td>' + value.district_name + '</td>';
                r[++j] = '<td>' + value.implementer + '</td>';
                r[++j] = '<td >' + value.total + '</td>';
                r[++j] = '<td>' + value.female + '</td>';
                r[++j] = '<td>' + value.male + '</td>';

                rowNum = rowNum + 1;


                rowNode = activitydatatable.row.add(r);
            });

            rowNode.draw().node();
        }



    }
});

//generateFinancialReport

var financialdatatable = $('#financialTbl').DataTable({
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
    }

});


var info = {
    type: "generateFinancialReport"
};

$.ajax({
    url: '../controllers/ReportController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    success: function (data) {
//acctivityTbl

        console.log('response:' + data);
        financialdatatable.clear().draw();
        var obj = jQuery.parseJSON(data);
        if (obj.length == 0) {
            console.log("NO DATA!");
        } else {

            var rowNum = 0;
            $.each(obj, function (key, value) {
                var j = -1;
                var r = new Array();
                r[++j] = '<td>' + value.gender + '(s)</td>';
                r[++j] = '<td> ' + value.financial_type + '</td>';
                r[++j] = '<td>' + value.totals + '</td>';
                r[++j] = '<td> GHS ' + value.volume + '</td>';

                rowNum = rowNum + 1;


                rowNode = financialdatatable.row.add(r);
            });

            rowNode.draw().node();
        }



    }
});













var salesdatatable = $('#salesTbl').DataTable({
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
    }

});


var info = {
    type: "generateSalesReport"
};

$.ajax({
    url: '../controllers/ReportController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    success: function (data) {
//acctivityTbl

        console.log('response:' + data);
        salesdatatable.clear().draw();
        var obj = jQuery.parseJSON(data);
        if (obj.length == 0) {
            console.log("NO DATA!");
        } else {

            var rowNum = 0;
            $.each(obj, function (key, value) {
                var j = -1;
                var r = new Array();
                r[++j] = '<td>' + value.commodity + '</td>';
                r[++j] = '<td> ' + value.usd + '</td>';
                r[++j] = '<td>' + value.value_tonnes + '</td>';

                rowNum = rowNum + 1;


                rowNode = salesdatatable.row.add(r);
            });

            rowNode.draw().node();
        }



    }
});
