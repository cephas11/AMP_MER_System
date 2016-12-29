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
               if(data == 1){
                   $('.holder').html('Username and Password do not match');
               }else{
                   window.location="dashboard.php";
               }
            },
            error: function (jXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });



});
