<div id="map_wrap">
    <div id='map' style='width: 100%; height: 100%;'></div>
</div>



    <!-- <script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoic3VyaWNpdHkiLCJhIjoiY2tiZnpzaGtzMTB5NTJwcWVtOHF5anRmMCJ9.CI4QuMCsvVak3vrNtnJWcw';
    var map = new mapboxgl.Map({
    container: 'map',
    // style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
    // style: 'mapbox://styles/suricity/ckbg1kxyd3jjo1is4ro4nkpb5', // stylesheet location
    style: 'mapbox://styles/suricity/ckbhx3huo0xb11ip5hywb59rx', // stylesheet location
    // center: [192, 37], // starting position [lng, lat]
    center: [127.060444, 37.911627], // starting position [lng, lat]
    maxBounds: [
	    	//limit dongducheon 
	    	[126.954480, 37.846739], // Southwest limit coordinates 
	    	[127.196154, 38.014146] // Northeast limit coordinates


		    ],
    zoom: 12.9, // starting zoom
    // maxZoom: 18
    });
    // var language = new MapboxLanguage({
	// 		  defaultLanguage: "ko"
	// 	});
		// map.addControl(language);

		// geocoder = new MapboxGeocoder({
		// 	mapboxgl: mapboxgl,
		//     accessToken: mapboxgl.accessToken,
		// });

		// map.addControl(geocoder);

    
    </script> -->



    <!-- <script src="static/js/map.js"></script> -->

    <script>
    var map;
	var location_data = {"country":"", "city":"", "sublocality_level_1" : "", "sublocality_level_2" : ""}

	var geocoder;
	var built_address = "";
	var is_dongducheon = false;
	var user_coordinates;
	var geocode_results;
	var distance_from_dongducheon;
	var map_markers;
	var floaters_markers;
	var link_lines_features_work;

	var supports_location = false;
	var check_location_interval;
	var location_interval_is_running = false;
	var location_interval_is_first_check = true;
	var is_checking_location = false;

	var first_load = true;
	var data_loaded = false;
	var url_params;

	var hiddenHeight;

	var quotes_array = [];
	var base64_export;
	var detectrtc_tested = false;
    
    
    
    
    
    mapboxgl.accessToken = 'pk.eyJ1Ijoic3VyaWNpdHkiLCJhIjoiY2tiZnpzaGtzMTB5NTJwcWVtOHF5anRmMCJ9.CI4QuMCsvVak3vrNtnJWcw';
    
    var geojson = {
'type': 'FeatureCollection',
'features': [
{
'type': 'Feature',
'properties': {
    'place_id': '1',
    'category': 'landmark',
'file': 'static/img/marker/monkeyhouse.png',
'message': 'Foo',
'iconSize': [270, 100]
},
'geometry': {
'type': 'Point',
'coordinates': [127.065257, 37.944896]
}
},
{
'type': 'Feature',
'properties': {
    'place_id': '2',
    'category': 'village',
'file': 'static/img/marker/gulsan_vil.png',
'message': 'Bar',
'iconSize': [270, 100]
},
'geometry': {
'type': 'Point',
'coordinates': [127.095351, 37.926185]
}
},
{
'type': 'Feature',
'properties': {
    'place_id': '3',
    'category': 'landmark',
'file': 'static/img/marker/yoongumee.png',
'message': 'Baz',
'iconSize': [270, 100]
},
'geometry': {
'type': 'Point',
'coordinates': [127.055933, 37.916710]
}
}
]
};
    
    
    
    var map = new mapboxgl.Map({
    container: 'map',
    // style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
    // style: 'mapbox://styles/suricity/ckbg1kxyd3jjo1is4ro4nkpb5', // stylesheet location
    style: 'mapbox://styles/suricity/ckbhx3huo0xb11ip5hywb59rx', // stylesheet location
    // center: [192, 37], // starting position [lng, lat]
    center: [127.060444, 37.911627], // starting position [lng, lat]
    maxBounds: [
	    	//limit dongducheon 
	    	[126.954480, 37.846739], // Southwest limit coordinates 
	    	[127.196154, 38.014146] // Northeast limit coordinates
		    ],
    zoom: 12.9, // starting zoom
    minZoom: 12.5,
    maxZoom: 18
    });

    // add markers to map
geojson.features.forEach(function(marker) {
// create a DOM element for the marker
var el = document.createElement('div');
// el.className = 'marker';
el.className = 'marker' + ' ' + marker.properties.category;
el.id = marker.properties.place_id;
// el.style.backgroundImage =
// 'url(http://13.209.210.87/static/img/marker/' +
// marker.properties.iconSize.join('/') +
// '/)';

// el.style.backgroundImage =
// 'url(static/img/marker/' +
// marker.properties.file +
// ')';

el.style.backgroundImage =
'url(' +
marker.properties.file +
')';

el.style.backgroundSize = 'cover';
el.style.width = marker.properties.iconSize[0] + 'px';
el.style.height = marker.properties.iconSize[1] + 'px';
 
el.addEventListener('click', function() {
window.alert(marker.properties.message);
});
 
// add marker to map
new mapboxgl.Marker(el)
.setLngLat(marker.geometry.coordinates)
.addTo(map);
});




    var language = new MapboxLanguage({
			  defaultLanguage: "ko"
		});
		map.addControl(language);

		geocoder = new MapboxGeocoder({
			mapboxgl: mapboxgl,
		    accessToken: mapboxgl.accessToken,
		});

        map.addControl(geocoder);

        
        

//****user location****//

function getUserLocation(method) {

    toggle_updatelocation(true);

    // request to allow user position 
    if (navigator.geolocation) {
        supports_location = true;

        toggle_updatelocation(false);

        console.log("L1, getUserLocation()")
        navigator.geolocation.getCurrentPosition(showPosition, show_location_error);


        function showPosition(position) {

            // get user current coordinates and center map on coordiates
            console.log("L2", position)
            //console.log(position.coords.latitude, position.coords.latitude)
            user_coordinates = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            // convert users coordinates to place address
            getReverseGeocode(user_coordinates, method)

            distance_from_dongducheon = getDistanceFromLatLonInKm(user_coordinates.lat,user_coordinates.lng,37.916149,127.057049)

        }
    } else {
        // if device doesnt support location
        console.log("E1, device doesnt support location")
        show_location_error(error)
    }

    // if device supports camera, show camera buttons
    DetectRTC.load(function() {
        if (DetectRTC.hasWebcam == false && detectrtc_tested != true) {
            console.log("device has no cam" );
            $(".btn_opencam").hide();
            $(".ui_map_bottom").addClass("no_cam");
            detectrtc_tested = true;
        } 
    });
}; 



    </script>


    <script>
    function markerSize() {
        let villageAll = document.querySelectorAll(".village");
        let v;
        for(v; v < villageAll.length; v++) {
            villageAll.style.width = "200px";
            villageAll.style.height = "135px";
        let landmarkAll = document.querySelectorAll(".landmark");
        let l;
        for(l; l < landmarkAll.length; l++) {
            landmarkAll.style.width = "135px";
            landmarkAll.style.height = "50px";
        }
    }
    markerSize();
    
    </script>