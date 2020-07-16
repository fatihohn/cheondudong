<div id="map_wrap">
    <div id='map' style='width: 100%; height: 100%;'></div>
</div>


    <script>
    var map;
	// var location_data = {"country":"", "city":"", "sublocality_level_1" : "", "sublocality_level_2" : ""}

	// var geocoder;
	// var built_address = "";
	// var is_dongducheon = false;
	// var user_coordinates;
	// var geocode_results;
	// var distance_from_dongducheon;
	// var map_markers;
	// var floaters_markers;
	// var link_lines_features_work;

	// var supports_location = false;
	// var check_location_interval;
	// var location_interval_is_running = false;
	// var location_interval_is_first_check = true;
	// var is_checking_location = false;

	// var first_load = true;
	// var data_loaded = false;
	// var url_params;

	// var hiddenHeight;

	// var quotes_array = [];
	// var base64_export;
	// var detectrtc_tested = false;
    
    mapboxgl.accessToken = 'pk.eyJ1Ijoic3VyaWNpdHkiLCJhIjoiY2tiZnpzaGtzMTB5NTJwcWVtOHF5anRmMCJ9.CI4QuMCsvVak3vrNtnJWcw';
    




//****marker list****//
    var geojson = {
        'type': 'FeatureCollection',
        'features': [

            <?php 
            session_start();
            include 'cdd_db_conn.php';
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sqlPlaceMarker = "SELECT * FROM places ORDER BY lat DESC";
            $resultPlaceMarker = $conn->query($sqlPlaceMarker) or die($conn->error);

            if ($resultPlaceMarker->num_rows > 0) {
                // output data of each row
                while($row = $resultPlaceMarker->fetch_assoc()) {
                    $id = $row['id'];
                    $mkimg_dir = $row['mkimg_dir'];
                    $mkimg_size = $row['mkimg_size'];
                    $en_title = mysqli_real_escape_string($conn, $row['en_title']);
                    $ko_title = mysqli_real_escape_string($conn, $row['ko_title']);
                    $en_sub_title = mysqli_real_escape_string($conn, $row['en_sub_title']);
                    $ko_sub_title = mysqli_real_escape_string($conn, $row['ko_sub_title']);
                    $en_memo = mysqli_real_escape_string($conn, $row['en_memo']);
                    $ko_memo = mysqli_real_escape_string($conn, $row['ko_memo']);
                    $lat = $row['lat'];
                    $lng = $row['lng'];

                    echo "{";
                    echo "'type': 'Feature',";
                    echo     "'properties': {";
                    echo        "'place_id': '".$id."',";
                    echo        "'category': '".$mkimg_size."',";
                    echo        "'file': '".$row['mkimg_dir']."',";
                    echo        "'message_ko': '".$ko_title."',";
                    echo        "'message_en': '".$en_title."',";
                    echo        "'sub_title_ko': '".$ko_sub_title."',";
                    echo        "'sub_title_en': '".$en_sub_title."',";
                    echo        "'memo_ko': '".$ko_memo."',";
                    echo        "'memo_en': '".$en_memo."',";
                    echo        "'iconSize': [270, 100]";
                    echo    "},";
                    echo    "'geometry': {";
                    echo        "'type': 'Point',";
                    echo        "'coordinates': [".$lng.", ".$lat."]";
                    // echo        "'coordinates': {lng:".$lng.", lat:".$lat."}";
                    // echo        "'coordinates': [";
                    // echo $lng;
                    // echo ", ";
                    // echo $lat;
                    // echo "]";
                    echo     "}
                        },";


                }
            }
            ?>
        ]
    };

//****marker list end****//
    
    
    
    var map = new mapboxgl.Map({
    container: 'map',
    // style: 'mapbox://styles/suricity/ckbhx3huo0xb11ip5hywb59rx', // stylesheet location
    // style: 'mapbox://styles/suricity/ckcfmm6dg0a1w1iki1dbo6dx3', // stylesheet location
    style: 'mapbox://styles/suricity/ckchgtphk0idy1ioauval3m4j', // stylesheet location
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
    el.className = 'marker' + ' ' + marker.properties.category;
    el.id = marker.properties.place_id;
    el.style.backgroundImage =
    'url(' +
    marker.properties.file +
    ')';


    el.style.backgroundSize = 'contain';
    el.style.backgroundRepeat = 'no-repeat';
    el.style.width = marker.properties.iconSize[0] + 'px';
    el.style.height = marker.properties.iconSize[1] + 'px';
    // el.style.filter = 'grayscale(1.0)';
    el.style.backgroundColor = 'red';
    el.style.backgroundBlendMode = 'overlay';

    // el.onmouseover = function() {
    //     el.style.width = marker.properties.iconSize[0] * 1.2 + 'px';
    //     el.style.height = marker.properties.iconSize[1] * 1.2 + 'px';
    // }
    // el.onmouseleave = function() {
    //     el.style.width = marker.properties.iconSize[0] * 1.0 + 'px';
    //     el.style.height = marker.properties.iconSize[1] * 1.0 + 'px';
    // }
    
 

//****marker func****//



    // el.addEventListener('mouseover', function() {
    //     var languageKo = document.getElementById("language_ko").style.display;
    //     var languageEn = document.getElementById("language_en").style.display;
        
    //     if(languageEn == "none") {
    //         var elNameKo = document.createElement('div');

    //         elNameKo.id = marker.properties.place_id;
    //         elNameKo.className = 'ko' + ' ' + 'marker_name';
    //         elNameKo.innerHTML = marker.properties.message_ko;
    //         elNameKo.style.width = '100%';
    //         elNameKo.style.height = '20px';
    //         elNameKo.style.textAlign = 'center';
    //         elNameKo.style.fontSize = '2rem';
    //         elNameKo.style.fontFamily = '또박또박';
    //         elNameKo.style.overflowX = 'visible';
    //         elNameKo.style.overflowY = 'visible';
    //         elNameKo.style.whiteSpace = 'nowrap';
    //         elNameKo.style.wordBreak = 'keep-all';
    //         elNameKo.style.position = 'relative';
    //         elNameKo.style.top = 'calc(100% - 30px)';

    //         // if(!document.querySelector(".marker_name")) {
    //         // }
    //             document.getElementById(marker.properties.place_id).appendChild(elNameKo);
    //     } else if(languageKo == "none") {
    //         var elNameEn = document.createElement('div');

    //         elNameEn.id = marker.properties.place_id;
    //         elNameEn.className = 'en' + ' ' + 'marker_name';
    //         elNameEn.innerHTML = marker.properties.message_en;
    //         elNameEn.style.width = '100%';
    //         elNameEn.style.height = '20px';
    //         elNameEn.style.textAlign = 'center';
    //         elNameEn.style.fontSize = '2rem';
    //         elNameEn.style.fontFamily = '또박또박';
    //         elNameEn.style.overflowX = 'visible';
    //         elNameEn.style.overflowY = 'visible';
    //         elNameEn.style.whiteSpace = 'nowrap';
    //         elNameEn.style.wordBreak = 'keep-all';
    //         elNameEn.style.position = 'relative';
    //         elNameEn.style.top = 'calc(100% - 30px)';

    //         // if(!document.querySelector(".marker_name")) {
    //         // }
    //             document.getElementById(marker.properties.place_id).appendChild(elNameEn);

    //         let enAllMap = document.querySelectorAll(".en");
    //         let elangMap;
    //         for(elangMap=0; elangMap < enAllMap.length; elangMap++) {
    //             enAllMap[elangMap].style.display = "initial";
    //         }
    //     }
    // });

    // function removeMarkerName() {
    //     var elShownAll = document.querySelectorAll('.marker_name');
    //     let mkn;
    //     for (mkn = 0; mkn < elShownAll.length; mkn++) {
    //         elShownAll[mkn].remove();
    //     }
    // }
    
    // el.addEventListener('mouseout', function() {
    //     removeMarkerName();
    // });
    
    var sessLang = "<?php echo $_SESSION['language'];?>";
    if(sessLang=="ko") {
        var info_cont = '<div class="'+ marker.properties.place_id + '" onclick="showDetailPlaceMap(this.className)">'+
                '<h3>' +
                    marker.properties.message_ko +
                '</h3>'+
                '<h4>' + 
                    marker.properties.sub_title_ko + 
                '</h4>'+
                '<p class="gg-batang">' + 
                    marker.properties.memo_ko + 
                '</p><p class="right_p">...더보기</p>'+
            '</div>';
    } else {
        var info_cont = '<div class="'+ marker.properties.place_id + '" onclick="showDetailPlaceMap(this.className)">'+
                '<h3>' +
                    marker.properties.message_en +
                '</h3>'+
                '<h4>' + 
                    marker.properties.sub_title_en + 
                '</h4>'+
                '<p class="gg-batang">' + 
                    marker.properties.memo_en + 
                '</p><p class="right_p">...more</p>'+
            '</div>';

    }

//****marker func end****//
 
// // add marker to map
// new mapboxgl.Marker(el)
// .setLngLat(marker.geometry.coordinates)
// .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
//     .setHTML('<div class="'+ marker.properties.place_id + '" onclick="showDetailPlaceMap(this.className)">'+
//         '<h3 class="ko">' +
//             marker.properties.message_ko +
//         '</h3><br>'+
//         '<h3 class="en">' + 
//             marker.properties.message_en + 
//         '</h3><br>'+ 
//         '<h4 class="ko">' + 
//             marker.properties.sub_title_ko + 
//         '</h4>'+
//         '<h4 class="en">' + 
//             marker.properties.sub_title_en + 
//         '</h4>'+
//         '<p class="ko">' + 
//             marker.properties.memo_ko + 
//         '</p>'+
//         '<p class="en">' + 
//             marker.properties.memo_en + 
//         '</p>'+
//     '</div>'))
// .addTo(map);
// });
// add marker to map
new mapboxgl.Marker(el)
.setLngLat(marker.geometry.coordinates)
.setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
    .setHTML(info_cont))
.addTo(map);
});
    // var koLangStatus = document.querySelector(".ko").style.display;
//     var sessLang = "<?php //echo $_SESSION['language'];?>";
//     if(sessLang !== "en") {
//         // add marker to map
//         new mapboxgl.Marker(el)
//         .setLngLat(marker.geometry.coordinates)
//         .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
//             .setHTML('<div class="'+ marker.properties.place_id + '" onclick="showDetailPlaceMap(this.className)">'+
//                 '<h3 class="ko">' +
//                     marker.properties.message_ko +
//                 '</h3><br>'+
//                 '<h4 class="ko">' + 
//                     marker.properties.sub_title_ko + 
//                 '</h4>'+
//                 '<p class="ko">' + 
//                     marker.properties.memo_ko + 
//                 '</p>'+
//             '</div>'))
//         .addTo(map);
//     } else {
//         // add marker to map
//         new mapboxgl.Marker(el)
//         .setLngLat(marker.geometry.coordinates)
//         .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
//             .setHTML('<div class="'+ marker.properties.place_id + '" onclick="showDetailPlaceMap(this.className)">'+
//                 '<h3 class="en">' +
//                     marker.properties.message_en +
//                 '</h3><br>'+
//                 '<h4 class="en">' + 
//                     marker.properties.sub_title_en + 
//                 '</h4>'+
//                 '<p class="en">' + 
//                     marker.properties.memo_en + 
//                 '</p>'+
//             '</div>'))
//         .addTo(map);

//     }
// });


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

    

    
    function markerSize() {
        var zoomLow = 14.4;
        var zoomHigh = 15.8;
        var zoomStatus = map.getZoom();

        if (zoomStatus > zoomLow && zoomStatus < zoomHigh) {
            //****1:1****//
            let miniCubeAll = document.querySelectorAll(".miniCube");
            let mnc;
            for(mnc=0; mnc < miniCubeAll.length; mnc++) {
                miniCubeAll[mnc].style.width = "30px";
                // miniCubeAll[mnc].style.height = "calc(30px + 35px)";
                miniCubeAll[mnc].style.height = "30px";
                miniCubeAll[mnc].style.backgroundSize = "contain";
                miniCubeAll[mnc].style.backgroundRepeat = "no-repeat";
                miniCubeAll[mnc].style.cursor = "pointer";
                // miniCubeAll[mnc].style.transition = "0.03s";
                miniCubeAll[mnc].onmouseover = function() {
                    this.style.width = 30*1.2 + "px";
                    this.style.height = 30*1.2 + "px";
                };
                miniCubeAll[mnc].onmouseleave = function() {
                    this.style.width = 30*1.0 + "px";
                    this.style.height = 30*1.0 + "px";
                };
            }
            let smallCubeAll = document.querySelectorAll(".smallCube");
            let sc;
            for(sc=0; sc < smallCubeAll.length; sc++) {
                smallCubeAll[sc].style.width = "60px";
                // smallCubeAll[sc].style.height = "calc(60px + 35px)";
                smallCubeAll[sc].style.height = "60px";
                smallCubeAll[sc].style.backgroundSize = "contain";
                smallCubeAll[sc].style.backgroundRepeat = "no-repeat";
                smallCubeAll[sc].style.cursor = "pointer";
                // smallCubeAll[sc].style.transition = "0.03s";
                smallCubeAll[sc].onmouseover = function() {
                    this.style.width = 60*1.2 + "px";
                    this.style.height = 60*1.2 + "px";
                };
                smallCubeAll[sc].onmouseleave = function() {
                    this.style.width = 60*1.0 + "px";
                    this.style.height = 60*1.0 + "px";
                };
            }
            let middleCubeAll = document.querySelectorAll(".middleCube");
            let mc;
            for(mc=0; mc < middleCubeAll.length; mc++) {
                middleCubeAll[mc].style.width = "80px";
                // middleCubeAll[mc].style.height = "calc(80px + 35px)";
                middleCubeAll[mc].style.height = "80px";
                middleCubeAll[mc].style.backgroundSize = "contain";
                middleCubeAll[mc].style.backgroundRepeat = "no-repeat";
                middleCubeAll[mc].style.cursor = "pointer";
                // middleCubeAll[mc].style.transition = "0.03s";
                middleCubeAll[mc].onmouseover = function() {
                    this.style.width = 80*1.2 + "px";
                    this.style.height = 80*1.2 + "px";
                };
                middleCubeAll[mc].onmouseleave = function() {
                    this.style.width = 80*1.0 + "px";
                    this.style.height = 80*1.0 + "px";
                };
            }
            //****1:1.6****//
            let smallHoriAll = document.querySelectorAll(".smallHori");
            let sh;
            for(sh=0; sh < smallHoriAll.length; sh++) {
                smallHoriAll[sh].style.width = "80px";
                // smallHoriAll[sh].style.height = "calc(50px + 35px)";
                smallHoriAll[sh].style.height = "50px";
                smallHoriAll[sh].style.backgroundSize = "contain";
                smallHoriAll[sh].style.backgroundRepeat = "no-repeat";
                smallHoriAll[sh].style.cursor = "pointer";
                // smallHoriAll[sh].style.transition = "0.03s";
                smallHoriAll[sh].onmouseover = function() {
                    this.style.width = 80*1.2 + "px";
                    this.style.height = 50*1.2 + "px";
                };
                smallHoriAll[sh].onmouseleave = function() {
                    this.style.width = 80*1.0 + "px";
                    this.style.height = 50*1.0 + "px";
                };
            }
            let middleHoriAll = document.querySelectorAll(".middleHori");
            let mh;
            for(mh=0; mh < middleHoriAll.length; mh++) {
                middleHoriAll[mh].style.width = "108px";
                // middleHoriAll[mh].style.height = "calc(60px + 35px)";
                middleHoriAll[mh].style.height = "60px";
                middleHoriAll[mh].style.backgroundSize = "contain";
                middleHoriAll[mh].style.backgroundRepeat = "no-repeat";
                middleHoriAll[mh].style.cursor = "pointer";
                // middleHoriAll[mh].style.transition = "0.03s";
                middleHoriAll[mh].onmouseover = function() {
                    this.style.width = 108*1.2 + "px";
                    this.style.height = 60*1.2 + "px";
                };
                middleHoriAll[mh].onmouseleave = function() {
                    this.style.width = 108*1.0 + "px";
                    this.style.height = 60*1.0 + "px";
                };
            }
            let bigHoriAll = document.querySelectorAll(".bigHori");
            let bh;
            for(bh=0; bh < bigHoriAll.length; bh++) {
                bigHoriAll[bh].style.width = "160px";
                // bigHoriAll[bh].style.height = "calc(100px + 35px)";
                bigHoriAll[bh].style.height = "100px";
                bigHoriAll[bh].style.backgroundSize = "contain";
                bigHoriAll[bh].style.backgroundRepeat = "no-repeat";
                bigHoriAll[bh].style.cursor = "pointer";
                // bigHoriAll[bh].style.transition = "0.03s";
                bigHoriAll[bh].onmouseover = function() {
                    this.style.width = 160*1.2 + "px";
                    this.style.height = 100*1.2 + "px";
                };
                bigHoriAll[bh].onmouseleave = function() {
                    this.style.width = 160*1.0 + "px";
                    this.style.height = 100*1.0 + "px";
                };
            }
            //****1:2****//
            let smallPanoAll = document.querySelectorAll(".smallPano");
            let sp;
            for(sp=0; sp < smallPanoAll.length; sp++) {
                smallPanoAll[sp].style.width = "80px";
                // smallPanoAll[sp].style.height = "calc(40px + 35px)";
                smallPanoAll[sp].style.height = "40px";
                smallPanoAll[sp].style.backgroundSize = "contain";
                smallPanoAll[sp].style.backgroundRepeat = "no-repeat";
                smallPanoAll[sp].style.cursor = "pointer";
                // smallPanoAll[sp].style.transition = "0.03s";
                smallPanoAll[sp].onmouseover = function() {
                    this.style.width = 80*1.2 + "px";
                    this.style.height = 40*1.2 + "px";
                };
                smallPanoAll[sp].onmouseleave = function() {
                    this.style.width = 80*1.0 + "px";
                    this.style.height = 40*1.0 + "px";
                };
            }
            let middlePanoAll = document.querySelectorAll(".middlePano");
            let mp;
            for(mp=0; mp < middlePanoAll.length; mp++) {
                middlePanoAll[mp].style.width = "120px";
                // middlePanoAll[mp].style.height = "calc(60px + 35px)";
                middlePanoAll[mp].style.height = "60px";
                middlePanoAll[mp].style.backgroundSize = "contain";
                middlePanoAll[mp].style.backgroundRepeat = "no-repeat";
                middlePanoAll[mp].style.cursor = "pointer";
                // middlePanoAll[mp].style.transition = "0.03s";
                middlePanoAll[mp].onmouseover = function() {
                    this.style.width = 120*1.2 + "px";
                    this.style.height = 60*1.2 + "px";
                };
                middlePanoAll[mp].onmouseleave = function() {
                    this.style.width = 120*1.0 + "px";
                    this.style.height = 60*1.0 + "px";
                };
            }
            //****1:2.7****//
            let longPanoAll = document.querySelectorAll(".longPano");
            let lp;
            for(lp=0; lp < longPanoAll.length; lp++) {
                longPanoAll[lp].style.width = "160px";
                // longPanoAll[lp].style.height = "calc(60px + 35px)";
                longPanoAll[lp].style.height = "60px";
                longPanoAll[lp].style.backgroundSize = "contain";
                longPanoAll[lp].style.backgroundRepeat = "no-repeat";
                longPanoAll[lp].style.cursor = "pointer";
                // longPanoAll[lp].style.transition = "0.03s";
                longPanoAll[lp].onmouseover = function() {
                    this.style.width = 160*1.2 + "px";
                    this.style.height = 60*1.2 + "px";
                };
                longPanoAll[lp].onmouseleave = function() {
                    this.style.width = 160*1.0 + "px";
                    this.style.height = 60*1.0 + "px";
                };
            }
            //****3:1****//
            let longVertiAll = document.querySelectorAll(".longVerti");
            let lv;
            for(lv=0; lv < longVertiAll.length; lv++) {
                longVertiAll[lv].style.width = "60px";
                // longVertiAll[lv].style.height = "calc(60px + 35px)";
                longVertiAll[lv].style.height = "180px";
                longVertiAll[lv].style.backgroundSize = "contain";
                longVertiAll[lv].style.backgroundRepeat = "no-repeat";
                longVertiAll[lv].style.cursor = "pointer";
                // longVertiAll[lv].style.transition = "0.03s";
                longVertiAll[lv].onmouseover = function() {
                    this.style.width = 60*1.2 + "px";
                    this.style.height = 180*1.2 + "px";
                };
                longVertiAll[lv].onmouseleave = function() {
                    this.style.width = 60*1.0 + "px";
                    this.style.height = 180*1.0 + "px";
                };
            }
        } else if (zoomStatus < zoomLow) {
            //****1:1****//
            let miniCubeAll = document.querySelectorAll(".miniCube");
            let mnc;
            for(mnc=0; mnc < miniCubeAll.length; mnc++) {
                miniCubeAll[mnc].style.width = "30px";
                // miniCubeAll[mnc].style.height = "calc(30px + 35px)";
                miniCubeAll[mnc].style.height = "30px";
                miniCubeAll[mnc].style.backgroundSize = "contain";
                miniCubeAll[mnc].style.backgroundRepeat = "no-repeat";
                miniCubeAll[mnc].style.cursor = "pointer";
                // miniCubeAll[mnc].style.transition = "0.03s";
                miniCubeAll[mnc].onmouseover = function() {
                    this.style.width = 30*1.2 + "px";
                    this.style.height = 30*1.2 + "px";
                };
                miniCubeAll[mnc].onmouseleave = function() {
                    this.style.width = 30*1.0 + "px";
                    this.style.height = 30*1.0 + "px";
                };
            }
            let smallCubeAll = document.querySelectorAll(".smallCube");
            let sc;
            for(sc=0; sc < smallCubeAll.length; sc++) {
                smallCubeAll[sc].style.width = "30px";
                // smallCubeAll[sc].style.height = "calc(30px + 35px)";
                smallCubeAll[sc].style.height = "30px";
                smallCubeAll[sc].style.backgroundSize = "contain";
                smallCubeAll[sc].style.backgroundRepeat = "no-repeat";
                smallCubeAll[sc].style.cursor = "pointer";
                // smallCubeAll[sc].style.transition = "0.03s";
                smallCubeAll[sc].onmouseover = function() {
                    this.style.width = 30*1.2 + "px";
                    this.style.height = 30*1.2 + "px";
                };
                smallCubeAll[sc].onmouseleave = function() {
                    this.style.width = 30*1.0 + "px";
                    this.style.height = 30*1.0 + "px";
                };
            }
            let middleCubeAll = document.querySelectorAll(".middleCube");
            let mc;
            for(mc=0; mc < middleCubeAll.length; mc++) {
                middleCubeAll[mc].style.width = "35px";
                // middleCubeAll[mc].style.height = "calc(35px + 35px)";
                middleCubeAll[mc].style.height = "35px";
                middleCubeAll[mc].style.backgroundSize = "contain";
                middleCubeAll[mc].style.backgroundRepeat = "no-repeat";
                middleCubeAll[mc].style.cursor = "pointer";
                // middleCubeAll[mc].style.transition = "0.03s";
                middleCubeAll[mc].onmouseover = function() {
                    this.style.width = 35*1.2 + "px";
                    this.style.height = 35*1.2 + "px";
                };
                middleCubeAll[mc].onmouseleave = function() {
                    this.style.width = 35*1.0 + "px";
                    this.style.height = 35*1.0 + "px";
                };
            }
            //****1:1.6****//
            let smallHoriAll = document.querySelectorAll(".smallHori");
            let sh;
            for(sh=0; sh < smallHoriAll.length; sh++) {
                smallHoriAll[sh].style.width = "40px";
                // smallHoriAll[sh].style.height = "calc(25px + 35px)";
                smallHoriAll[sh].style.height = "25px";
                smallHoriAll[sh].style.backgroundSize = "contain";
                smallHoriAll[sh].style.backgroundRepeat = "no-repeat";
                smallHoriAll[sh].style.cursor = "pointer";
                // smallHoriAll[sh].style.transition = "0.03s";
                smallHoriAll[sh].onmouseover = function() {
                    this.style.width = 40*1.2 + "px";
                    this.style.height = 25*1.2 + "px";
                };
                smallHoriAll[sh].onmouseleave = function() {
                    this.style.width = 40*1.0 + "px";
                    this.style.height = 25*1.0 + "px";
                };
            }
            let middleHoriAll = document.querySelectorAll(".middleHori");
            let mh;
            for(mh=0; mh < middleHoriAll.length; mh++) {
                middleHoriAll[mh].style.width = "48px";
                // middleHoriAll[mh].style.height = "calc(30px + 35px)";
                middleHoriAll[mh].style.height = "30px";
                middleHoriAll[mh].style.backgroundSize = "contain";
                middleHoriAll[mh].style.backgroundRepeat = "no-repeat";
                middleHoriAll[mh].style.cursor = "pointer";
                // middleHoriAll[mh].style.transition = "0.03s";
                middleHoriAll[mh].onmouseover = function() {
                    this.style.width = 48*1.2 + "px";
                    this.style.height = 30*1.2 + "px";
                };
                middleHoriAll[mh].onmouseleave = function() {
                    this.style.width = 48*1.0 + "px";
                    this.style.height = 30*1.0 + "px";
                };
            }
            let bigHoriAll = document.querySelectorAll(".bigHori");
            let bh;
            for(bh=0; bh < bigHoriAll.length; bh++) {
                bigHoriAll[bh].style.width = "56px";
                // bigHoriAll[bh].style.height = "calc(35px + 35px)";
                bigHoriAll[bh].style.height = "35px";
                bigHoriAll[bh].style.backgroundSize = "contain";
                bigHoriAll[bh].style.backgroundRepeat = "no-repeat";
                bigHoriAll[bh].style.cursor = "pointer";
                // bigHoriAll[bh].style.transition = "0.03s";
                bigHoriAll[bh].onmouseover = function() {
                    this.style.width = 56*1.2 + "px";
                    this.style.height = 35*1.2 + "px";
                };
                bigHoriAll[bh].onmouseleave = function() {
                    this.style.width = 56*1.0 + "px";
                    this.style.height = 35*1.0 + "px";
                };
            }
            //****1:2****//
            let smallPanoAll = document.querySelectorAll(".smallPano");
            let sp;
            for(sp=0; sp < smallPanoAll.length; sp++) {
                smallPanoAll[sp].style.width = "40px";
                // smallPanoAll[sp].style.height = "calc(20px + 35px)";
                smallPanoAll[sp].style.height = "20px";
                smallPanoAll[sp].style.backgroundSize = "contain";
                smallPanoAll[sp].style.backgroundRepeat = "no-repeat";
                smallPanoAll[sp].style.cursor = "pointer";
                // smallPanoAll[sp].style.transition = "0.03s";
                smallPanoAll[sp].onmouseover = function() {
                    this.style.width = 40*1.2 + "px";
                    this.style.height = 20*1.2 + "px";
                };
                smallPanoAll[sp].onmouseleave = function() {
                    this.style.width = 40*1.0 + "px";
                    this.style.height = 20*1.0 + "px";
                };
            }
            let middlePanoAll = document.querySelectorAll(".middlePano");
            let mp;
            for(mp=0; mp < middlePanoAll.length; mp++) {
                middlePanoAll[mp].style.width = "50px";
                // middlePanoAll[mp].style.height = "calc(25px + 35px)";
                middlePanoAll[mp].style.height = "25px";
                middlePanoAll[mp].style.backgroundSize = "contain";
                middlePanoAll[mp].style.backgroundRepeat = "no-repeat";
                middlePanoAll[mp].style.cursor = "pointer";
                // middlePanoAll[mp].style.transition = "0.03s";
                middlePanoAll[mp].onmouseover = function() {
                    this.style.width = 50*1.2 + "px";
                    this.style.height = 25*1.2 + "px";
                };
                middlePanoAll[mp].onmouseleave = function() {
                    this.style.width = 50*1.0 + "px";
                    this.style.height = 25*1.0 + "px";
                };
            }
            //****1:2.7****//
            let longPanoAll = document.querySelectorAll(".longPano");
            let lp;
            for(lp=0; lp < longPanoAll.length; lp++) {
                longPanoAll[lp].style.width = "54px";
                // longPanoAll[lp].style.height = "calc(20px + 35px)";
                longPanoAll[lp].style.height = "20px";
                longPanoAll[lp].style.backgroundSize = "contain";
                longPanoAll[lp].style.backgroundRepeat = "no-repeat";
                longPanoAll[lp].style.cursor = "pointer";
                // longPanoAll[lp].style.transition = "0.03s";
                longPanoAll[lp].onmouseover = function() {
                    this.style.width = 54*1.2 + "px";
                    this.style.height = 20*1.2 + "px";
                };
                longPanoAll[lp].onmouseleave = function() {
                    this.style.width = 54*1.0 + "px";
                    this.style.height = 20*1.0 + "px";
                };
            }
            //****3:1****//
            let longVertiAll = document.querySelectorAll(".longVerti");
            let lv;
            for(lv=0; lv < longVertiAll.length; lv++) {
                longVertiAll[lv].style.width = "25px";
                // longVertiAll[lv].style.height = "calc(60px + 35px)";
                longVertiAll[lv].style.height = "75px";
                longVertiAll[lv].style.backgroundSize = "contain";
                longVertiAll[lv].style.backgroundRepeat = "no-repeat";
                longVertiAll[lv].style.cursor = "pointer";
                // longVertiAll[lv].style.transition = "0.03s";
                longVertiAll[lv].onmouseover = function() {
                    this.style.width = 25*1.2 + "px";
                    this.style.height = 75*1.2 + "px";
                };
                longVertiAll[lv].onmouseleave = function() {
                    this.style.width = 25*1.0 + "px";
                    this.style.height = 75*1.0 + "px";
                };
            }
        } else {
            //****1:1****//
            let miniCubeAll = document.querySelectorAll(".miniCube");
            let mnc;
            for(mnc=0; mnc < miniCubeAll.length; mnc++) {
                miniCubeAll[mnc].style.width = "30px";
                // miniCubeAll[mnc].style.height = "calc(30px + 35px)";
                miniCubeAll[mnc].style.height = "30px";
                miniCubeAll[mnc].style.backgroundSize = "contain";
                miniCubeAll[mnc].style.backgroundRepeat = "no-repeat";
                miniCubeAll[mnc].style.cursor = "pointer";
                // miniCubeAll[mnc].style.transition = "0.03s";
                miniCubeAll[mnc].onmouseover = function() {
                    this.style.width = 30*1.2 + "px";
                    this.style.height = 30*1.2 + "px";
                };
                miniCubeAll[mnc].onmouseleave = function() {
                    this.style.width = 30*1.0 + "px";
                    this.style.height = 30*1.0 + "px";
                };
            }
            let smallCubeAll = document.querySelectorAll(".smallCube");
            let sc;
            for(sc=0; sc < smallCubeAll.length; sc++) {
                smallCubeAll[sc].style.width = "90px";
                // smallCubeAll[sc].style.height = "calc(90px + 35px)";
                smallCubeAll[sc].style.height = "90px";
                smallCubeAll[sc].style.backgroundSize = "contain";
                smallCubeAll[sc].style.backgroundRepeat = "no-repeat";
                smallCubeAll[sc].style.cursor = "pointer";
                // smallCubeAll[sc].style.transition = "0.03s";
                smallCubeAll[sc].onmouseover = function() {
                    this.style.width = 90*1.2 + "px";
                    this.style.height = 90*1.2 + "px";
                };
                smallCubeAll[sc].onmouseleave = function() {
                    this.style.width = 90*1.0 + "px";
                    this.style.height = 90*1.0 + "px";
                };
            }
            let middleCubeAll = document.querySelectorAll(".middleCube");
            let mc;
            for(mc=0; mc < middleCubeAll.length; mc++) {
                middleCubeAll[mc].style.width = "120px";
                // middleCubeAll[mc].style.height = "calc(120px + 35px)";
                middleCubeAll[mc].style.height = "120px";
                middleCubeAll[mc].style.backgroundSize = "contain";
                middleCubeAll[mc].style.backgroundRepeat = "no-repeat";
                middleCubeAll[mc].style.cursor = "pointer";
                // middleCubeAll[mc].style.transition = "0.03s";
                middleCubeAll[mc].onmouseover = function() {
                    this.style.width = 120*1.2 + "px";
                    this.style.height = 120*1.2 + "px";
                };
                middleCubeAll[mc].onmouseleave = function() {
                    this.style.width = 120*1.0 + "px";
                    this.style.height = 120*1.0 + "px";
                };
            }
            //****1:1.6****//
            let smallHoriAll = document.querySelectorAll(".smallHori");
            let sh;
            for(sh=0; sh < smallHoriAll.length; sh++) {
                smallHoriAll[sh].style.width = "120px";
                // smallHoriAll[sh].style.height = "calc(75px + 35px)";
                smallHoriAll[sh].style.height = "75px";
                smallHoriAll[sh].style.backgroundSize = "contain";
                smallHoriAll[sh].style.backgroundRepeat = "no-repeat";
                smallHoriAll[sh].style.cursor = "pointer";
                // smallHoriAll[sh].style.transition = "0.03s";
                smallHoriAll[sh].onmouseover = function() {
                    this.style.width = 120*1.2 + "px";
                    this.style.height = 75*1.2 + "px";
                };
                smallHoriAll[sh].onmouseleave = function() {
                    this.style.width = 120*1.0 + "px";
                    this.style.height = 75*1.0 + "px";
                };
            }
            let middleHoriAll = document.querySelectorAll(".middleHori");
            let mh;
            for(mh=0; mh < middleHoriAll.length; mh++) {
                middleHoriAll[mh].style.width = "160px";
                // middleHoriAll[mh].style.height = "calc(100px + 35px)";
                middleHoriAll[mh].style.height = "100px";
                middleHoriAll[mh].style.backgroundSize = "contain";
                middleHoriAll[mh].style.backgroundRepeat = "no-repeat";
                middleHoriAll[mh].style.cursor = "pointer";
                // middleHoriAll[mh].style.transition = "0.03s";
                middleHoriAll[mh].onmouseover = function() {
                    this.style.width = 160*1.2 + "px";
                    this.style.height = 100*1.2 + "px";
                };
                middleHoriAll[mh].onmouseleave = function() {
                    this.style.width = 160*1.0 + "px";
                    this.style.height = 100*1.0 + "px";
                };
            }
            let bigHoriAll = document.querySelectorAll(".bigHori");
            let bh;
            for(bh=0; bh < bigHoriAll.length; bh++) {
                bigHoriAll[bh].style.width = "200px";
                // bigHoriAll[bh].style.height = "calc(125px + 35px)";
                bigHoriAll[bh].style.height = "125px";
                bigHoriAll[bh].style.backgroundSize = "contain";
                bigHoriAll[bh].style.backgroundRepeat = "no-repeat";
                bigHoriAll[bh].style.cursor = "pointer";
                // bigHoriAll[bh].style.transition = "0.03s";
                bigHoriAll[bh].onmouseover = function() {
                    this.style.width = 200*1.2 + "px";
                    this.style.height = 125*1.2 + "px";
                };
                bigHoriAll[bh].onmouseleave = function() {
                    this.style.width = 200*1.0 + "px";
                    this.style.height = 125*1.0 + "px";
                };
            }
            //****1:2****//
            let smallPanoAll = document.querySelectorAll(".smallPano");
            let sp;
            for(sp=0; sp < smallPanoAll.length; sp++) {
                smallPanoAll[sp].style.width = "120px";
                // smallPanoAll[sp].style.height = "calc(60px + 35px)";
                smallPanoAll[sp].style.height = "60px";
                smallPanoAll[sp].style.backgroundSize = "contain";
                smallPanoAll[sp].style.backgroundRepeat = "no-repeat";
                smallPanoAll[sp].style.cursor = "pointer";
                // smallPanoAll[sp].style.transition = "0.03s";
                smallPanoAll[sp].onmouseover = function() {
                    this.style.width = 120*1.2 + "px";
                    this.style.height = 60*1.2 + "px";
                };
                smallPanoAll[sp].onmouseleave = function() {
                    this.style.width = 120*1.0 + "px";
                    this.style.height = 60*1.0 + "px";
                };
            }
            let middlePanoAll = document.querySelectorAll(".middlePano");
            let mp;
            for(mp=0; mp < middlePanoAll.length; mp++) {
                middlePanoAll[mp].style.width = "160px";
                // middlePanoAll[mp].style.height = "calc(80px + 35px)";
                middlePanoAll[mp].style.height = "80px";
                middlePanoAll[mp].style.backgroundSize = "contain";
                middlePanoAll[mp].style.backgroundRepeat = "no-repeat";
                middlePanoAll[mp].style.cursor = "pointer";
                // middlePanoAll[mp].style.transition = "0.03s";
                middlePanoAll[mp].onmouseover = function() {
                    this.style.width = 160*1.2 + "px";
                    this.style.height = 80*1.2 + "px";
                };
                middlePanoAll[mp].onmouseleave = function() {
                    this.style.width = 160*1.0 + "px";
                    this.style.height = 80*1.0 + "px";
                };
            }
            //****1:2.7****//
            let longPanoAll = document.querySelectorAll(".longPano");
            let lp;
            for(lp=0; lp < longPanoAll.length; lp++) {
                longPanoAll[lp].style.width = "220px";
                // longPanoAll[lp].style.height = "calc(82px + 35px)";
                longPanoAll[lp].style.height = "82px";
                longPanoAll[lp].style.backgroundSize = "contain";
                longPanoAll[lp].style.backgroundRepeat = "no-repeat";
                longPanoAll[lp].style.cursor = "pointer";
                // longPanoAll[lp].style.transition = "0.03s";
                longPanoAll[lp].onmouseover = function() {
                    this.style.width = 220*1.2 + "px";
                    this.style.height = 82*1.2 + "px";
                };
                longPanoAll[lp].onmouseleave = function() {
                    this.style.width = 220*1.0 + "px";
                    this.style.height = 82*1.0 + "px";
                };
            }
            //****3:1****//
            let longVertiAll = document.querySelectorAll(".longVerti");
            let lv;
            for(lv=0; lv < longVertiAll.length; lv++) {
                longVertiAll[lv].style.width = "80px";
                // longVertiAll[lv].style.height = "calc(60px + 35px)";
                longVertiAll[lv].style.height = "240px";
                longVertiAll[lv].style.backgroundSize = "contain";
                longVertiAll[lv].style.backgroundRepeat = "no-repeat";
                longVertiAll[lv].style.cursor = "pointer";
                // longVertiAll[lv].style.transition = "0.03s";
                longVertiAll[lv].onmouseover = function() {
                    this.style.width = 80*1.2 + "px";
                    this.style.height = 240*1.2 + "px";
                };
                longVertiAll[lv].onmouseleave = function() {
                    this.style.width = 80*1.0 + "px";
                    this.style.height = 240*1.0 + "px";
                };
            }
        }
    }
    markerSize();
    map.on('zoomend', function() {
        markerSize();
    });




    
    </script>