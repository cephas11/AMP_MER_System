

//save region

$('#saveUserGroupForm').on('submit', function (e) {
    e.preventDefault();

     var formData = $(this).serialize();
    console.log(formData);
    
        
        $('input:submit').attr("disabled", true);

        $.ajax({
            url: '../controllers/AccountController.php?_=' + new Date().getTime(),
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (data) {
                $('input:submit').attr("disabled", false);
                console.log('rerereer'+data);
                // $("#loader").hide();
                $('#userGroupModal').modal('hide');
                var successStatus = data.success;
                document.getElementById("saveUserGroupForm").reset();

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
                    getUserGroups();
                
                }else{
                   Command: toastr["danger"](data.message, "Error");

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

//retreive regions

var datatable = $('#usergroupsTbl').DataTable({
    responsive: true,
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    },
    order: [[0, "asc"]]
});

getUserGroups();

function getUserGroups()
{

    var info = {
        type: "retreiveUserGroups"
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
                    r[++j] = '<td>' + value.name + '</td>';
                    r[++j] = '<td><button onclick="editUserGroup(\'' + value.id + '\',\'' + value.name + '\')" class="btn btn-outline-info btn-sm" type="button">Edit</button>\n\
                              <button onclick="deleteUserGroup(\'' + value.id + '\',\'' + value.name + '\')" class="btn btn-outline-danger btn-sm" type="button">Delete</button></td>';

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


function editUserGroup(id,name) {
    //alert('goood');
    $('#code').val(id);
    $('#usergroupdetail').val(name);
    $('#editModal').modal('show');
}


function deleteUserGroup(code, title) {
    console.log(code + title);
    $('#groupid').val(code);
    $('#regionholder').html(title);
    $('#confirmModal').modal('show');
}


$('#deleteUserGroupForm').on('submit', function (e) {
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
            // $("#loader").hide();
            $('input:submit').attr("disabled", false);
            $('#loaderModal').modal('hide');
            var successStatus = data.success;
            document.getElementById("deleteUserGroupForm").reset();

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
                getUserGroups();
            }
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });

});


$('#updateUserGroupForm').on('submit', function (e) {
    e.preventDefault();
    $('input:submit').attr("disabled", true);
    var formData = $(this).serialize();
    console.log(formData);
    $('#editModal').modal('hide');
    $('#loaderModal').modal('show');

    $.ajax({
        url: '../controllers/AccountController.php?_=' + new Date().getTime(),
        type: "POST",
        data: formData,
        dataType: "json",
        success: function (data) {
            // $("#loader").hide();
            $('input:submit').attr("disabled", false);
            $('#loaderModal').modal('hide');
            var successStatus = data.success;
         
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
                getUserGroups();
            }
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });

});

