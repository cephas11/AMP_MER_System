/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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

getPermissions();
function getPermissions()
{

    var info = {
        type: "retreivePermissions"
    };
    $.ajax({
        url: '../controllers/AccountController.php?_=' + new Date().getTime(),
        type: "GET",
        data: info,
        success: function (data) {

            console.log(data);

            var obj = jQuery.parseJSON(data);
            console.log('size' + obj.length);
            if (obj.length == 0) {
                console.log("NO DATA!");
            } else {
                var trHTML;
                $.each(obj, function (key, value) {


                    var j = -1;
                    var r = new Array();
                    // represent columns as array
                    trHTML += '<tr><td>' + value.id + '</td>' +
                            '<td>' + value.perm_keyword + '</td>' +
                            '<td><input type="checkbox" name="permissions[]" value="' + value.perm_keyword + '"/></td></tr>';

                });
                $('tbody').append(trHTML);

            }

        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown + " " + textStatus + " New Error: " + jXHR);
        }
    });
}

$('#assign_all').click(function () {

    $('tbody tr td input[type="checkbox"]').each(function () {
        $(this).prop('checked', true);
    });

});


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
        success: function (response) {

            console.log('responseis ' + response);

            var successStatus = response.success;
            console.log('sucess ' + successStatus);



            if (successStatus == 0) {
                $('#saveBtn').attr('Update');


                $.each(response.message, function (counter, val) {
                    console.log('perm code is:' + val.perm_keyword);
                    $("input[value='" + val.perm_keyword + "']").prop('checked', true);
                });

            } else {

//                    $("#assignuserbtn").prop('value', 'Update');

            }

        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });

}



$('#assignPermissionsForm').on('submit', function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    console.log(formData);

    $('#loaderModal').modal('show');

    $.ajax({
        url: '../controllers/AccountController.php?_=' + new Date().getTime(),
        type: "POST",
        data: formData,
        dataType: 'json',
        success: function (data) {

            console.log('server data :' + data);
            var successStatus = data.success;
            $('#loaderModal').modal('hide');
//
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
////function refreshPage() { location.reload(); }
////    // console.log(JSON.stringify(jsonObj));


});

//assign permissions to usergroup



