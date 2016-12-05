/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var info = {
    type: "retreiveActivityTypes"
};

$.ajax({
    url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    dataType: 'json',
    success: function (data) {


        $.each(data, function (i, item) {

            $('#activityType').append($('<option>', {
                value: item.code,
                text: item.name
            }));
        });

    }
});



var info = {
    type: "retreiveActivityDesc"
};

$.ajax({
    url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    dataType: 'json',
    success: function (data) {


        $.each(data, function (i, item) {

            $('#activityDescription').append($('<option>', {
                value: item.code,
                text: item.name
            }));
        });

    }
});

$('#participantsListTbl').DataTable();

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

var activity_code = getUrlParameter('activity_code');
console.log('code is ' + activity_code);

var info = {
    type: "retreiveActivityInfo",
    activity_code: activity_code
};

$.ajax({
    url: '../controllers/ActivityController.php',
    type: "POST",
    data: info,
    dataType: 'json',
    success: function (data) {

        $.each(data, function (i, item) {
            console.log('innnfo here:' + item.activity_date + item.region);
            $('#activityDate').val(item.activity_date);
            $('#category').val(item.category_name);
            $('#region').val(item.region_name);
            $('#district').val(item.district_name);
            $('#community').val(item.community);
            $('#maleParticipants').val(item.male);
            $('#femaleParticipants').val(item.female);
            $('#totalParticipants').val(item.total);
             $('#activityImplementer').val(item.implementer);

            $("#activityType  option[value=" + item.type + "]").prop("selected", true);
            $("#activityDescription  option[value=" + item.description + "]").prop("selected", true);
            
        });

    }
});


$("#activityType").change(function () {
    console.log(this.value);
    getDescriptionBasedOnActivityType(this.value);

});




function getDescriptionBasedOnActivityType(type_code) {

    var infotype = {
        type: 'retreiveDescriptionBasedOnActivityType',
        type_code: type_code
    };

    $.ajax({
        url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
        type: "GET",
        data: infotype,
        dataType: 'json',
        success: function (data) {

            console.log(data);
            $('#activityDescription').html('');
            $('#activityDescription').append('<option value = ""> Choose... </option>');


            $.each(data, function (i, item) {

                $('#activityDescription').append($('<option>', {
                    value: item.description_code,
                    text: item.description_name
                }));
            });
            $('#activityDescription').trigger("chosen:updated");


        }
    });
}

