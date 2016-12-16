/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//get total beneficiaries

var info = {
    type: "getTotalBeneficiaries"
};
$.ajax({
    url: 'controllers/DashboardController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    success: function (data) {
        $('#beneficiary').html(data);
        console.log('total' + data);
    }
});
var info = {
    type: "getTotalActivitiesCompleted"
};
$.ajax({
    url: 'controllers/DashboardController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    success: function (data) {
        $('#activities').html(data);
        console.log('total' + data);
    }
});
var info = {
    type: "getLoanGivenOut"
};
$.ajax({
    url: 'controllers/DashboardController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    success: function (data) {
        $('#loan').html(data);
        console.log('total' + data);
    }
});
var info = {
    type: "getGrantGivenOut"
};
$.ajax({
    url: 'controllers/DashboardController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    success: function (data) {
        $('#grant').html(data);
        console.log('total' + data);
    }
});
function getBeneficiaryPerRegions() {

//get regions
    var info = {
        type: "getRegions"
    };
  return  $.ajax({
        url: 'controllers/DashboardController.php?_=' + new Date().getTime(),
        type: "GET",
        data: info
//        success: function (data) {
//            handleData(data);
//            console.log(data);
//        }
    });
}

function getBeneficiaryPerRegionsFigures() {

//get regions
    var info = {
        type: "getBeneficiaryPerRegion"
    };
  return  $.ajax({
        url: 'controllers/DashboardController.php?_=' + new Date().getTime(),
        type: "GET",
        data: info
//        success: function (data) {
//
//     //       console.log('region' + data);
//        }
    });
}


var regdata = getBeneficiaryPerRegions();

//data.success(function (data) {
//console.log(data);
//});;

$('.linechat').attr('data-info', '222');
$('.linechat').attr('data-labels', '' + regdata.success(function (data) {
   JSON.stringify(data);
})+ '');

console.log('fvf');
//data - chart = "line"
//        data - labels = ''
//        data - values = '[{"backgroundColor": "rgba(80, 180, 50, 0.2)",
//        "borderColor": "#50b432", "borderWidth": 2,
//        "pointBackgroundColor": "#50b432", "pointRadius": 1,
//        "label": "Beneficiaries", "data": [3, 10]}]'
//        data - hide = '["gxxridLinesX", "legend"]'