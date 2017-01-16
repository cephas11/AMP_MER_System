/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var info = {
    type: "retreiveEmploymentTypes"
};

$.ajax({
    url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    dataType: 'json',
    success: function (data) {

        console.log('data' + data);
        $.each(data, function (i, item) {

            $('#employmentType').append($('<option>', {
                value: item.code,
                text: item.name
            }));
        });

    }
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



function addRow(tableID) {

    var table = document.getElementById(tableID);

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    var colCount = table.rows[1].cells.length;

    for (var i = 0; i < colCount; i++) {

        var newcell = row.insertCell(i);

        newcell.innerHTML = table.rows[1].cells[i].innerHTML;
        //alert(newcell.childNodes);
        switch (newcell.childNodes[0].type) {
            case "text":
                newcell.childNodes[0].value = "";
                break;
            case "checkbox":
                newcell.childNodes[0].checked = false;
                break;

        }
    }
}

function deleteRow(tableID) {
    try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;

        for (var i = 0; i < rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
            if (null != chkbox && true == chkbox.checked) {
                if (rowCount <= 1) {
                    alert("Cannot delete all the rows.");
                    break;
                }
                table.deleteRow(i);
                rowCount--;
                i--;
            }


        }
    } catch (e) {
        alert(e);
    }
}

function storeEmployessData()
{
//
    var TableData = new Array();
//
    $('#employmentTbl tr').each(function (row, tr) {
        TableData[row] = {
            "name": $(tr).find('td:eq(1) .empname').val()
            , "gender": $(tr).find('td:eq(2) .gender').val()
            , "date": $(tr).find('td:eq(3) .empdate').val()
            , "type": $(tr).find('td:eq(4) .emptype').val()
            , "duration": $(tr).find('td:eq(5) .duration').val()

        }
    });
    TableData.shift();  // first row will be empty - so remove
    return TableData;

}


$('#employeesForm').on('submit', function (e) {
    e.preventDefault();

    var fiscalYear = $('#fiscalYear').val();
    var employed = $('#employed').val();

    var info = {
        type: "setBeneficiaryEmployees",
        fiscalYear: fiscalYear,
        employed: employed,
        employees: storeEmployessData(),
        bene_code: bene_code
    };

    $('#loaderModal').modal('show');
    $.ajax({
        url: '../controllers/ActivityController.php?_=' + new Date().getTime(),
        type: "POST",
        data: info,
        // dataType: "json",
        success: function (data) {
            console.log(data);
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
                getEmployees(bene_code);

            }


        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });

});


var datatable = $('#employemntTbl').DataTable({
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
getEmployees(bene_code);

function getEmployees(bene_code)
{

    var info = {
        type: "getBeneficiaryEmployees",
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
                    r[++j] = '<td>' + value.name + '</td>';
                    r[++j] = '<td>' + value.gender + '</td>';
                    r[++j] = '<td>' + value.employment_type + '</td>';
                    r[++j] = '<td>' + value.duration + '</td>';
                    r[++j] = '<td>' + value.employment_date + '</td>';
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




var info = {
    type: "formPermmission",
    formid: 8
};
$.ajax({
    url: '../controllers/AccountController.php?_=' + new Date().getTime(),
    type: "POST",
    data: info,
    dataType: 'json',
    success: function (data) {

//create staatus
        if (data.create_status == 'true') {
            $('#createBtn').show();
        }


    }
});



