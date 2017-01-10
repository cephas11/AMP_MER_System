



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


$('#saveUserForm').on('submit', function (e) {
    e.preventDefault();

    var formData = $(this).serialize();
    $('input:submit').attr("disabled", true);

    $.ajax({
        url: '../controllers/AccountController.php?_=' + new Date().getTime(),
        type: "POST",
        data: formData,
        dataType: "json",
        success: function (data) {
            $('input:submit').attr("disabled", false);
            console.log(data);
            // $("#loader").hide();
            $('#regionModal').modal('hide');
            var successStatus = data.success;
            document.getElementById("saveUserForm").reset();

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
                getUsers();

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

        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });




});


var datatable = $('#usersTbl').DataTable({
    responsive: true,
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    },
    order: [[0, "asc"]]
});






getUsers();

function getUsers()
{

    var info = {
        type: "retreiveUsers"
    };
    console.log('new code here');

    $.ajax({
        url: '../controllers/AccountController.php?_=' + new Date().getTime(),
        type: "GET",
        data: info,
        success: function (data) {
            // alert(data);
            console.log('new code here 2');
            console.log(data);
            datatable.clear().draw();

            var obj = jQuery.parseJSON(data);
            console.log('size' + obj.length);
            if (obj.length == 0) {
                console.log("NO DATA!");
            } else {
                $.each(obj, function (key, value) {


                    var j = -1;
                    var r = new Array();
                    // represent columns as array
                    r[++j] = '<td >' + value.name + '</td>';
                    r[++j] = '<td>' + value.username + '</td>';
                    r[++j] = '<td>' + value.email + '</td>';
                    r[++j] = '<td>' + value.phoneno + '</td>';
                    r[++j] = '<td>' + value.usergroup_name + '</td>';
                    r[++j] = '<td>' + value.createdby + '</td>';

                    r[++j] = '<td><button onclick="editUser(\'' + value.code + '\',\'' + value.name + '\')" class="btn btn-outline-info btn-sm editBtn" disabled type="button">Edit</button>\n\
                              <button onclick="deleteUser(\'' + value.code + '\',\'' + value.name + '\')" class="btn btn-outline-danger btn-sm deleteBtn" disabled type="button">Delete</button></td>';

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


function deleteUser(code, title) {
    console.log(code + title);
    $('#userid').val(code);
    $('#userholder').html(title);
    $('#confirmModal').modal('show');
}


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
            $('#createUserBtn').show();
        }
        if (data.edit_status == 'true') {
            $('.editBtn').removeAttr('disabled');
            
        }
        if (data.delete_status == 'true') {
            $('.deleteBtn').removeAttr('disabled');
        }

    }
});

