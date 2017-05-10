/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



var info = {
    type: "userGroupPermissions"
};
$.ajax({
    url: 'controllers/AccountController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    dataType: 'json',
    success: function (data) {

        console.log(data);
//                        if (jQuery.inArray("1", myarray) != - 1) {
//                console.log("is in array");
//                        } else {
//                console.log("is NOT in array");
//                        }
        console.log()
        var countt = 1;
        $.each(data, function (i, obj) {
            if (obj.form_id == countt) {
                if (obj.view_status == 'true') {
                    $('#' + countt).show();
                    console.log('true');
                } else {
                    console.log('false');
                }

            }
            countt = countt + 1;
            console.log('count is ' + countt);
        });
    }
});


var colors = [
    "#2ecc71",
    "#3498db",
    "#95a5a6",
    "#9b59b6",
    "#f1c40f",
    "#e74c3c",
    "#34495e"
];
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
    type: "getBeneficiariesTrained"
};
$.ajax({
    url: 'controllers/DashboardController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    success: function (data) {
        $('#bentrained').html(data);
    }
});
var info = {
    type: "getBeneficiariesApplyMethods"
};
$.ajax({
    url: 'controllers/DashboardController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    success: function (data) {
        $('#benapplied').html(data);
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

//getBeneficiaryPerRegions();


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
    console.log('figures: ' + figures);
    console.log('regions:' + regions);
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
                    "data": figures

                }]

        }
    });
});
function getBeneficiaryPerCategories() {


    var info = {
        type: "getBeneficiaryPerCategories"
    };
    return    $.ajax({
        url: 'controllers/DashboardController.php?_=' + new Date().getTime(),
        type: "GET",
        data: info,
        dataType: 'json'

    });
}

$.when(getBeneficiaryPerCategories()).done(function (data) {
// the code here will be executed when all four ajax requests resolve.
// a1, a2, a3 and a4 are lists of length 3 containing the response text,
// status, and jqXHR object for each of the four ajax calls respectively.
    var categories = [];
    var figures = [];
    console.log('data her: ' + data);
    $.each(data, function (i, item) {

        categories.push(item.name);
        figures.push(item.total);
    });
    figures = figures.map(Number);
    var figures_length = figures.length;
    var random_colors = getUnique(figures_length);
    var ctx = document.getElementById("myChartCategory").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: categories,
            datasets: [{
                    backgroundColor: [
                        "#2ecc71",
                        "#3498db",
                        "#95a5a6",
                        "#9b59b6",
                        "#f1c40f",
                        "#e74c3c",
                        "#34495e"
                    ],
                    data: figures
                }]
        }
    });
});
function getUnique(count) {
    // Make a copy of the array
    var tmp = colors.slice(colors);
    var ret = [];
    for (var i = 0; i < count; i++) {
        var index = Math.floor(Math.random() * tmp.length);
        var removed = tmp.splice(index, 1);
        // Since we are only removing one element
        ret.push(removed[0]);
    }
    return  ret;
}



function getBeneficiaryPerDistricts() {


    var info = {
        type: "getBeneficiaryPeristricts"
    };
    return    $.ajax({
        url: 'controllers/DashboardController.php?_=' + new Date().getTime(),
        type: "GET",
        data: info,
        dataType: 'json'

    });
}

$.when(getBeneficiaryPerDistricts()).done(function (data) {
// the code here will be executed when all four ajax requests resolve.
// a1, a2, a3 and a4 are lists of length 3 containing the response text,
// status, and jqXHR object for each of the four ajax calls respectively.
    var districts = [];
    var figures = [];
    console.log('data her: ' + data);
    $.each(data, function (i, item) {

        districts.push(item.name);
        figures.push(item.total);
    });
    figures = figures.map(Number);
    var ctx = document.getElementById("districtsChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: districts,
            datasets: [{
                    "backgroundColor": "green",
                    "borderWidth": 2,
                    "pointBackgroundColor": "#50b432",
                    "pointRadius": 1,
                    "label": "Beneficiaries",
                    "data": figures

                }],
            yaxis: {
                tickDecimals: 0
            }


        }
    });
});
//
//
//
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
