
//var dataurl = '../controllers/MapController?type=getBeneficiariesLocations';
//var dataurl = '../controllers/MapController?type=getBeneficiariesLocations';

//function initMap(url) {
//    var map = new google.maps.Map(document.getElementById('map'), {
//        center: new google.maps.LatLng(7.946527, -1.023194),
//        zoom: 7
//    });
//    var infoWindow = new google.maps.InfoWindow;
//
//    var url = '../controllers/MapController?type=getBeneficiariesLocations';
//    // Change this depending on the name of your PHP or XML file
//    downloadUrl(url, function (data) {
//
//        var xml = data.responseXML;
//        var markers = xml.documentElement.getElementsByTagName('marker');
//        Array.prototype.forEach.call(markers, function (markerElem) {
//            var name = markerElem.getAttribute('name');
//            var address = markerElem.getAttribute('address');
//            var category = markerElem.getAttribute('category');
//            var point = new google.maps.LatLng(
//                    parseFloat(markerElem.getAttribute('lat')),
//                    parseFloat(markerElem.getAttribute('lng')));
//            console.log('latitude:' + markerElem.getAttribute('lat'));
//            var infowincontent = document.createElement('div');
//
//            var strong = document.createElement('strong');
//            strong.textContent = 'Name : ' + name;
//            infowincontent.appendChild(strong);
//            infowincontent.appendChild(document.createElement('br'));
//
//
//            var text = document.createElement('text');
//            text.textContent = 'Category: ' + category;
//            infowincontent.appendChild(text);
//            infowincontent.appendChild(document.createElement('br'));
//
//            var text = document.createElement('text');
//            text.textContent = 'Address: ' + address;
//            infowincontent.appendChild(text);
//
//            var marker = new google.maps.Marker({
//                map: map,
//                position: point
//            });
//            marker.addListener('click', function () {
//                infoWindow.setContent(infowincontent);
//                infoWindow.open(map, marker);
//            });
//        });
//    });
//}
//
//
//
function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
        }
    };

    request.open('GET', url, true);
    request.send(null);
}
//
function doNothing() {
}
//google.maps.event.addDomListener(window, 'load', initMap);
//



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




var reginfo = {
    type: "retreiveDescription"
};

$.ajax({
    url: '../controllers/ConfigurationController.php',
    type: "GET",
    data: reginfo,
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

var cat = {
    type: "retreiveDistrict"
};

$.ajax({
    url: '../controllers/ConfigurationController.php',
    type: "GET",
    data: cat,
    dataType: 'json',
    success: function (data) {


        $.each(data, function (i, item) {

            $('#district').append($('<option>', {
                value: item.code,
                text: item.name
            }));
        });

    }
});





$('#filterResultsForm').on('submit', function (e) {

    e.preventDefault();
    //$('input:submit').attr("disabled", true);
    // var validator = $("#saveRegionForm").validate();
    $('#loaderModal').modal('show');

    var formData = $(this).serialize();
    //  console.log(formData);
    var category = $('#category').find(":selected").val();
    var region = $('#region').find(":selected").val();
        //var district = $('#district').find(":selected").val();

    console.log('category: '+region + category);

    //var url = '../controllers/MapController?type=getFilteredBeneficiariesLocations&category=' + category + '&region=' + region + '';
 var url = '../controllers/MapController?type=getFilteredBeneficiariesLocations&category=' + category + '&region=' + region + '';

initMap(url);

function initMap(url) {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: new google.maps.LatLng(7.946527, -1.023194),
        zoom: 7
    });
    var infoWindow = new google.maps.InfoWindow;

   // var url = '../controllers/MapController?type=getFilteredBeneficiariesLocations&category=' + category + '&region=' + region + '';

    // Change this depending on the name of your PHP or XML file
    downloadUrl(url, function (data) {

        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');
        Array.prototype.forEach.call(markers, function (markerElem) {
            var name = markerElem.getAttribute('name');
            var address = markerElem.getAttribute('address');
            var category = markerElem.getAttribute('category');
            var point = new google.maps.LatLng(
                    parseFloat(markerElem.getAttribute('lat')),
                    parseFloat(markerElem.getAttribute('lng')));
            console.log('latitude:' + markerElem.getAttribute('lat'));
            var infowincontent = document.createElement('div');

            var strong = document.createElement('strong');
            strong.textContent = 'Name : ' + name;
            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));


            var text = document.createElement('text');
            text.textContent = 'Category: ' + category;
            infowincontent.appendChild(text);
            infowincontent.appendChild(document.createElement('br'));

            var text = document.createElement('text');
            text.textContent = 'Address: ' + address;
            infowincontent.appendChild(text);

            var marker = new google.maps.Marker({
                map: map,
                position: point
            });
            marker.addListener('click', function () {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
            });
        });
    });
}
    google.maps.event.addDomListener(window, 'load', initMap);
    console.log('done');
    $('#loaderModal').modal('hide');





});

