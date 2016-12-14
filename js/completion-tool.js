


var patricipantsdatatable = $('#participantsTbl').DataTable({
    responsive: true,
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    },
    order: [[0, "asc"]]
});


var info = {
    type: "retreiveActivityTypes"
};

$.ajax({
    url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
    type: "GET",
    data: info,
    dataType: 'json',
    success: function (data) {


        $.each(data, function (i, item) {

            $('#activityType').append($('<option>', {
                value: item.code,
                text: item.name
            }));
        });

    }
});

var info = {
    type: "retreiveCategories"
};

$.ajax({
    url: '../controllers/ConfigurationController.php',
    type: "GET",
    data: info,
    dataType: 'json',
    success: function (data) {


        $.each(data, function (i, item) {

            $('#category').append($('<option>', {
                value: item.code,
                text: item.name
            }));
        });

    }
});

var reginfo = {
    type: "retreiveRegion"
};

$.ajax({
    url: '../controllers/ConfigurationController.php',
    type: "GET",
    data: reginfo,
    dataType: 'json',
    success: function (data) {


        $.each(data, function (i, item) {

            $('#region').append($('<option>', {
                value: item.code,
                text: item.name
            }));
        });

    }
});




function getDistrictsBasedOnRegion(region_code) {

    var infotype = {
        type: 'retreiveDistrictsBasedOnRegion',
        region_code: region_code
    };

    $.ajax({
        url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
        type: "GET",
        data: infotype,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $('#district').select2("destroy");
            $('#district').empty();

            $('#district').select2();
            $('#district').append('<option value = ""> Choose... </option>');


            $.each(data, function (i, item) {

                $('#district').append($('<option>', {
                    value: item.districts_code,
                    text: item.district_name
                }));
            });


        }
    });
}



$("#region").change(function () {

    var region_code = this.value;
    getDistrictsBasedOnRegion(region_code);


    var categoryValues = $('#category').val();
    console.log(categoryValues);

    getBeneficiaries(region_code, categoryValues);
});


//
$("#category").change(function () {
    var region = $('#region').val();
    var categoryValues = $('#category').val();
    console.log(categoryValues);

    var categoriesSelected = $('#category :selected').map(function (i, opt) {
        return $(opt).text();
    }).toArray().join(', ');


    $('.holder').html(categoriesSelected);

    getBeneficiaries(region, categoryValues);
});
//


//call beneficiaries based on district code

$("#district").change(function () {

    var district_code = this.value;
    console.log('code is ' + district_code);

});






function getBeneficiaries(regcode, catcode)
{
    if (regcode == "" || catcode == "") {
        console.log('do nothing');
    }

    console.log(regcode + 'category: ' + catcode);

    var info = {
        "regcode": regcode,
        "catcode": catcode,
        type: "getBeneficiaries"
    };
    $.ajax({
        url: '../controllers/BeneficiaryController.php?_=' + new Date().getTime(),
        type: "GET",
        data: info,
        success: function (data) {


            console.log('data is : ' + data);


            patricipantsdatatable.clear().draw();
            var obj = jQuery.parseJSON(data);
            if (obj.length == 0) {
                console.log("NO DATA!");
            } else {
                console.log("yes DATA!");
                var rowNum = 0;
                $.each(obj, function (key, value) {
                    var j = -1;
                    var r = new Array();
                    r[++j] = '<td><input type="checkbox"/></td>';
                    r[++j] = '<td>' + value.code + '</td>';
                    r[++j] = '<td> ' + value.name + '</td>';
                    r[++j] = '<td>' + value.gender + '</td>';
                    r[++j] = '<td>' + value.email + '</td>';
                    r[++j] = '<td>' + value.contactno + '</td>';
                    r[++j] = '<td >' + value.district_name + '</td>';

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




$("#activityType").change(function () {
    console.log(this.value);
    getDescriptionBasedOnActivityType(this.value);

});




function getDescriptionBasedOnActivityType(type_code) {

    var infotype = {
        type: 'retreiveDescriptionBasedOnActivityType',
        type_code: type_code
    };

    $.ajax({
        url: '../controllers/ConfigurationController.php?_=' + new Date().getTime(),
        type: "GET",
        data: infotype,
        dataType: 'json',
        success: function (data) {

            $('#activityDescription').select2("destroy");
            $('#activityDescription').empty();

            $('#activityDescription').select2();
            $('#activityDescription').append('<option value = ""> Choose... </option>');


            $.each(data, function (i, item) {

                $('#activityDescription').append($('<option>', {
                    value: item.description_code,
                    text: item.description_name
                }));
            });
            $('#activityDescription').trigger("chosen:updated");


        }
    });
}





//new activity

$('#completionTooLActivityForm').on('submit', function (e) {
    e.preventDefault();
    $('input:submit').attr("disabled", false);
    //  var formData = $(this).serialize();
    // console.log(formData);

    var formData = new FormData(this); // <-- 'this' is your form element



    $.ajax({
        url: '../controllers/ActivityController.php?_=' + new Date().getTime(),
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (data) {

            console.log(data);


            var successStatus = data.success;

            if (successStatus == 1) {
                ///   $('.select2').select2('val', '');
                document.getElementById("completionTooLActivityForm").reset();

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



//list activities
var datatable = $('#activitiesListTbl').DataTable({
    responsive: true,
    language: {
        paginate:
                {previous: "&laquo;", next: "&raquo;"},
        search: "_INPUT_",
        searchPlaceholder: "Search…"
    },
    order: [[0, "asc"]]

});


getActivitiesList();
function getActivitiesList()
{

    var info = {
        type: "retreiveCompletionToolActivity"
    };


    $.ajax({
        url: '../controllers/ActivityController.php?_=' + new Date().getTime(),
        type: "POST",
        data: info,
        success: function (data) {


            datatable.clear().draw();
//
            var obj = jQuery.parseJSON(data);
            console.log('size' + obj.length);
            if (obj.length == 0) {
                console.log("NO DATA!");
            } else {
                $.each(obj, function (key, value) {


                    var j = -1;
                    var r = new Array();
                    // represent columns as array
//                    r[++j] = '<td >' + value.code + '</td>';
                    r[++j] = '<td >' + value.activity_date + '</td>';
                    r[++j] = '<td >' + value.activity_type_name + '</td>';
                    r[++j] = '<td >' + value.activity_description_name + '</td>';
                    r[++j] = '<td >' + value.category_name + '</td>';
                    r[++j] = '<td >' + value.region_name + '</td>';
                    r[++j] = '<td >' + value.district_name + '</td>';
//                    r[++j] = '<td >' + value.community + '</td>';
                    r[++j] = '<td >' + value.implementer + '</td>';
                    r[++j] = '<td >' + value.total + '</td>';



                    r[++j] = '<td><a href="completion-tool-activity-detail?activity_code=' + value.code + '" class="btn btn-outline-info btn-sm col-sm-6" ><i class="fa fa-edit"></i><span class="hidden-md hidden-sm hidden-xs"></span></a>\n\
                              <button onclick="deleteActivity(\'' + value.code + '\')" class="btn btn-outline-danger btn-sm  col-sm-6" type="button"><i class="fa fa-trash-o"></i><span class="hidden-md hidden-sm hidden-xs"></span></button></td>';

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

//get activity code

function deleteActivity(code) {

    $('#code').val(code);
    $('#confirmModal').modal('show');
}


$('#deleteCompletionActivityForm').on('submit', function (e) {
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
            console.log(data);
            // $("#loader").hide();
            $('input:submit').attr("disabled", false);
            $('#loaderModal').modal('hide');
            var successStatus = data.success;
            document.getElementById("deleteCompletionActivityForm").reset();

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
                getActivitiesList();
            }
        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });

});

$('#participantsTbl').find('tbody').on('click', 'input[type="checkbox"]', function(e){
     console.log('mkmfkfmrk');
    var $row = $(this).closest('tr');
      if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }

      
      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

$('#participantsTbl').find('tbody').on('click', 'tr', function(e){
     console.log('llllll');
      
       var checkbox = document.querySelector('input[type="checkbox"]');
    checkbox.checked = 'true';
   
     var $row = $(this).addClass('selected');
     
      if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }
      
   

      
      // Prevent click event from propagating to parent
      e.stopPropagation();
   });
