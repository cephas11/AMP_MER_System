


var rows_selected = [];
var genders = [];
var beneficiarynames = [];
var patricipantsdatatable = $('#participantsTbl').DataTable({
    'columnDefs': [
        {
            'targets': 0,
            'searchable': false,
            'orderable': false,
            'width': '1%',
            'className': 'dt-body-center',
            'render': function (data, type, full, meta) {
                return '<input type="checkbox">';
            }
        }],
    'order': [[1, 'asc']],
    'rowCallback': function (row, data, dataIndex) {
        // Get row ID
        var rowId = data[1];
        // If row ID is in the list of selected row IDs
        if ($.inArray(rowId, rows_selected) !== -1) {
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
        }
    }
});
function updateDataTableSelectAllCtrl(table) {
    var $table = table.table().node();
    var $chkbox_all = $('tbody input[type="checkbox"]', $table);
    var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
    var chkbox_select_all = $('thead input[name="select_all"]', $table).get(0);
    // If none of the checkboxes are checked
    if ($chkbox_checked.length === 0) {
        chkbox_select_all.checked = false;
        if ('indeterminate' in chkbox_select_all) {
            chkbox_select_all.indeterminate = false;
        }

        // If all of the checkboxes are checked
    } else if ($chkbox_checked.length === $chkbox_all.length) {
        chkbox_select_all.checked = true;
        if ('indeterminate' in chkbox_select_all) {
            chkbox_select_all.indeterminate = false;
        }

        // If some of the checkboxes are checked
    } else {
        chkbox_select_all.checked = true;
        if ('indeterminate' in chkbox_select_all) {
            chkbox_select_all.indeterminate = true;
        }
    }
}


// Handle click on checkbox
$('#participantsTbl tbody').on('click', 'input[type="checkbox"]', function (e) {
    var $row = $(this).closest('tr');
    console.log($row.find("td").eq(1).text());
    // Get row data
    ///  var data = patricipantsdatatable.row($row).data();
    // Get row ID
    var rowId = $row.find("td").eq(1).text();
    var beneficiaryname = $row.find("td").eq(2).text();
    var gender = $row.find("td").eq(3).text();

    // Determine whether row ID is in the list of selected row IDs 
    var index = $.inArray(rowId, rows_selected);
    // If checkbox is checked and row ID is not in list of selected row IDs
    if (this.checked && index === -1) {
        rows_selected.push(rowId);
        genders.push(gender);
        beneficiarynames.push(beneficiaryname);
        // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
    } else if (!this.checked && index !== -1) {
        rows_selected.splice(index, 1);
        genders.splice(index, 1);
        beneficiarynames.splice(index, 1);
    }

    if (this.checked) {
        $row.addClass('selected');
    } else {
        $row.removeClass('selected');
    }

// Update state of "Select all" control
    updateDataTableSelectAllCtrl(patricipantsdatatable);
    // Prevent click event from propagating to parent
    e.stopPropagation();
});
// Handle click on table cells with checkboxes
$('#participantsTbl').on('click', 'tbody td, thead th:first-child', function (e) {
    $(this).parent().find('input[type="checkbox"]').trigger('click');
});
// Handle click on "Select all" control
$('thead input[name="select_all"]', patricipantsdatatable.table().container()).on('click', function (e) {
    if (this.checked) {
        $('#participantsTbl tbody input[type="checkbox"]:not(:checked)').trigger('click');
    } else {
        $('#participantsTbl tbody input[type="checkbox"]:checked').trigger('click');
    }

// Prevent click event from propagating to parent
    e.stopPropagation();
});
// Handle table draw event
patricipantsdatatable.on('draw', function () {
    // Update state of "Select all" control
    updateDataTableSelectAllCtrl(patricipantsdatatable);
});
function selectParticipants() {

    var region = $('#region').val();
    var categoryValues = $('#category').val();
    if (region == "" || categoryValues == " ") {
        console.log('empty');
    } else {
        $('#category').prop('disabled', true);
        $('#region').prop('disabled', true);
        console.log(categoryValues + 'region is ' + region);
        var categoriesSelected = $('#category :selected').map(function (i, opt) {
            return $(opt).text();
        }).toArray().join(', ');
        $('.holder').html(categoriesSelected);
        getBeneficiaries(region, categoryValues);
        $('#participantsModal').modal('show');
    }

}



function getBeneficiaries(regcode, catcode)
{
    if (regcode == "" || catcode == "") {
        console.log('do nothing');
    }

    console.log(regcode + 'category: ' + catcode);

    var info = {
        "regcode": regcode,
        "catcode": catcode,
        type: "getBeneficiaries"
    };
    $.ajax({
        url: '../controllers/BeneficiaryController.php?_=' + new Date().getTime(),
        type: "GET",
        data: info,
        success: function (data) {


            console.log('data is : ' + data);


            patricipantsdatatable.clear().draw();
            var obj = jQuery.parseJSON(data);
            if (obj.length == 0) {
                console.log("NO DATA!");
            } else {
                console.log("yes DATA!");
                var rowNum = 0;
                $.each(obj, function (key, value) {
                    var j = -1;
                    var r = new Array();
                    r[++j] = "<td><input type='checkbox'/></td>";
                    r[++j] = "<td>" + value.code + "</td>";
                    r[++j] = "<td> " + value.name + "</td>";
                    r[++j] = "<td>" + value.gender + "</td>";
                    r[++j] = "<td>" + value.email + "</td>";
                    r[++j] = "<td>" + value.contactno + "</td>";
                    r[++j] = "<td >" + value.district_name + "</td>";

                    rowNum = rowNum + 1;


                    rowNode = patricipantsdatatable.row.add(r);
                });

                rowNode.draw().node();
            }





        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });

}


$('#attachParticipants').click(function () {
    $("#loadbeneficiaries ul").html('');
    console.log(genders);
    console.log(beneficiarynames);
    var names = "" + beneficiarynames + "";
    var array = names.split(",");
    $.each(array, function (i) {
        $("#loadbeneficiaries ul").append("<li>" + array[i] + "</li>");
    });
    //loaderModal
    $('#loaderModal').modal('show');
    $('#participantsModal').modal('hide');
    $('#displaybeneficairiesModal').modal('show');
});

//confirmParticipants


$('#participantsForm').on('submit', function (e) {
    e.preventDefault();

    //  $('#participantsselected').attr("disabled", false);
    $('#participantsselected').attr("disabled", "disabled");

    $('#participantsselected').removeClass("btn-danger ");
    $('#participantsselected').addClass("btn-primary");
    $('#participantsselected').text('Participants Selected');
    $('#displaybeneficairiesModal').modal('hide');
    $('#loaderModal').modal('show');
    console.log(genders);
    console.log(beneficiarynames);
    var gender = "" + genders + "";
    var array = gender.split(",");
    var males = 0;
    var females = 0;
    var totalParticipants = rows_selected.length;
    $.each(array, function (i) {

        if (array[i] = "female") {
            females++;
        } else {
            males++;
        }

    });
    console.log(rows_selected.length);
    $('#maleParticipants').val(males);
    $('#femaleParticipants').val(females);
    $('#totalParticipants').val(totalParticipants);
    $('#participants').val(rows_selected);

    $('#loaderModal').modal('hide');

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
    getDistrictsBasedOnRegion(region_code);
});
//call beneficiaries based on district code

$("#district").change(function () {

    var district_code = this.value;
    console.log('code is ' + district_code);
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
    $('#category').prop('disabled', false);
    $('#region').prop('disabled', false);

    $('#loaderModal').modal('show');
    var formData = $(this).serialize();
    console.log(formData);

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
            $('#loaderModal').modal('hide');
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
                window.setTimeout(function () {
                    location.href = "completion-tool";
                }, 2000);

            } else {



                $('input:submit').attr("disabled", false);
                Command: toastr["error"](data.message, "Success");
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
//******************************for main activities page**********************

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
                    r[++j] = '<td >' + value.region_name + '</td>';
                    r[++j] = '<td >' + value.district_name + '</td>';
//                    r[++j] = '<td >' + value.community + '</td>';
                    r[++j] = '<td >' + value.implementer + '</td>';
                    r[++j] = '<td >' + value.total + '</td>';
                    r[++j] = '<td><a href="completion-tool-activity-detail?activity_code=' + value.code + '" class="btn btn-outline-info btn-sm col-sm-6" ><i class="fa fa-edit"></i><span class="hidden-md hidden-sm hidden-xs"></span></a>\n\
                              <button onclick="deleteActivity(\'' + value.code + '\')" class="btn btn-outline-danger btn-sm  col-sm-6" type="button"><i class="fa fa-trash-o"></i><span class="hidden-md hidden-sm hidden-xs"></span></button></td>';
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

function deleteActivity(code) {

    $('#code').val(code);
    $('#confirmModal').modal('show');
}


$('#deleteCompletionActivityForm').on('submit', function (e) {
    e.preventDefault();
    $('input:submit').attr("disabled", true);
    var formData = $(this).serialize();
    console.log(formData);
    $('#confirmModal').modal('hide');
    $('#loaderModal').modal('show');
    $.ajax({
        url: '../controllers/deleteController.php?_=' + new Date().getTime(),
        type: "POST",
        data: formData,
        dataType: "json",
        success: function (data) {
            console.log(data);
            // $("#loader").hide();
            $('input:submit').attr("disabled", false);
            $('#loaderModal').modal('hide');
            var successStatus = data.success;
            document.getElementById("deleteCompletionActivityForm").reset();
            if (successStatus == 1) {
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
                getActivitiesList();
            }
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
});




var info = {
    type: "formPermmission",
    formid: 4
};
$.ajax({
    url: '../controllers/AccountController.php?_=' + new Date().getTime(),
    type: "POST",
    data: info,
    dataType: 'json',
    success: function (data) {

//create staatus
        if (data.create_status == 'true') {
            $('#creatediv').show();
        }
        if (data.edit_status == 'true') {
            $('.editBtn').removeAttr('disabled');
        }
        if (data.delete_status == 'true') {

            $('.deleteBtn').removeAttr('disabled');
        }

    }
});


