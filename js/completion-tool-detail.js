/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var datatable = $('#participantsTbl').DataTable({
    responsive: true,
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    },
    order: [[0, "asc"]]
});

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

        getActivityCategories(activity_code);
        //    console.log('innnfo here:' + item.activity_date + item.region);
        $('#activityDate').val(data.activity_date);
        $('#region').val(data.region_name);
        $('#district').val(data.district_name);
        $('#community').val(data.community);
        $('#maleParticipants').val(data.male);
        $('#femaleParticipants').val(data.female);
        $('#totalParticipants').val(data.total);
        $('#activityImplementer').val(data.implementer);
        $('#activityType').val(data.activity_type_name);
        $('#activityDescription').val(data.activity_description_name);

//        $('.holder').html(data.category_name + '(s)');
//        getUnAssignedBeneficiaries(data.region, data.category);

    }
});

function getActivityCategories(code) {
    var info = {
        code: code,
        type: "getActivityCategories"
    };

    $.ajax({
        url: '../controllers/ActivityController.php?_=' + new Date().getTime(),
        type: "POST",
        data: info,
         dataType: 'json',
        success: function (data) {
           // console.log('here:' + data);
            var values = [];
            $.each(data, function (i, item) {

                values.push(item.category_name);
            });
            console.log(values.join(','));
$('#category').val(values.join(','));
        }
    });

}

//$("#activityType").change(function () {
//    console.log(this.value);
//    getDescriptionBasedOnActivityType(this.value);
//
//});




//function getDescriptionBasedOnActivityType(type_code) {
//
//    var infotype = {
//        type: 'retreiveDescriptionBasedOnActivityType',
//        type_code: type_code
//    };
//
//    $.ajax({
//        url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
//        type: "GET",
//        data: infotype,
//        dataType: 'json',
//        success: function (data) {
//
//            console.log(data);
//            $('#activityDescription').html('');
//            $('#activityDescription').append('<option value = ""> Choose... </option>');
//
//
//            $.each(data, function (i, item) {
//
//                $('#activityDescription').append($('<option>', {
//                    value: item.description_code,
//                    text: item.description_name
//                }));
//            });
//            $('#activityDescription').trigger("chosen:updated");
//
//
//        }
//    });
//}
//



getActivityParticipants();



function getActivityParticipants()
{
    if (activity_code == "") {
        console.log('do nothing');
    } else {

        var info = {
            activity_code: activity_code,
            type: "retreiveActivityParticipants"

        };
        $.ajax({
            url: '../controllers/BeneficiaryController.php?_=' + new Date().getTime(),
            type: "GET",
            data: info,
            success: function (data) {


                console.log('data is : ' + data);


                datatable.clear().draw();
                var obj = jQuery.parseJSON(data);
                if (obj.length == 0) {
                    console.log("NO DATA!");
                } else {
                    console.log("yes DATA!");
                    var rowNum = 0;
                    $.each(obj, function (key, value) {
                        var j = -1;
                        var r = new Array();
                        r[++j] = "<td>" + value.code + "</td>";
                        r[++j] = "<td> " + value.name + "</td>";
                        r[++j] = "<td>" + value.gender + "</td>";
                        r[++j] = "<td>" + value.email + "</td>";
                        r[++j] = "<td>" + value.contactno + "</td>";
                        r[++j] = "<td >" + value.district_name + "</td>";

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
