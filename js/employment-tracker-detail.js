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


$('#employeesForm').on('submit', function (e) {
    e.preventDefault();

    var formData = $(this).serialize();
    console.log(formData);

    $('#loaderModal').modal('show');
  
});
