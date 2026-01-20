<?
/***
 * @var $name string
 * @var $value string
 * @var $item string
 */
?>
<? if (isset($title) && !empty($title)){?>
    <span class="font-weight-500 d-block" style="color:#67757c; font-size: 14px; margin-bottom: .5rem;"><?=$title?></span>
<? } ?>
<div class="" style="position:relative;">
    <input id="pac-input-<?=$name?>" class="controls" type="text" placeholder="Adres ya da Konum Giriniz">
    <div id="map_canvas_<?=$name?>" style="width:100%; height:400px"></div>
    <div id="infowindow-content-<?=$name?>">
            <span class="hidden">
                <span id="place-name" class="title"></span><br>
                <span id="place-id"></span><br>
            </span>
        <span id="place-address"></span>
    </div>
</div>

<input type="text" class="form-control d-none hidden" id="input-lat-text-<?=$name?>">
<input type="text" class="form-control d-none hidden" id="input-lng-text-<?=$name?>">
<input type="text" class="form-control d-none hidden" id="input-address-text-<?=$name?>">

<input type="text" name="<?=$name?>" value="<?=$value[0].",".$value[1]?>" class="d-none hidden">


<?
$this->baseURL($item["url"], $lang, 1);
?>

<script type="text/javascript">

    var geocoder<?=$name?>;
    var map<?=$name?>;
    var zoom2<?=$name?> = <?=(isset($zoom) ? $zoom : 13)?>;


    function setWindow<?=$name?>(iWindow, iContent, iPlace, iMap, iMarker, setAddressVal){

        iContent.children['place-address'].textContent = iPlace.formatted_address;
        iWindow.open(iMap, iMarker);

        if (setAddressVal) {
            document.getElementById('input-lat-text-<?=$name?>').value = iMarker.getPosition().lat();
            document.getElementById('input-lng-text-<?=$name?>').value = iMarker.getPosition().lng();
            document.getElementById('input-address-text-<?=$name?>').value = iPlace.formatted_address;
            $("input[name=<?=$name?>]").val(iMarker.getPosition().lat()+","+iMarker.getPosition().lng());
        }
    }

    function initMap<?=$name?>(){

        geocoder<?=$name?> = new google.maps.Geocoder();
        var latLng = new google.maps.LatLng(<?=(!empty($value[0]) ? $value[0] : '37.066206')?>, <?=(!empty($value[1]) ? $value[1] : '37.376607')?>);


        var myOptions = {
            zoom: zoom2<?=$name?>,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map<?=$name?> = new google.maps.Map(document.getElementById("map_canvas_<?=$name?>"), myOptions);

        var marker = new google.maps.Marker({
            map: map<?=$name?>,
            position: latLng,
            //title: "",
            draggable: true
        });


        var input = document.getElementById('pac-input-<?=$name?>');



        const searchBox = new google.maps.places.SearchBox(input);
        map<?=$name?>.controls[google.maps.ControlPosition.TOP_LEFT].push(input);


        var infowindow<?=$name?> = new google.maps.InfoWindow();
        var infowindowContent<?=$name?> = document.getElementById('infowindow-content-<?=$name?>');
        infowindow<?=$name?>.setContent(infowindowContent<?=$name?>);


        map<?=$name?>.addListener("bounds_changed", () => {
            searchBox.setBounds(map<?=$name?>.getBounds());
        });





        // default geocode
        geocoder<?=$name?>.geocode({ 'latLng': latLng }, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    setWindow<?=$name?>(infowindow<?=$name?>, infowindowContent<?=$name?>, results[0], map<?=$name?>, marker, false);
                }
            }
        });

        // marker listener
        marker.addListener('dragend', function() {
            geocoder<?=$name?>.geocode({ 'latLng': marker.getPosition() }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        setWindow<?=$name?>(infowindow<?=$name?>, infowindowContent<?=$name?>, results[0], map<?=$name?>, marker, true);
                    }
                }
            });
        });
        marker.addListener('click', function() { infowindow<?=$name?>.open(map<?=$name?>, marker); });


        map<?=$name?>.addListener("bounds_changed", () => {
            searchBox.setBounds(map<?=$name?>.getBounds());
        });
        let markers = [];

        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }
            // Clear out the old markers.
            markers.forEach((marker) => {
                marker.setMap(null);
            });
            markers = [];


            places.forEach((place) => {
                if (place.geometry) {
                    map<?=$name?>.fitBounds(place.geometry.viewport);
                } else {
                    map<?=$name?>.setCenter(place.geometry.location);
                    map<?=$name?>.setZoom(zoom2<?=$name?>);
                }


                marker.setMap(null);

                marker = new google.maps.Marker({
                    draggable: true,
                    map: map<?=$name?>,
                    title: place.name,
                    position: place.geometry.location,
                });
                marker.addListener('dragend', function() {
                    geocoder<?=$name?>.geocode({ 'latLng': marker.getPosition() }, function(results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                setWindow<?=$name?>(infowindow<?=$name?>, infowindowContent<?=$name?>, results[0], map<?=$name?>, marker, true);
                            }
                        }
                    });
                });
                marker.addListener('click', function() {
                    infowindow<?=$name?>.open(map<?=$name?>, marker);
                });
                marker.setVisible(true);

                setWindow<?=$name?>(infowindow<?=$name?>, infowindowContent<?=$name?>, place, map<?=$name?>, marker, true);
            });

        });





    }

    $(document).ready(function () {
        initMap<?=$name?>();

        $('#pac-input-<?=$name?>').on('keypress', function(event){


            if(event.keyCode === 13) {
                event.preventDefault();
                return false;
            }

        });

    });

</script>




<style>
    #map_canvas_<?=$name?> {
        margin-bottom: 20px;
    }

    #pac-input-<?=$name?> {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;

        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 40px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    #pac-input-<?=$name?>:focus {
        border-color: #4d90fe;
    }

</style>