

//save region

$('#saveRegionForm').on('submit', function (e) {
    e.preventDefault();

    // var validator = $("#saveRegionForm").validate();
    var region = $('#region').val();
    var formData = $(this).serialize();
    console.log(formData);
    if (region == "") {

        alert('empty');
    } else {
        var info = {
            region: region
        };
        $('input:submit').attr("disabled", true);

        $.ajax({
            url: 'controllers/ConfigurationController.php',
            type: "GET",
            data: formData,
            dataType: "json",
            success: function (data)
            {
                $('input:submit').attr("disabled", false);
                console.log(data);

                var successStatus = data.success;
                document.getElementById("saveRegionForm").reset();
                //$("#regionTbl ").removeData();
                  
                $("#regionstb").find("tr:not(:first)").remove();
        

                if (successStatus == 1) {

                    alert('saved');
                getRegions();
                }
            },
            error: function (jXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

    }


});

//retreive regions

////

getRegions();

function getRegions()
{

    var info = {
        type: "retreiveRegion"
    };
    console.log('new code here');

    $.ajax({
        url: 'controllers/ConfigurationController.php',
        type: "GET",
        data: info,
        success: function (data) {
            // alert(data);
            console.log('new code here 2');
            console.log(data);
            //  datatable.clear().draw();

            var obj = jQuery.parseJSON(data);
            console.log('size' + obj.length);
            if (obj.length == 0) {
                console.log("NO DATA!");
            } else {
                $.each(obj, function (key, value) {


                    // represent columns as array

                    $("#regionstb tbody").append(
                            '<tr> <td class="subject">' + value.name + '</td><td><button onclick="editRegion(\'' + value.code + '\',\'' + value.name + '\')" class="btn btn-outline-info btn-sm" type="button">Edit</button>\n\
                              <button onclick="deleteRegion(\'' + value.code + '\',\'' + value.title + '\')" class="btn btn-outline-danger btn-sm" type="button">Delete</button></td></tr>'
                            );
                });


            }

        },
        error: function (jXHR, textStatus, errorThrown) {
            alert(errorThrown + " " + textStatus + " New Error: " + jXHR);
        }
    });
}







