/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var datatable = $('#activityTbl').DataTable({
    responsive: true,
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    },
    order: [[0, "asc"]]
});



$('#saveActivityForm').on('submit', function (e) {
    e.preventDefault();


    var formData = $(this).serialize();
    console.log(formData);
    
    $('input:submit').attr("disabled", true);

    $.ajax({
        url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
        type: "GET",
        data: formData,
        success: function (data) {
            console.log(data);
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });



});
