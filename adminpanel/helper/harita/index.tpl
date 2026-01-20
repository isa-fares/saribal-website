

    <div class="" style="position:relative;">
        <input id="pac-input" class="controls" type="text" placeholder="Adres ya da Konum Giriniz">
        <div id="map_canvas" style="width:100%; height:400px"></div>
        <div id="infowindow-content">
            <span class="hidden">
                <span id="place-name" class="title"></span><br>

                <span id="place-id"></span><br>
            </span>
            <span id="place-address"></span>
        </div>
    </div>
    <input type="text" class="form-control d-none hidden" id="input-lat-text">
    <input type="text" class="form-control d-none hidden" id="input-lng-text">
    <input type="text" class="form-control d-none hidden" id="input-address-text">

 <script type="text/javascript">
     var geocoder;
     var map;

     if(parent.$("input[name=<?=((isset($_GET['name'])) ? $_GET['name']:'harita')?>]").val()) {
         var ht = parent.$("input[name=<?=((isset($_GET['name'])) ? $_GET['name']:'harita')?>]").val().split(",");
         var lng = ht[1];
         var lat = ht[0];
         var zoom2 = 13;	}
     else { var lng = 37.376836605712924; var lat = 37.06472752279121; var zoom2 = 13}



     function setWindow(iWindow, iContent, iPlace, iMap, iMarker, setAddressVal){

         iContent.children['place-address'].textContent = iPlace.formatted_address;
         iWindow.open(iMap, iMarker);

         if (setAddressVal) {
             document.getElementById('input-lat-text').value = iMarker.getPosition().lat();
             document.getElementById('input-lng-text').value = iMarker.getPosition().lng();
             document.getElementById('input-address-text').value = iPlace.formatted_address;
             $("input[name=<?=((isset($_GET['name'])) ? $_GET['name']:'harita')?>]").val(iMarker.getPosition().lat()+","+iMarker.getPosition().lng());
         }
     }

     function initMap(){

         geocoder = new google.maps.Geocoder();
         var latLng =  new google.maps.LatLng(lat, lng);


         var myOptions = {
             zoom: zoom2,
             center: latLng,
             mapTypeId: google.maps.MapTypeId.ROADMAP
         };
         map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

         var marker = new google.maps.Marker({
             map: map,
             position: latLng,
             //title: "",
             draggable: true
         });


         var input = document.getElementById('pac-input');
         var autoComplete = new google.maps.places.Autocomplete(input);
         autoComplete.bindTo('bounds', map);
         map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);


         var infowindow = new google.maps.InfoWindow();
         var infowindowContent = document.getElementById('infowindow-content');
         infowindow.setContent(infowindowContent);






         // default geocode
         geocoder.geocode({ 'latLng': latLng }, function(results, status) {
             if (status === google.maps.GeocoderStatus.OK) {
                 if (results[0]) {
                     setWindow(infowindow, infowindowContent, results[0], map, marker, false);
                 }
             }
         });

         // marker listener
         marker.addListener('dragend', function() {
             geocoder.geocode({ 'latLng': marker.getPosition() }, function(results, status) {
                 if (status === google.maps.GeocoderStatus.OK) {
                     if (results[0]) {
                         setWindow(infowindow, infowindowContent, results[0], map, marker, true);
                     }
                 }
             });
         });
         marker.addListener('click', function() { infowindow.open(map, marker); });




         // after search
         autoComplete.addListener('place_changed', function() {
             infowindow.close();
             var place = autoComplete.getPlace();
             if (!place.geometry) {
                 return;
             }

             if (place.geometry.viewport) {
                 map.fitBounds(place.geometry.viewport);
             } else {
                 map.setCenter(place.geometry.location);
                 map.setZoom(zoom2);
             }


             marker.setMap(null);
             marker = new google.maps.Marker({
                 draggable: true,
                 map: map,
                 title: place.name,
                 position: place.geometry.location
             });
             marker.addListener('dragend', function() {
                 geocoder.geocode({ 'latLng': marker.getPosition() }, function(results, status) {
                     if (status === google.maps.GeocoderStatus.OK) {
                         if (results[0]) {
                             setWindow(infowindow, infowindowContent, results[0], map, marker, true);
                         }
                     }
                 });
             });
             marker.addListener('click', function() {
                 infowindow.open(map, marker);
             });
             marker.setVisible(true);

             setWindow(infowindow, infowindowContent, place, map, marker, true);
         });





     }



 </script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgq-Hq93LIjnCS1wJBOTh3SnMd0J0Pr9E&libraries=places&callback=initMap" async defer></script>

<style>
    #map_canvas {
        margin-bottom: 20px;
    }
    .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 40px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
    }
    #pac-input:focus {
        border-color: #4d90fe;
    }

</style>
