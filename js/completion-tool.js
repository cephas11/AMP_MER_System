



$("#region").change(function () {

    var region_code = this.value;
    getDistrictsBasedOnRegion(region_code);
});
//call beneficiaries based on district code

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
                    r[++j] = '<td><a href="completion-tool-activity-detail?activity_code=' + value.code + '" disabled class="editBtn btn btn-outline-info btn-sm col-sm-6" ><i class="fa fa-edit"></i><span class="hidden-md hidden-sm hidden-xs"></span></a>\n\
                              <button onclick="deleteActivity(\'' + value.code + '\')" disabled class="deleteBtn btn btn-outline-danger btn-sm  col-sm-6 " type="button"><i class=" fa fa-trash-o"></i><span class="hidden-md hidden-sm hidden-xs"></span></button></td>';
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