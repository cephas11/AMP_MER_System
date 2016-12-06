/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$("#financialService").change(function () {
    var selectedval = this.value;
    console.log(selectedval);
if(selectedval == 'Grant'){
     $('#grant').show();
     $('#loan').hide();
}else{
   $('#loan').show();
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
