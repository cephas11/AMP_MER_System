/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var patricipantsdatatable = $('#formsTbl').DataTable({
    responsive: true,
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    },
    order: [[0, "asc"]]
});



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


            patricipantsdatatable.clear().draw();
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
                    r[++j] = "<td ><label id='cols" + rowNum + "' >" + value.id + "</label> </td>";
                    r[++j] = "<td> " + value.name + "</td>";
                    r[++j] = "<td><input type='checkbox' id='view" + rowNum + "'   name='view[]'/></td>";
                    r[++j] = "<td><input type='checkbox' id='edit" + rowNum + "' name='edit[]'/></td>";
                    r[++j] = "<td><input type='checkbox' id='delete" + rowNum + "' name='delete[]'/></td>";
                    r[++j] = "<td><input type='checkbox' id='all" + rowNum + "' name='all[]'/></td>";

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
        item ["view"] = ''+view+'';
        item ["edit"] = ''+edit+'';
        item ["deletestatus"] = ''+deletestatus+'';
        item ["all"] = ''+all+'';

        jsonObj.push(item);

    }
var permissions = JSON.stringify(jsonObj);
    var info = {
        usergroup: usergroup,
        jsonObj: permissions,
        type: 'savePermissionRoles'
    };

    $.ajax({
        url: '../controllers/AccountController.php?_=' + new Date().getTime(),
        type: "POST",
        data: info,
        dataType: 'json',
      
        success: function (data) {

            console.log(data);
            var successStatus = data.success;

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
                    setInterval('refreshPage', 5000);
                }else{
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
                 //   setInterval(location.relo, 5000);
                }

        }
    });
//function refreshPage() { location.reload(); }
//    // console.log(JSON.stringify(jsonObj));


});
