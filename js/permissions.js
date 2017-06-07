

var permissionsTbl = $('#permissionsTbl').DataTable({
    responsive: true,
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    },
    order: [[0, "asc"]]
});

getPermissions();
function getPermissions()
{

    var info = {
        type: "retreivePermissions"
    };
    $.ajax({
        url: 'controllers/AccountController.php?_=' + new Date().getTime(),
        type: "GET",
        data: info,
        success: function (data) {


            console.log('new code here 2');
            console.log(data);
            permissionsTbl.clear().draw();
            var obj = jQuery.parseJSON(data);
            console.log('size' + obj.length);
            if (obj.length == 0) {
                console.log("NO DATA!");
            } else {
                $.each(obj, function (key, value) {


                    var j = -1;
                    var r = new Array();
                    // represent columns as array
                    r[++j] = '<td>' + value.id + '</td>';
                    r[++j] = '<td>' + value.perm_keyword + '</td>';

                    rowNode = permissionsTbl.row.add(r);
                });
                rowNode.draw().node();
            }

        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown + " " + textStatus + " New Error: " + jXHR);
        }
    });
}



$('#savePermissionForm').on('submit', function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    console.log(formData);

    $('input:submit').attr("disabled", true);
    $.ajax({
        url: 'controllers/AccountController.php?_=' + new Date().getTime(),
        type: "POST",
        data: formData,
        dataType: "json",
        success: function (data) {
            $('input:submit').attr("disabled", false);
            console.log(data);
            // $("#loader").hide();
            $('#regionModal').modal('hide');
            var successStatus = data.success;
            document.getElementById("savePermissionForm").reset();
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
                getPermissions();
            }

        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });



});
//retreive regions
