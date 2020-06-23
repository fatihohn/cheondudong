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

<?php 

include 'cdd_db_conn.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// $sqlPlaceMarker = "SELECT * FROM places ORDER BY id DESC";
// $resultPlaceMarker = $conn->query($sqlPlaceMarker) or die($conn->error);



$sqlPlaceMarker = "SELECT * FROM places ORDER BY id DESC";
// $resultPlaceMarker = $conn->query($sqlPlaceMarker) or die($conn->error);

$stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlPlaceMarker)) {
                // echo "sqlPlaceMarker error";
        } else {
                // mysqli_stmt_bind_param($stmt, "s", $author);
                mysqli_stmt_execute($stmt);
                $resultPlaceMarker = mysqli_stmt_get_result($stmt);
        }



if ($resultPlaceMarker->num_rows > 0) {
    // output data of each row
    while($row = $resultPlaceMarker->fetch_assoc()) {
        $place_id = $row['id'];
        $mkimg_dir = $row['mkimg_dir'];
        $mkimg_size = $row['mkimg_size'];
        $ko_title = $row['ko_title'];
        $en_title = $row['en_title'];
        // $ko_address = $row['ko_address'];
        // $en_address = $row['en_address'];
        $lat = $row['lat'];
        $lng = $row['lng'];
        // $ko_cont = $row['ko_cont'];
        // $en_cont = $row['en_cont'];

        // $sqlPlaceImg = "SELECT * FROM images WHERE id = $place_id";
        // $resultPlaceImg = $conn->query($sqlPlaceImg) or die($conn->error);
        // $rowPlaceImg = $resultPlaceImg->fetch_assoc();





        echo "{";
        echo "'type': 'Feature',";
        echo     "'properties': {";
        echo        "'place_id': '".$place_id."',";
        echo        "'category': '".$mkimg_size."',";
        echo        "'file': '".$row['mkimg_dir']."',";
        echo        "'message_ko': '".$ko_title."',";
        echo        "'message_en': '".$en_title."',";
        echo        "'iconSize': [270, 100]";
        echo    "},";
        echo    "'geometry': {";
        echo        "'type': 'Point',";
        echo        "'coordinates': [".$lng.", ".$lat."]";
        echo     "}
            },";


    }
}

    
?>



    // {
    // 'type': 'Feature',
    // 'properties': {
    //     // 'place_id': '1',
    //     'place_id': '<?php //echo "100";?>',
    //     'category': 'middleHori',
    //     'file': 'static/img/marker/monkeyhouse.png',
    //     'message_ko': '<?php //echo "낙검자수용소";?>',
    //     'message_en': '<?php //echo "Monkey House";?>',
    //     'iconSize': [270, 100]
    // },
    // 'geometry': {
    //     'type': 'Point',
    //     'coordinates': [127.065257, 37.944896]
    // }
    // },

    // {
    // 'type': 'Feature',
    // 'properties': {
    //     'place_id': '2',
    //     'category': 'bigHori',
    //     'file': 'static/img/marker/gulsan_vil.png',
    //     'message_ko': '<?php //echo "걸산마을";?>',
    //     'message_en': '<?php //echo "Gulsan Village";?>',
    //     'iconSize': [270, 100]
    // },
    // 'geometry': {
    //     'type': 'Point',
    //     'coordinates': [127.095351, 37.926185]
    // }
    // },

    // {
    // 'type': 'Feature',
    // 'properties': {
    //     'place_id': '3',
    //     'category': 'smallHori',
    //     'file': 'static/img/marker/yoongumee.png',
    //     'message_ko': '<?php //echo "윤금이 거주지";?>',
    //     'message_en': '<?php //echo "Yoon Gumee House";?>',
    //     'iconSize': [270, 100]
    // },
    // 'geometry': {
    //     'type': 'Point',
    //     'coordinates': [127.055933, 37.916710]
    // }
    // }

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
// // window.alert(marker.properties.message);
// });



// el.addEventListener('click', function() {
// // window.alert(marker.properties.message);
// showMarkerPlace();
// });

// el.addEventListener('click', function() {
el.addEventListener('mouseover', function() {
    var languageKo = document.getElementById("language_ko").style.display;
    var languageEn = document.getElementById("language_en").style.display;

    if(languageEn == "none") {
        var elNameKo = document.createElement('div');

        elNameKo.id = 'marker_name';
        elNameKo.className = 'ko';
        elNameKo.innerHTML = marker.properties.message_ko;
        elNameKo.style.width = '100%';
        elNameKo.style.height = '20px';
        elNameKo.style.textAlign = 'center';
        elNameKo.style.fontSize = '2rem';
        elNameKo.style.fontFamily = '또박또박';
        elNameKo.style.overflowX = 'visible';
        elNameKo.style.overflowY = 'visible';
        elNameKo.style.whiteSpace = 'nowrap';
        elNameKo.style.wordBreak = 'keep-all';
        elNameKo.style.position = 'relative';
        elNameKo.style.top = '100%';

        document.getElementById(marker.properties.place_id).appendChild(elNameKo);
    } else if(languageKo == "none") {
        var elNameEn = document.createElement('div');

        elNameEn.id = 'marker_name';
        elNameEn.className = 'en';
        elNameEn.innerHTML = marker.properties.message_en;
        elNameEn.style.width = '100%';
        elNameEn.style.height = '20px';
        elNameEn.style.textAlign = 'center';
        elNameEn.style.fontSize = '2rem';
        elNameEn.style.fontFamily = '또박또박';
        elNameEn.style.overflowX = 'visible';
        elNameEn.style.overflowY = 'visible';
        elNameEn.style.whiteSpace = 'nowrap';
        elNameEn.style.wordBreak = 'keep-all';
        elNameEn.style.position = 'relative';
        elNameEn.style.top = '100%';

        document.getElementById(marker.properties.place_id).appendChild(elNameEn);
        
        let enAllMap = document.querySelectorAll(".en");
        let elangMap;
        for(elangMap=0; elangMap < enAllMap.length; elangMap++) {
            enAllMap[elangMap].style.display = "initial";
        }
    }
});

el.addEventListener('mouseout', function() {
    // var elShownKo = document.getElementById('marker_name_ko');
    // var elShownEn = document.getElementById('marker_name_en');
    // elShownKo.remove();
    // elShownEn.remove();
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
        let smallPanoAll = document.querySelectorAll(".smallPano");
        let sp;
        for(sp=0; sp < smallPanoAll.length; sp++) {
            smallPanoAll[sp].style.width = "120px";
            smallPanoAll[sp].style.height = "60px";
            smallPanoAll[sp].style.backgroundSize = "cover";
            smallPanoAll[sp].style.cursor = "pointer";
        }
        let middlePanoAll = document.querySelectorAll(".middlePano");
        let mp;
        for(mp=0; mp < middlePanoAll.length; mp++) {
            middlePanoAll[mp].style.width = "80px";
            middlePanoAll[mp].style.height = "40px";
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