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
        console.log(data);

        //    console.log('innnfo here:' + item.activity_date + item.region);
        $('#activityDate').val(data.activity_date);
        $('#category').val(data.category_name);
        $('#region').val(data.region_name);
        $('#district').val(data.district_name);
        $('#community').val(data.community);
        $('#maleParticipants').val(data.male);
        $('#femaleParticipants').val(data.female);
        $('#totalParticipants').val(data.total);
        $('#activityImplementer').val(data.implementer);

        $("#activityType  option[value=" + data.type + "]").prop("selected", true);
        $("#activityDescription  option[value=" + data.description + "]").prop("selected", true);
        $('.holder').html(data.category_name + '(s)');
        getUnAssignedBeneficiaries(data.region, data.category);

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




//function getUnAssignedBeneficiaries(regcode, catcode) {
//    console.log('code here'+regcode+' '+catcode);
//    var info = {
//        "regcode": regcode,
//        "catcode": catcode,
//        type: "getUnAssignedBeneficiaries"
//    };
//
//    $.ajax({
//        url: '../controllers/BeneficiaryController.php?_=' + new Date().getTime(),
//        type: "GET",
//        data: info,
//        //dataType: 'json',
//        success: function (data) {
//
//
//            console.log('response:'+data);
//
//        }
//    });
//}


getActivityParticipants();



function getActivityParticipants()
{
    if (activity_code == "") {
        console.log('do nothing');
    } else {
        //datatable.clear().draw();
        datatable = $('#participantsTbl').DataTable({
            responsive: true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                url: '../controllers/BeneficiaryController.php?_=' + new Date().getTime(),
                "type": "GET",
                "data": {
                    activity_code: activity_code,
                    type: "retreiveActivityParticipants"
                }
            },
            language: {
                paginate:
                        {previous: "&laquo;", next: "&raquo;"},
                search: "_INPUT_",
                searchPlaceholder: "Search…"
            },
            'columnDefs': [
                {
                    'targets': 0,
                    'checkboxes': {
                        'selectRow': true
                    }
                }
            ],
            'select': {
                'style': 'multi'
            },
            'order': [[1, 'asc']]
        });

    }

}


function getUnAssignedBeneficiaries(regcode, catcode)
{
    if (regcode == "" || catcode == "") {
        console.log('do nothing');
    } else {
        //datatable.clear().draw();
        datatable = $('#newparticipantsTbl').DataTable({
            responsive: true,
            "processing": true,
            "serverSide": false,
            "ajax": {
                url: '../controllers/BeneficiaryController.php?_=' + new Date().getTime(),
                "type": "GET",
                "data": {
                    "regcode": regcode,
                    "catcode": catcode,
                    type: "getUnAssignedBeneficiaries"
                }
            },
            language: {
                paginate:
                        {previous: "&laquo;", next: "&raquo;"},
                search: "_INPUT_",
                searchPlaceholder: "Search…"
            },
            'columnDefs': [
                {
                    'targets': 0,
                    'checkboxes': {
                        'selectRow': true
                    }
                }
            ],
            'select': {
                'style': 'multi'
            },
            'order': [[1, 'asc']]
        });

    }

}
