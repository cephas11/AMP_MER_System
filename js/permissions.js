/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var info = {
    type: "formPermmission",
    formid: 9
};
$.ajax({
    url: '../controllers/AccountController.php?_=' + new Date().getTime(),
    type: "POST",
    data: info,
    dataType: 'json',
    success: function (data) {

//create staatus
        if (data.create_status == 'true') {
            $('#permisiontable').show();
        }


    }
});

//var patricipantsdatatable = $('#formsTbl').DataTable({
//    responsive: true,
//    language: {
//        paginate:
//                {previous: "&laquo;", next: "&raquo;"},
//        search: "_INPUT_",
//        searchPlaceholder: "Search…"
//    },
//    order: [[0, "asc"]]
//});

$("#userGroup").change(function () {

    $('input:checkbox').prop('checked', false);
    var userGroup = this.value;
    getGroupPermissions(userGroup);
});

function getGroupPermissions(usegroup) {
    var info = {
        type: "retreiveUserGroupPermissions",
        groupid: usegroup
    };
    $.ajax({
        url: '../controllers/AccountController.php?_=' + new Date().getTime(),
        type: "POST",
        data: info,
        dataType: "json",
        success: function (data) {

            console.log('data is : ' + data.message);
            var successStatus = data.success;
            console.log('sucess ' + successStatus);



            if (successStatus == 0) {

                $('#saveBtn').attr('Update');



                $.each(data.message, function (counter, item) {
                    // console.log('creeate status ' + item.create_status);
                    var create = (item.create_status === 'true');
                    var edit = (item.edit_status === 'true');
                    var view = (item.view_status === 'true');
                    var deletest = (item.delete_status === 'true');





                    $('#all' + counter).prop('checked', create);
                    $('#view' + counter).prop('checked', view);
                    $('#edit' + counter).prop('checked', edit);
                    $('#delete' + counter).prop('checked', deletest);



                    //   $('#all' + 1).attr('checked', true);
                    //  $('#all' + 2).attr('checked', true);
                    console.log(counter);

                });
            }

        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });

}





getForms();
function getForms()
{

    var info = {
        type: "retreiveForms"
    };
    $.ajax({
        url: '../controllers/AccountController.php?_=' + new Date().getTime(),
        type: "GET",
        data: info,
        success: function (data) {


            console.log('data is : ' + data);

            var obj = jQuery.parseJSON(data);
            if (obj.length == 0) {
                console.log("NO DATA!");
            } else {

                $('#total').val(obj.length);
                console.log("yes DATA!");

                var rowNum = 0;
                $.each(obj, function (key, value) {
                    var j = -1;
                    var r = new Array();
                    var tr = "<tr><td ><label id='cols" + rowNum + "' >" + value.id + "</label> </td>"
                            + "<td> " + value.name + "</td>"
                            + "<td><input type='checkbox' id='all" + rowNum + "' name='all[]'/></td>"

                            + "<td><input type='checkbox' id='view" + rowNum + "'   name='view[]'/></td>"
                            + "<td><input type='checkbox' id='edit" + rowNum + "' name='edit[]'/></td>"
                            + "<td><input type='checkbox' id='delete" + rowNum + "' name='delete[]'/></td></tr>";

                    rowNum = rowNum + 1;
                    $(tr).appendTo("tbody");

                });

            }





        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });

}



var info = {
    type: "retreiveUserGroups"
};

$.ajax({
    url: '../controllers/AccountController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    dataType: 'json',
    success: function (data) {


        $.each(data, function (i, item) {

            $('#userGroup').append($('<option>', {
                value: item.id,
                text: item.name
            }));
        });

    }
});

$('#permissionsForm').on('submit', function (e) {
    e.preventDefault();
    var total = $('#total').val();
    var usergroup = $('#userGroup').val();

    var jsonObj = [];
    var id, view, edit, deletestatus, all;
    for ($i = 0; $i < total; $i++) {
        id = $('#cols' + $i).html();
        view = $('#view' + $i).is(':checked');
        edit = $('#edit' + $i).is(':checked');
        deletestatus = $('#delete' + $i).is(':checked');
        all = $('#all' + $i).is(':checked');


        item = {};
        item ["formid"] = id;
        item ["view"] = '' + view + '';
        item ["edit"] = '' + edit + '';
        item ["deletestatus"] = '' + deletestatus + '';
        item ["all"] = '' + all + '';

        jsonObj.push(item);

    }
    var permissions = JSON.stringify(jsonObj);
    var info = {
        usergroup: usergroup,
        jsonObj: permissions,
        type: 'savePermissionRoles'
    };
    $('#loaderModal').modal('show');

    $.ajax({
        url: '../controllers/AccountController.php?_=' + new Date().getTime(),
        type: "POST",
        data: info,
        dataType: 'json',
        success: function (data) {

            console.log(data);
            var successStatus = data.success;
            $('#loaderModal').modal('hide');

            if (successStatus == 1) {
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
            } else {
                Command: toastr["warning"](data.message, "Warning");

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

        }
    });
//function refreshPage() { location.reload(); }
//    // console.log(JSON.stringify(jsonObj));


});

  $('#assign_all').click(function () {

        $('tbody tr td input[type="checkbox"]').each(function () {
            $(this).prop('checked', true);
        });

    });