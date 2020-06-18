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
    maxZoom: 18
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


