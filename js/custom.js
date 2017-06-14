/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$('#changePasswordForm').on('submit', function (e) {
    e.preventDefault();


    var formData = $(this).serialize();
    console.log(formData);

    $('input:submit').attr("disabled", true);

    $.ajax({
        url: 'controllers/AccountController.php?_=' + new Date().getTime(),
        type: "POST",
        data: formData,
       dataType: "JSON",
        success: function (data) {
            console.log(data);


            // $("#loader").hide();
            $('#activityModal').modal('hide');
            var successStatus = data.success;
            document.getElementById("changePasswordForm").reset();

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

            }

        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });



});
