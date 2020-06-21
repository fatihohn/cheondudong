<div id="map_wrap">
    <div id='map' style='width: 100%; height: 100%;'></div>
</div>


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
    




//****marker list****//
    var geojson = {
'type': 'FeatureCollection',
'features': [

{
'type': 'Feature',
'properties': {
    // 'place_id': '1',
    'place_id': '<?php echo "100";?>',
    'category': 'middleHori',
'file': 'static/img/marker/monkeyhouse.png',
// 'message': 'Foo',
'message': '<?php echo "낙검자수용소";?>',
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
    'category': 'bigHori',
'file': 'static/img/marker/gulsan_vil.png',
// 'message': 'Bar',
'message': '<?php echo "걸산마을";?>',
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
    'category': 'smallHori',
'file': 'static/img/marker/yoongumee.png',
// 'message': 'Baz',
'message': '<?php echo "윤금이 거주지";?>',
'iconSize': [270, 100]
},
'geometry': {
'type': 'Point',
'coordinates': [127.055933, 37.916710]
}
}

]
};

//****marker list end****//
    
    
    
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
 

//****marker func****//
// el.addEventListener('click', function() {
// window.alert(marker.properties.message);
// });


// el.addEventListener('click', function() {
el.addEventListener('mouseover', function() {
// window.alert(marker.properties.message);
    var elName = document.createElement('div');

    elName.id = 'marker_name';
    elName.innerHTML = marker.properties.message;
    elName.style.width = '100%';
    elName.style.height = '20px';
    // elName.style.paddingTop = '5px';
    // elName.style.backgroundColor = 'rgb(255, 255, 255)';
    elName.style.textAlign = 'center';
    elName.style.fontSize = '2rem';
    elName.style.fontFamily = '또박또박';
    elName.style.overflowX = 'visible';
    elName.style.overflowY = 'visible';
    elName.style.whiteSpace = 'nowrap';
    elName.style.wordBreak = 'keep-all';
    elName.style.position = 'relative';
    elName.style.top = '100%';


    document.getElementById(marker.properties.place_id).appendChild(elName);
});

el.addEventListener('mouseout', function() {
// window.alert(marker.properties.message);
    var elShown = document.getElementById('marker_name');
    elShown.remove();
});

//****marker func end****//
 
// add marker to map
new mapboxgl.Marker(el)
.setLngLat(marker.geometry.coordinates)
.addTo(map);
});

// // disable map rotation using right click + drag
// map.dragRotate.disable();
 
// disable map rotation using touch rotation gesture
map.touchZoomRotate.disableRotation();

// Add zoom and rotation controls to the map.
map.addControl(new mapboxgl.NavigationControl());

// Add geolocate control to the map.
map.addControl(
new mapboxgl.GeolocateControl({
positionOptions: {
enableHighAccuracy: true
},
trackUserLocation: true
})
);









    </script>


    <script>
    

    
    function markerSize() {

        //****1:1****//
        let smallCubeAll = document.querySelectorAll(".smallCube");
        let sc;
        for(sc=0; sc < smallCubeAll.length; sc++) {
            smallCubeAll[sc].style.width = "60px";
            smallCubeAll[sc].style.height = "60px";
            smallCubeAll[sc].style.backgroundSize = "cover";
            smallCubeAll[sc].style.cursor = "pointer";
        }
        let middleCubeAll = document.querySelectorAll(".middleCube");
        let mc;
        for(mc=0; mc < middleCubeAll.length; mc++) {
            middleCubeAll[mc].style.width = "80px";
            middleCubeAll[mc].style.height = "80px";
            middleCubeAll[mc].style.backgroundSize = "cover";
            middleCubeAll[mc].style.cursor = "pointer";
        }
        //****1:1.6****//
        let smallHoriAll = document.querySelectorAll(".smallHori");
        let sh;
        for(sh=0; sh < smallHoriAll.length; sh++) {
            smallHoriAll[sh].style.width = "80px";
            smallHoriAll[sh].style.height = "50px";
            smallHoriAll[sh].style.backgroundSize = "cover";
            smallHoriAll[sh].style.cursor = "pointer";
        }
        let middleHoriAll = document.querySelectorAll(".middleHori");
        let mh;
        for(mh=0; mh < middleHoriAll.length; mh++) {
            middleHoriAll[mh].style.width = "108px";
            middleHoriAll[mh].style.height = "60px";
            middleHoriAll[mh].style.backgroundSize = "cover";
            middleHoriAll[mh].style.cursor = "pointer";
        }
        let bigHoriAll = document.querySelectorAll(".bigHori");
        let bh;
        for(bh=0; bh < bigHoriAll.length; bh++) {
            bigHoriAll[bh].style.width = "160px";
            bigHoriAll[bh].style.height = "100px";
            bigHoriAll[bh].style.backgroundSize = "cover";
            bigHoriAll[bh].style.cursor = "pointer";
        }
        //****1:2****//
        let middlePanoAll = document.querySelectorAll(".middlePano");
        let mp;
        for(mp=0; mp < middlePanoAll.length; mp++) {
            middlePanoAll[mp].style.width = "120px";
            middlePanoAll[mp].style.height = "60px";
            middlePanoAll[mp].style.backgroundSize = "cover";
            middlePanoAll[mp].style.cursor = "pointer";
        }
        //****1:2.7****//
        let longPanoAll = document.querySelectorAll(".longPano");
        let lp;
        for(lp=0; lp < longPanoAll.length; lp++) {
            longPanoAll[lp].style.width = "160px";
            longPanoAll[lp].style.height = "60px";
            longPanoAll[lp].style.backgroundSize = "cover";
            longPanoAll[lp].style.cursor = "pointer";
        }
    }
    markerSize();

    
    </script>