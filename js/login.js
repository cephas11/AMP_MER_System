/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$('#loginForm').on('submit', function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    console.log(formData);

    $('input:submit').attr("disabled", true);

    $.ajax({
        url: 'controllers/AccountController.php?_=' + new Date().getTime(),
        type: "POST",
        data: formData,
        success: function (data) {
            console.log(data);
            if (data == 1) {
                $('.holder').html('Username and Password do not match');
            } else {
                window.location = "dashboard.php";
            }
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });



});


//forgot password


$('#forgotpasswprdForm').on('submit', function (e) {
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
            console.log(data);
            var status = data.success;
            if (status == 0) {
                $('.holder').html(data.message);
            } else {
                swal({
                    title: "Success",
                    text: data.message,
                    type: "success",
                    confirmButtonText: "OK",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        window.location = "index.php";
                    }
                });
            }
//               if(data == 1){
//                   $('.holder').html('Username and Password do not match');
//               }else{
//                   window.location="dashboard.php";
//               }
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });



});



$('#resetPassworrdForm').on('submit', function (e) {
    e.preventDefault();

    var password = $('#password').val();
    var confirm_password = $('#confirm_password').val();

    if (password == confirm_password) {

        var formData = $(this).serialize();
        console.log(formData);

        $('input:submit').attr("disabled", true);

        $.ajax({
            url: 'controllers/AccountController.php?_=' + new Date().getTime(),
            type: "POST",
            data: formData,
            //   dataType: "json",
            success: function (data) {
                console.log(data);
                var status = data.success;

                if (status == 0) {
                    $('.holder').html(data.message);
                } else {
                    swal({
                        title: "Success",
                        text: data.message,
                        type: "success",
                        confirmButtonText: "OK",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            window.location = "index.php";
                        }
                    });
                }
//               if(data == 1){
//                   $('.holder').html('Username and Password do not match');
//               }else{
//                   window.location="dashboard.php";
//               }
            },
            error: function (jXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

    } else {
        alert('Password do not match');
    }




});


var auditdatatable = $('#auditTbl').DataTable({
    responsive: true,
    dom: 'Bfrtip',
    buttons: [
        'copyHtml5',
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5'
    ],
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    }

});


$.ajax({
    url: 'controllers/AccountController.php?_=' + new Date().getTime(),
    type: "GET",
    data: {type: "auditlogs"},
    success: function (data) {
//acctivityTbl

        console.log('response :' + data);
        auditdatatable.clear().draw();
        var obj = jQuery.parseJSON(data);
        if (obj.length == 0) {
            console.log("NO DATA!");
        } else {

            var rowNum = 0;
            $.each(obj, function (key, value) {
                var j = -1;
                var r = new Array();
                r[++j] = '<td>' + value.username + '</td>';
                r[++j] = '<td> ' + value.activity + '</td>';
                r[++j] = '<td>' + value.dateacreated + '</td>';

                rowNum = rowNum + 1;


                rowNode = auditdatatable.row.add(r);
            });

            rowNode.draw().node();
        }



    }
});

