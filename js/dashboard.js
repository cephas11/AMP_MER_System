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
        $('#loan').html('GHS ' + data);

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
        $('#grant').html('GHS ' + data);

    }
});


function getBeneficiaryPerRegions() {


    var info = {
        type: "getBeneficiaryPerRegions"
    };
    return    $.ajax({
        url: 'controllers/DashboardController.php?_=' + new Date().getTime(),
        type: "GET",
        data: info,
        dataType: 'json'

    });
}

getBeneficiaryPerRegions();


$.when(getBeneficiaryPerRegions()).done(function (data) {
    // the code here will be executed when all four ajax requests resolve.
    // a1, a2, a3 and a4 are lists of length 3 containing the response text,
    // status, and jqXHR object for each of the four ajax calls respectively.
    var regions = [];
    var figures = [];

    console.log('data her: ' + data);

    $.each(data, function (i, item) {

        regions.push(item.name);
        figures.push(item.total);

    });
    figures = figures.map(Number);
    console.log(figures);
    console.log(regions);
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: regions,
            datasets: [{
                    "backgroundColor": "rgba(80, 180, 50, 0.2)",
                    "borderColor": "#50b432",
                    "borderWidth": 2,
                    "pointBackgroundColor": "#50b432",
                    "pointRadius": 1,
                    "label": "Beneficiaries", 
                    "data": [2,1]
                                        
                }]
            
        }
    });

});
//var ctx = document.getElementById('myChart').getContext('2d');
//var myChart = new Chart(ctx, {
//  type: 'line',
//  data: {
//    labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
//    datasets: [{
//      label: 'apples',
//      data: [12, 19, 3, 17, 6, 3, 7],
//      backgroundColor: "rgba(153,255,51,0.4)"
//    }, {
//      label: 'oranges',
//      data: [2, 29, 5, 5, 2, 3, 10],
//      backgroundColor: "rgba(255,153,0,0.4)"
//    }]
//  }
//});
