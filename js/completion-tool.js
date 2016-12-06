
//var datatable = $('#participantsTbl').DataTable({
//    'ajax': 'https://api.myjson.com/bins/1us28',
//    'columnDefs': [
//        {
//            'targets': 0,
//            'checkboxes': {
//                'selectRow': true
//            }
//        }
//    ],
//    'select': {
//        'style': 'multi'
//    },
//    'order': [[1, 'asc']]
//});participantsListTbl

$('#participantsTbl').DataTable();

var datatable;


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

var reginfo = {
    type: "retreiveRegion"
};

$.ajax({
    url: '../controllers/ConfigurationController.php',
    type: "GET",
    data: reginfo,
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




function getDistrictsBasedOnRegion(region_code) {

    var infotype = {
        type: 'retreiveDistrictsBasedOnRegion',
        region_code: region_code
    };

    $.ajax({
        url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
        type: "GET",
        data: infotype,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $('#district').select2("destroy");
            $('#district').empty();

            $('#district').select2();
            $('#district').append('<option value = ""> Choose... </option>');


            $.each(data, function (i, item) {

                $('#district').append($('<option>', {
                    value: item.districts_code,
                    text: item.district_name
                }));
            });


        }
    });
}



$("#region").change(function () {

    var region_code = this.value;
    console.log(region_code);

    getDistrictsBasedOnRegion(region_code);

    var region = region_code;
    var category = $('#category').val();

    $('#participantsTbl').dataTable().fnDestroy();

    getBeneficiaries(region, category);
});



$("#category").change(function () {
    var region = $('#region').val();
    var category = this.value;
    var categoryText = $('option:selected', $(this)).text();
    $('.holder').html(categoryText + '(s)');
    console.log('dnd' + category + ' ' + region);
    $('#participantsTbl').dataTable().fnDestroy();
    getBeneficiaries(region, category);
});



//call beneficiaries based on district code

$("#district").change(function () {

    var district_code = this.value;
    console.log('code is ' + district_code);

});




function getBeneficiaries(regcode, catcode)
{
    if (regcode == "" || catcode == "") {
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
                    "regcode": regcode,
                    "catcode": catcode,
                    type: "getBeneficiaries"
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

$('#attachParticipantsForm').on('submit', function (e) {
    e.preventDefault();
    var rows = $('tr.selected');
    var gender = [];
    var ids = [];
    var males = 0;
    var females = 0;
    var rowData = datatable.rows(rows).data();
    var rows_selected = datatable.column(0).checkboxes.selected();

    console.log(rowData);
    $.each($(rowData), function (key, value) {

        //  console.log($(this)); //"name" being the value of your first column.
        ids.push($(this)[1]); //"name" being the value of your first column.
        gender.push($(this)[3]); //"name" being the value of your first column.

    });
//    console.log('names:'+ rows_selected);
    console.log(ids);
    console.log(gender);
    console.log(ids.length);
    jQuery.each(gender, function (i, val) {
        if (val === "male") {
            console.log('male is ' + val);
            males = males + 1;
        } else {
            females = females + 1;
        }

    });
    $('#totalParticipants').val(ids.length);
    $('#femaleParticipants').val(females);
    $('#maleParticipants').val(males);
    $('#participants').val(ids);
    $('#participantsModal').modal('hide');
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

            $('#activityDescription').select2("destroy");
            $('#activityDescription').empty();

            $('#activityDescription').select2();
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





//new activity

$('#completionTooLActivityForm').on('submit', function (e) {
    e.preventDefault();
    $('input:submit').attr("disabled", false);
    //  var formData = $(this).serialize();
    // console.log(formData);

    var formData = new FormData(this); // <-- 'this' is your form element



    $.ajax({
        url: '../controllers/ActivityController.php?_=' + new Date().getTime(),
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (data) {

            console.log(data);


            var successStatus = data.success;

            if (successStatus == 1) {
             ///   $('.select2').select2('val', '');
                document.getElementById("completionTooLActivityForm").reset();

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

            }
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });


});



//list activities
var datatable = $('#activitiesListTbl').DataTable({
    responsive: true,
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    },
    order: [[0, "asc"]]

});


getActivitiesList();
function getActivitiesList()
{

    var info = {
        type: "retreiveCompletionToolActivity"
    };


    $.ajax({
        url: '../controllers/ActivityController.php?_=' + new Date().getTime(),
        type: "POST",
        data: info,
        success: function (data) {


            datatable.clear().draw();
//
            var obj = jQuery.parseJSON(data);
            console.log('size' + obj.length);
            if (obj.length == 0) {
                console.log("NO DATA!");
            } else {
                $.each(obj, function (key, value) {


                    var j = -1;
                    var r = new Array();
                    // represent columns as array
//                    r[++j] = '<td >' + value.code + '</td>';
                    r[++j] = '<td >' + value.activity_date + '</td>';
                    r[++j] = '<td >' + value.activity_type_name + '</td>';
                    r[++j] = '<td >' + value.activity_description_name + '</td>';
                    r[++j] = '<td >' + value.category_name + '</td>';
                    r[++j] = '<td >' + value.region_name + '</td>';
                    r[++j] = '<td >' + value.district_name + '</td>';
//                    r[++j] = '<td >' + value.community + '</td>';
                    r[++j] = '<td >' + value.implementer + '</td>';
                    r[++j] = '<td >' + value.total + '</td>';



                    r[++j] = '<td><a href="completion-tool-activity-detail?activity_code=' + value.code + '" class="btn btn-outline-info btn-sm col-sm-6" ><i class="fa fa-edit"></i><span class="hidden-md hidden-sm hidden-xs">Edit</span></a>\n\
                              <button onclick="deleteRegion(\'' + value.code + '\',\'' + value.activity_type_name + '\')" class="btn btn-outline-danger btn-sm  col-sm-6" type="button"><i class="fa fa-trash-o"></i><span class="hidden-md hidden-sm hidden-xs">Delete</span></button></td>';

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

//get activity code

