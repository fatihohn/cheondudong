

	// local test domain
	var domain = "/isbcc"

	// check if IE
	function isIE() {
	    var ua = window.navigator.userAgent; //Check the userAgent property of the window.navigator object
	    var msie = ua.indexOf('MSIE '); // IE 10 or older
	    var trident = ua.indexOf('Trident/'); //IE 11

	    return (msie > 0 || trident > 0);
	}
	if (window.orientation == undefined && window.innerWidth > 768) {
		var is_mobile = false;
	} else {
		var is_mobile = true;
	}

	var is_IE = isIE();
	// var is_IE = true;

	var all_data;
	var data_detail;
	var current_place_index, current_work_index;
	var current_code;
	var current_type;
	var current_view = "map";
	var current_open_place;

	var list_data = {		
						"list_text"	: [
							{
								"title" : "성북구의 문학 작품", 
								"description" : "성북구의 이야기를 담은 문학 작품 목록입니다"
							},
							{
								"title" : "성북구의 작가",
								"description": "성북구의 이야기를 쓴 작가 목록입니다"
							},
							{
								"title": "성북구의 장소",
								"description": "문학 작품 속 등장하는 성북구의 장소 목록입니다"
							},
						 ]
					}


	// MAPBOX STUFF
	
	var map;
	var location_data = {"country":"", "city":"", "sublocality_level_1" : "", "sublocality_level_2" : ""}

	var geocoder;
	var built_address = "";
	var is_seongbukgu = false;
	var user_coordinates;
	var geocode_results;
	var distance_from_seongbukgu;
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

	// delay intro svg aims
	setTimeout(function(){ 
		$('.intro_anim').addClass('anim-on')
	 }, 1000);


	// FN load mapbox map
	function init_mapbox() {

		mapboxgl.accessToken = "pk.eyJ1IjoiZmFyaXNrYXNzaW0iLCJhIjoiSk1MaUthdyJ9.vkxtdDbYdLi524WwlKORBw";
		map = new mapboxgl.Map({
		    container: "map",
		    style: "mapbox://styles/rebel9act/cjogkrufs0ldt2rlyf3y0390i",
		    center: [127.013387, 37.590479],
		    maxBounds: [
	    	// 	// strictly seongbukgu
	    	// 	// [126.972368, 37.572532], // Southwest coordinates
	    	// 	// [127.073682, 37.629226]  // Northeast coordinates
	    		
	    	// 	// limit hapjeong <-> nowon 
	    	// 	[126.907793, 37.547946], // Southwest limit coordinates 
	    	// 	[127.093138, 37.643414]  // Northeast limit coordinates

	    	// limit seoul city 
	    	[126.763987, 37.409558], // Southwest limit coordinates 
	    	[127.139709, 37.791012] // Northeast limit coordinates


		    ],
		    zoom: 14,
		    // minZoom: 14,
		    maxZoom: 18
		    // pitch: 60, // pitch in degrees
		    // bearing: -60, // bearing in degrees
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


		console.log('initiating mapbox');

		// After the map style has loaded on the page, add a source layer and default
		// styling for a single point.
		map.on("load", function() {	

			console.log('mapbox loaded')

		    map.addSource("single-point", {
		        "type": "geojson",
		        "data": {
		            "type": "FeatureCollection",
		            "features": []
		        }
		    });

		 //    // add image overlay to map
		 //    // commented out
			// map.addSource("myImageSource", {
   //              "type": "image",
   //              "url": "https://docs.mapbox.com/mapbox-gl-js/assets/radar.gif",
   //              "coordinates": [
   //                  [127.016043, 37.589432],
   //                  [127.02299, 37.589432],
   //                  [127.016043, 37.590432],
   //                  [127.016043, 37.590432]
   //              ]
   //          })

   //         map.addLayer({
   //              "id": "overlay2",
   //              "source": "myImageSource",
   //              "type": "raster",
   //              "paint": {
   //              "raster-opacity": 0.85
   //              }
   //          });


			map.loadImage("img/icn/icn_me.png", function(error, image) {
			  if (error) throw error;
			  map.addImage("custom-marker", image);
			  /* Style layer: A style layer ties together the source and image and specifies how they are displayed on the map. */
			  map.addLayer({
			    id: "markers",
			    type: "symbol",
			    /* Source: A data source specifies the geographic coordinate where the image marker gets placed. */
			    "source": "single-point",
			    layout: {
			      "icon-image": "custom-marker",
			      "icon-size": 0.5
			    }
			  });
			});

			map_markers = {
			    "type": "FeatureCollection",
			    "features": []
			};

			console.log('before ajax data request')
			// DATA get all place data FOR MAP
		    $.ajax({
				method: "POST",
				url: domain+"/mobile/api/v1/map/theme/1.do",
				contentType: "application/json",
				crossDomain: true,
		    })

		    .done(function( json, textStatus, jqXHR ) {
		      	// detail_data = json.response.data;
		      	console.log("all_data received:", json.data)
		      	all_data = json.data;
		      	data_loaded = true;
				
				// on first site load, check browser url
				// if has place / work / writer  param, show detail panel
				if (first_load) {
					url_params = window.location.search;

					// if url has place / work / writer 
					if (url_params.indexOf("?place") >= 0 || url_params.indexOf("?work") >= 0 || url_params.indexOf("?writer") >= 0) {
					  
						var data_type = url_params.substring(0, url_params.indexOf("=")).replace("?","");
						var data_code = url_params.substring(url_params.indexOf("=") + 1);
						// only show detail panel if theres such a data type / data_index

						// if (all_data[data_type+"s"] != undefined) {
						// 	populate_details(data_type, null, data_code)
						// }
						populate_details(data_type, null, data_code)
					} 
					// if url doesnt match anything, wipe clean
					else {
					  console.log("case3, url doesnt match anything, wipe clean")
					  wipeclean_url("all");
					}	
					// toggle first_load
					first_load = false;
				};
				// END first_load


		      	// add all place markers to map
				for (var i = 0; i < all_data.length; i++) {
					var data_to_add = 	{
								            "type": "Feature",
								            "properties": {
								                "message": "Marker "+i,
								                "index": i,
								                "iconSize": [22, 30]
								            },
								            "geometry": {
								                "type": "Point",
								                "coordinates": [
								                    all_data[i].address.longitude,
								                    all_data[i].address.latitude
								                ]
								            }
								        }
				    //console.log(data_to_add);

					map_markers.features.push(data_to_add);

				    // create place marker and add to map
				    var el = document.createElement("div");
				    el.className = "marker_places place_"+all_data[i].sn;
				    el.dataset.index = i;
				    el.dataset.code = all_data[i].sn;
				    //el.style.backgroundImage = "url(img/icn/marker_place.svg)";
				    el.style.width = map_markers.features[i].properties.iconSize[0] + "px";
				    el.style.height = map_markers.features[i].properties.iconSize[1] + "px";


				    // append thumbnail image to place marker
			    	var place_thumb = document.createElement('div');
			    	place_thumb.className = "place_thumb";
			    	var place_thumb_img = document.createElement("img");
			    	if (!is_IE) {
			    		place_thumb_img.src = "img/icn/marker_place.svg";	
			    	} else {
			    		place_thumb_img.src = "img/icn/marker_place.png";
			    	}
			    	
			    	place_thumb.appendChild(place_thumb_img);
			    	el.appendChild(place_thumb)

				    var name_span = document.createElement('span')
				    name_span.innerHTML = all_data[i].name.korean;
				    el.appendChild(name_span);

				    el.addEventListener('click', function() {
				        // window.alert(marker.properties.message);
				    });

				    // add marker to map
				    new mapboxgl.Marker(el)
				        .setLngLat(map_markers.features[i].geometry.coordinates)
				        .addTo(map);

				};

				// show 'get location' button when all places are added to map
				setTimeout(function(){ 
					$(".intro_loading").fadeOut(function() {
						$(".intro_success").fadeIn();	
					});
				}, 600);


				// get all quotes

				for (var zz = 0; zz < all_data.length; zz++) {

					for (var yy = 0; yy < all_data[zz].works.length; yy++) {

						if ( all_data[zz].works[yy].section != null) {
							quotes_array.push({
								"name": all_data[zz].works[yy].name, 
								"sn": all_data[zz].works[yy].sn, 
								"quote": all_data[zz].works[yy].section
							})
						}

					}

				}


				map.addControl(new mapboxgl.NavigationControl());

				map.on('moveend', function (e) { 

					if (map.getZoom() > 14.8) {
						$('.marker_places').addClass('show_label');
					} else {
						$('.marker_places').removeClass('show_label');
					}

				});



		    })
		    .fail(function(jqXHR, textStatus, errorThrown) {
		        console.log("HTTP Request Failed",jqXHR);
		    })
		    .always(function() {
		    	//console.log("init request made");
		    });


			// DATA get all place data FOR LIST
		    $.ajax({
				method: "POST",
				url: domain+"/mobile/api/v1/place/theme/1.do",
				contentType: "application/json",
				crossDomain: true,
		    })

		    .done(function( json, textStatus, jqXHR ) {
		      	// detail_data = json.response.data;
		      	console.log("list-data-place received:", json.data)
		      	list_data.list_place = json.data;
		      	// data_loaded = true;
		    })
		    .fail(function(jqXHR, textStatus, errorThrown) {
		        console.log("HTTP Request Failed",jqXHR);
		    })
		    .always(function() {
		    	//console.log("init request made");
		    });

			// DATA get all works data FOR LIST
		    $.ajax({
				method: "POST",
				url: domain+"/mobile/api/v1/works/theme/1.do",
				contentType: "application/json",
				crossDomain: true,
		    })

		    .done(function( json, textStatus, jqXHR ) {
		      	// detail_data = json.response.data;
		      	console.log("list-data-works received:", json.data)
		      	list_data.list_work = json.data;
		      	// data_loaded = true;
		    })
		    .fail(function(jqXHR, textStatus, errorThrown) {
		        console.log("HTTP Request Failed",jqXHR);
		    })
		    .always(function() {
		    	//console.log("init request made");
		    });

			// DATA get all writer data FOR LIST
		    $.ajax({
				method: "POST",
				url: domain+"/mobile/api/v1/writer/theme/1.do",
				contentType: "application/json",
				crossDomain: true,
		    })

		    .done(function( json, textStatus, jqXHR ) {
		      	// detail_data = json.response.data;
		      	console.log("list-data-writer received:", json.data)
		      	list_data.list_writer = json.data;
		      	// data_loaded = true;
		    })
		    .fail(function(jqXHR, textStatus, errorThrown) {
		        console.log("HTTP Request Failed",jqXHR);
		    })
		    .always(function() {
		    	//console.log("init request made");
		    });

		});
		// END map.on("load")

		map.on("click", function(e) {
			//console.log("clicked", e.originalEvent.path[0]) ;
			// event.path || (event.composedPath && event.composedPath()
			// console.log('pos',e)
			var clicked_element = e.originalEvent.srcElement.className;

			// if not clicking on markers, clear all relations + conencting lines
			if ( clicked_element == "mapboxgl-canvas"  ) {
				clear_map();
			}
		});


	};
	// END init_mapbox()


	function getClosestPlaceMarker(method) {
		console.log('getting closest places')
    	// BLOCK : look for shortest distance between user and all places
    	closest_location_arr = [];
    	for (var i = 0; i < all_data.length; i++) {
    		closest_location_arr.push( getDistanceFromLatLonInKm(user_coordinates.lat, user_coordinates.lng, all_data[i].address.latitude, all_data[i].address.longitude) ) ;
    	}

		lowest_index = 0;
		lowest_value = closest_location_arr[0];
		for (var i = 1; i < closest_location_arr.length; i++) {
		  if (closest_location_arr[i] < lowest_value) {
		    lowest_value = closest_location_arr[i];
		    lowest_index = i;
		  }
		};
		// closest_place_code = all_data[lowest_index].sn;
		// closest_place_name = '<'+all_data[lowest_index].name.korean+'> 중';

		console.log('closest place', all_data[lowest_index]);

		$('.drawer_works ul').empty();

		for (var i = 0; i < all_data[lowest_index].works.length; i++) {
			$('.drawer_works ul').append('\
				<li data-code="'+all_data[lowest_index].works[i].sn+'" data-type="work">\
					<div>\
						<img src="'+( all_data[lowest_index].works[i].thumbnailPath != null ? domain+all_data[lowest_index].works[i].thumbnailPath +' ' : 'img/icn/marker_work_active_default.png')+'">\
					</div>\
					<span>'+all_data[lowest_index].works[i].name.korean+'</span>\
				</li>\
			')
		}

		// only show drawer if location check is not a interval check
		if (method != 'interval') {
			$('.ui_map_bottom, #map').addClass('drawer_show');
			$('.ui_map_bottom, #map').addClass('drawer_open');	
		}
	}


	// FN get user location
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

				distance_from_seongbukgu = getDistanceFromLatLonInKm(user_coordinates.lat,user_coordinates.lng,37.598378,127.017768)

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
	/* END getUserLocation(); */

    // calculate distance to from 2 points in km
	function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
		function deg2rad(deg) {
		  return deg * (Math.PI/180)
		}

		var R = 6371; // Radius of the earth in km
		var dLat = deg2rad(lat2-lat1);  // deg2rad below
		var dLon = deg2rad(lon2-lon1); 
		var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * Math.sin(dLon/2) * Math.sin(dLon/2); 
		var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
		var d = R * c; // Distance in km
		return d;
	}


	// FN NO LOCATION FEATURE OR DISABLED OR ERROR
	function show_location_error(error) {
		supports_location = false;

		// hide location update if user no location 
		toggle_updatelocation(false);
		$('.btn_update_loc').removeClass('checking')
		$('.btn_update_loc img').attr('src', 'img/icn/icn_nav.svg');
		$(".btn_update_loc").hide();
		// SHOW ERROR MESSAGE 
		// HERE

		$(".ui_map_bottom").addClass("no_location")

		console.log("error",error);
		$(".map_status").html(error.message);	  



		if (error.code == 1) {
			console.log("User denied the request for Geolocation.") 
			$(".intro_fail span").html("당신의 위치를 확인할 수 없습니다");
		} 
		else if (error.code == 2) {
			console.log("Location information is unavailable.") 	
			$(".intro_fail span").html("당신의 위치를 확인할 수 없습니다");	
		}
		else if (error.code == 3) {
			console.log("The request to get user location timed out.")	
			$(".intro_fail span").html("당신의 위치를 확인할 수 없습니다");		
		}
		else if (error.code == 4) {
			console.log("An unknown error occurred.")		
			$(".intro_fail span").html("당신의 위치를 확인할 수 없습니다");	
		} else {
			console.log("An unknown error occurred.")		
			$(".intro_fail span").html("당신의 위치를 확인할 수 없습니다");	
		}


	};
	// END show_location_error()


	// FN reverse geocoding (convert coordinates to address)
	function getReverseGeocode(coordinates, method) {

		geocoder.mapboxClient.geocodeReverse({
			latitude: coordinates.lat, 
			longitude: coordinates.lng
		}, function(err, res) {

			// if success
			if (res.type == "FeatureCollection") {
				//console.log(err, res)
				geocode_results = res
				built_address = geocode_results.features[1].place_name;

				// draw user location on map
				map.getSource("single-point").setData({type: "Point", coordinates: [user_coordinates.lng,user_coordinates.lat]});
		   		
		   		// if user is in SBG
		        if (built_address.includes("Seongbuk-gu") || built_address.includes("성북구") ) {
		        	is_seongbukgu = true;
		        	//console.log("is_seongbukgu");

		        	// center map on user only if its not an interval location check
		        	if ( method != "interval") {
		        		map.easeTo({center: [coordinates.lng, coordinates.lat], zoom : 14});	
		        	}
		        	
					$(".btn_update_loc").show();
					$(".ui_map_bottom").removeClass("no_location")
					if (cam_denied != true) {
						$(".btn_opencam").show();	
						$(".ui_map_bottom").removeClass("no_cam")
					}
					
					// show nearest works here 
					// get closest place marker
	        		getClosestPlaceMarker(method);

					// start checking user location every x seconds
					if (location_interval_is_running == false) {
						check_location_interval = setInterval(location_interval, 20000);	
					}
					
		        } else {
		        	console.log("not seongbukgu");
		        	map.easeTo({center: [127.016043, 37.589432 ]});

		        	// if user is out of SBG but nearby SBG
		        	//update user location
		        	if (distance_from_seongbukgu < 6) {
		        		$(".btn_update_loc").show();
		        		$(".ui_map_bottom").removeClass("no_location")
		        	} else {
		        		// $(".btn_update_loc").hide();

		        		$(".ui_map_bottom").addClass("no_location")
		        	}

		        	// // hide cam buttons if user not in SBG
		        	// $(".btn_opencam").hide();
		        	// $(".ui_map_bottom").addClass("no_cam")

		        	// show cam even if user is not in sbg
					// $(".btn_opencam").show();	
					// $(".ui_map_bottom").removeClass("no_cam")

					// hide drawer if user is not in SBG
					$('.ui_map_bottom').removeClass('drawer_show');

		        	// stop checking interval if user goes out of SBG
		        	clear_location_interval()
		        }

		        // remove loading state from get location button
				$('.btn_update_loc').removeClass('checking')
				$('.btn_update_loc img').attr('src', 'img/icn/icn_nav.svg');

				$(".map_status").html( built_address +".<BR>In Seongbuk-gu?: "+ is_seongbukgu+ ".<BR>Distance from Seongbuk-gu: "+ parseInt(distance_from_seongbukgu)+"km" );
			}

		});
	};
	// END getReverseGeocode()


	// FN 
	function location_interval() {
		location_interval_is_running = true;
		getUserLocation("interval");
	};
	// END location_interval()


	// FN
	function clear_location_interval() {
		if (location_interval_is_running) {
			clearInterval(check_location_interval);	
			location_interval_is_running = false;
		}
	};
	// END clear_location_interval()


	// FN enable disable "update location" and cam button
	function toggle_updatelocation(condition) {
		is_checking_location = condition
		if (is_checking_location == true) {
			$(".btn_update_loc").addClass("disabled");
		} else {
			$(".btn_update_loc").removeClass("disabled");
		}
	};
	// END toggle_updatelocation()



	// FN find and show related places, works, people in relation to clicked place marker
	function check_relation(data_index) {

		var related_data = all_data[data_index].works

		clear_map();

		// set up empty features for floater markers
		floaters_markers = {
		    "type": "FeatureCollection",
		    "features": []
		};


		// check for related works and add to floaters_markers.features
		if (related_data.length > 0) {

			for (var i = 0; i < related_data.length; i++) {

				var works_to_add = {
							            "type": "Feature",
							            "properties": {
							                "message": "Work "+i,
							                "markertype": "work",
							                "code": related_data[i].sn,
							                "index": i,
							                "name": related_data[i].name.korean
							            },
							            "geometry": {
							                "type": "Point",
							                "coordinates": [
							                    0,
							                    0
							                ]
							            }
							        }



				floaters_markers.features.push(works_to_add);	
				

			}
		};


		// add all floaters_markers to map as markers
		if (floaters_markers.features.length > 0) {

			for (var i = 0; i < floaters_markers.features.length; i++) {

				// radius of related items
				var floaters_rad = 0.0023;
				
				floaters_markers.features[i].geometry.coordinates = [
	                all_data[data_index].address.longitude + (floaters_rad + floaters_rad *  Math.sin((360 / floaters_markers.features.length / 180) * (i + 0) * Math.PI)) - floaters_rad,
	                all_data[data_index].address.latitude + (floaters_rad + -floaters_rad * Math.cos((360 / floaters_markers.features.length / 180) * (i + 0) * Math.PI)) - floaters_rad
				]

			    // create marker and add to map
		    	// random number for random floating anim
		    	var rand_num = Math.floor(Math.random()*4+1);

			    var el = document.createElement("div");  
			    el.className = "marker_floaters floater_"+floaters_markers.features[i].properties.markertype+" anim_"+rand_num;
			    el.dataset.index = i;
			    el.dataset.name = floaters_markers.features[i].properties.name;
			    el.dataset.code = floaters_markers.features[i].properties.code;
			    el.dataset.type = floaters_markers.features[i].properties.markertype;
			    el.dataset.lon = floaters_markers.features[i].geometry.coordinates[1];
			    el.dataset.lat = floaters_markers.features[i].geometry.coordinates[0];

			    // append writer name to writer floater
			    var name_span = document.createElement('span')
			    name_span.innerHTML = floaters_markers.features[i].properties.name;
			    el.appendChild(name_span);

			    // add marker to map
			    new mapboxgl.Marker(el)
			        .setLngLat(floaters_markers.features[i].geometry.coordinates)
			        .addTo(map);

			   //console.log("R2 HERE", floaters_markers.features[i].geometry.coordinates)    

			}
		};

		//draw relation lines between markers
		draw_lines(data_index)
		
	};  
	// END check_relation()


	// FN draw relation lines between markers
	function draw_lines(data_index) {
	 
		link_lines_features_work = [];

	    for (var i = 0; i < floaters_markers.features.length; i++) {

            // LINK LINES : work marker to place marker
    	    if (floaters_markers.features[i].properties.markertype == "work") {

		    	// set up empty features for single line
		    	// from coordinates of clicked place marker -> coordinates of related marker
		    	link_lines_features_work_to_add = {
											    "type": "Feature",
							                    "properties": {
							                        // "dasharray": [3,3],
							                        "width": 1,
							                    },
											    "geometry": {
											        "type": "LineString",
											        "coordinates": [
											            [ all_data[data_index].address.longitude , all_data[data_index].address.latitude ],
											            floaters_markers.features[i].geometry.coordinates
											        ]
											    }
											 };


	    		link_lines_features_work.push(link_lines_features_work_to_add)
	    	};

	    };



	    map.addSource("link-lines-source_work", {
	        "type": "geojson",
	        "data": {
	            "type": "FeatureCollection",
	            "features": link_lines_features_work
	        }
	    });
	    // add lines to map
		map.addLayer({
		    "id": "link-lines-id_work",
		    "type": "line",
		    "source": "link-lines-source_work",
		    "paint": {
		        "line-color": "#000",
		        "line-width": ['get', 'width'],
		        // "line-dasharray": [3,3]
		    }
		});	  




	};
	// END draw_lines()


	// FN clear floater markers on map
	function clear_map() {
		$(".marker_people").remove();
		$(".marker_floaters").remove();
		$(".marker_places").find('img').attr('src',"img/icn/marker_place.svg");
		$(".marker_places").removeClass('is_related_place');

		$(".mapboxgl-canvas-container").removeClass("showing_relations");
		$(".marker_places").removeClass("show_relations");	

		// remove and reset layers and source on each click
		if (map.getLayer("link-lines-id_work") != undefined) {
			map.removeLayer("link-lines-id_work");
		}
		if (map.getSource("link-lines-source_work") != undefined) {
			map.removeSource("link-lines-source_work");
		}


			

	};
	// END clear_map()



	/*** CAMERA AND SHARE FUNCTIONS ***/

	var supports_cam = false;

    var canvas_width;
    var canvas_height;
    var captured_img;

    var filter_effect = "grayscale"

	// START WEBCAM / PHONE CAMERA
	var cam_feed = document.getElementById("cam_feed");
	var snapshot_canvas = document.getElementById("snapshot_canvas");
	var constraints = {
		video: { 
			facingMode: "environment",
			aspectRatio : 1,
    	} 
	};

	var cam_denied = false;

	var closest_location_arr = [];
	var lowest_index;
	var lowest_value;
	var closest_place_text;
	var closest_place_name;
	var closest_place_code;
	var closest_place_work_writer;

	var url_to_share;

    // start camera feed
    function start_camera() {

    	$('#cam_capture').addClass('temp_disabled');

		// For todays date;
		Date.prototype.today = function () { 
		    return this.getFullYear()+'.'+(((this.getMonth()+1) < 10)?"0":"") + (this.getMonth()+1)+'.'+((this.getDate() < 10)?"0":"")+this.getDate();
		}
		// For the time now
		Date.prototype.timeNow = function () {
		     return ((this.getHours() < 10)?"0":"") + this.getHours() +":"+ ((this.getMinutes() < 10)?"0":"") + this.getMinutes() +":"+ ((this.getSeconds() < 10)?"0":"") + this.getSeconds();
		}
		var datetime = new Date().today() + " " + new Date().timeNow();

    	$('.location_text').empty();
    	$('.location_name').empty();
    	$('.location_date').html(datetime);

        setTimeout(function(){ 
	    	// closest_place_text = json.Result;
	    	var random_quote_index = Math.floor(Math.random() * (quotes_array.length-1) );    
	    	closest_place_text = quotes_array[random_quote_index].quote;
	    	closest_place_name = quotes_array[random_quote_index].name.korean;
	    	closest_place_code = quotes_array[random_quote_index].sn;

	    	get_single_data('work', closest_place_code, 'getquotes');
	    	// var closest_place_work_index = list_data.list_work.map(function (work) { return work.sn; }).indexOf(closest_place_code);
	    	// closest_place_work_writer = list_data.list_work[closest_place_work_index].writer;
        }, 600);

		
		navigator.mediaDevices.getUserMedia(constraints).then(function (stream) {
		  $(".cam_component").show();
		  resize_event();
		  setTimeout(function () {
		    snapshot_canvas.width = $("#cam_feed").width() * 2;
		    snapshot_canvas.height = $("#cam_feed").height() * 2;
		    $('#cam_capture').removeClass('temp_disabled');
		  }, 1000); // Attach the video stream to the video element and autoplay.

		  cam_feed.srcObject = stream;
		  $(".cam_component").removeClass('cam_ended');
		  $(".cam_component").addClass('cam_live');
		  $('.cam_share').css('display', 'none');
		  $('.cam_download').css('display', 'none');
		  $(".cam_filter").show();
		  $('.share_image').removeClass('show loaded');
		}).catch(function (err) {
		  show_camera_error(err);
		});
    };

    // FN no camera supported
	function show_camera_error(error) {
		console.log(error);
		cam_denied = true;

		$(".btn_opencam").hide();
		$(".ui_map_bottom").addClass("no_cam");

		$(".no_camera").fadeIn(function() {
            setTimeout(function(){ 
                $(".no_camera").fadeOut()
            }, 4000);

		})
	};

    // FN stop camera feed
	function stop_camera() {
	  cam_feed.srcObject.getVideoTracks().forEach(function (track) {
	    return track.stop();
	  });
	  $('.cam_share').css('display', 'flex');
	  $('.cam_download').css('display', 'flex');
	  $(".cam_filter").hide();
	}

    // END fn stop_camera();



// set of sepia colors
	var r = [0, 0, 0, 1, 1, 2, 3, 3, 3, 4, 4, 4, 5, 5, 5, 6, 6, 7, 7, 7, 7, 8, 8, 8, 9, 9, 9, 9, 10, 10, 10, 10, 11, 11, 12, 12, 12, 12, 13, 13, 13, 14, 14, 15, 15, 16, 16, 17, 17, 17, 18, 19, 19, 20, 21, 22, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 39, 40, 41, 42, 44, 45, 47, 48, 49, 52, 54, 55, 57, 59, 60, 62, 65, 67, 69, 70, 72, 74, 77, 79, 81, 83, 86, 88, 90, 92, 94, 97, 99, 101, 103, 107, 109, 111, 112, 116, 118, 120, 124, 126, 127, 129, 133, 135, 136, 140, 142, 143, 145, 149, 150, 152, 155, 157, 159, 162, 163, 165, 167, 170, 171, 173, 176, 177, 178, 180, 183, 184, 185, 188, 189, 190, 192, 194, 195, 196, 198, 200, 201, 202, 203, 204, 206, 207, 208, 209, 211, 212, 213, 214, 215, 216, 218, 219, 219, 220, 221, 222, 223, 224, 225, 226, 227, 227, 228, 229, 229, 230, 231, 232, 232, 233, 234, 234, 235, 236, 236, 237, 238, 238, 239, 239, 240, 241, 241, 242, 242, 243, 244, 244, 245, 245, 245, 246, 247, 247, 248, 248, 249, 249, 249, 250, 251, 251, 252, 252, 252, 253, 254, 254, 254, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255, 255],
    g = [0, 0, 1, 2, 2, 3, 5, 5, 6, 7, 8, 8, 10, 11, 11, 12, 13, 15, 15, 16, 17, 18, 18, 19, 21, 22, 22, 23, 24, 26, 26, 27, 28, 29, 31, 31, 32, 33, 34, 35, 35, 37, 38, 39, 40, 41, 43, 44, 44, 45, 46, 47, 48, 50, 51, 52, 53, 54, 56, 57, 58, 59, 60, 61, 63, 64, 65, 66, 67, 68, 69, 71, 72, 73, 74, 75, 76, 77, 79, 80, 81, 83, 84, 85, 86, 88, 89, 90, 92, 93, 94, 95, 96, 97, 100, 101, 102, 103, 105, 106, 107, 108, 109, 111, 113, 114, 115, 117, 118, 119, 120, 122, 123, 124, 126, 127, 128, 129, 131, 132, 133, 135, 136, 137, 138, 140, 141, 142, 144, 145, 146, 148, 149, 150, 151, 153, 154, 155, 157, 158, 159, 160, 162, 163, 164, 166, 167, 168, 169, 171, 172, 173, 174, 175, 176, 177, 178, 179, 181, 182, 183, 184, 186, 186, 187, 188, 189, 190, 192, 193, 194, 195, 195, 196, 197, 199, 200, 201, 202, 202, 203, 204, 205, 206, 207, 208, 208, 209, 210, 211, 212, 213, 214, 214, 215, 216, 217, 218, 219, 219, 220, 221, 222, 223, 223, 224, 225, 226, 226, 227, 228, 228, 229, 230, 231, 232, 232, 232, 233, 234, 235, 235, 236, 236, 237, 238, 238, 239, 239, 240, 240, 241, 242, 242, 242, 243, 244, 245, 245, 246, 246, 247, 247, 248, 249, 249, 249, 250, 251, 251, 252, 252, 252, 253, 254, 255],
    b = [53, 53, 53, 54, 54, 54, 55, 55, 55, 56, 57, 57, 57, 58, 58, 58, 59, 59, 59, 60, 61, 61, 61, 62, 62, 63, 63, 63, 64, 65, 65, 65, 66, 66, 67, 67, 67, 68, 69, 69, 69, 70, 70, 71, 71, 72, 73, 73, 73, 74, 74, 75, 75, 76, 77, 77, 78, 78, 79, 79, 80, 81, 81, 82, 82, 83, 83, 84, 85, 85, 86, 86, 87, 87, 88, 89, 89, 90, 90, 91, 91, 93, 93, 94, 94, 95, 95, 96, 97, 98, 98, 99, 99, 100, 101, 102, 102, 103, 104, 105, 105, 106, 106, 107, 108, 109, 109, 110, 111, 111, 112, 113, 114, 114, 115, 116, 117, 117, 118, 119, 119, 121, 121, 122, 122, 123, 124, 125, 126, 126, 127, 128, 129, 129, 130, 131, 132, 132, 133, 134, 134, 135, 136, 137, 137, 138, 139, 140, 140, 141, 142, 142, 143, 144, 145, 145, 146, 146, 148, 148, 149, 149, 150, 151, 152, 152, 153, 153, 154, 155, 156, 156, 157, 157, 158, 159, 160, 160, 161, 161, 162, 162, 163, 164, 164, 165, 165, 166, 166, 167, 168, 168, 169, 169, 170, 170, 171, 172, 172, 173, 173, 174, 174, 175, 176, 176, 177, 177, 177, 178, 178, 179, 180, 180, 181, 181, 181, 182, 182, 183, 184, 184, 184, 185, 185, 186, 186, 186, 187, 188, 188, 188, 189, 189, 189, 190, 190, 191, 191, 192, 192, 193, 193, 193, 194, 194, 194, 195, 196, 196, 196, 197, 197, 197, 198, 199];

    var noise = 20;


	var canvas_effect = document.getElementById('snapshot_canvas'); //the canvas object

	

    // take a photo
    $("#cam_capture").click(function() {

        if ($('.cam_component').hasClass('cam_live')) {
            // flip context first
            //snapshot_canvas.getContext("2d").setTransform(-1, 0, 0, 1, snapshot_canvas.width, 0);
            snapshot_canvas_ctx = snapshot_canvas.getContext("2d");
            snapshot_canvas_ctx.imageSmoothingQuality = "high"

            snapshot_canvas_ctx.drawImage(cam_feed, 0, 0, $('.ui_cam #cam_feed').width()*2 , $('.ui_cam #cam_feed').height()*2);

            // grayscale. set grayscale as base, as sepia uses grayscale base too
	        var imageData = snapshot_canvas_ctx.getImageData(0, 0, $('.ui_cam #cam_feed').width()*2 , $('.ui_cam #cam_feed').height()*2);
	        // var datax = imageData.data;


	        if (filter_effect == 'grayscale') {

		        for(var i = 0; i < imageData.data.length; i += 4) {
		          var brightness = 0.34 * imageData.data[i] + 0.5 * imageData.data[i + 1] + 0.16 * imageData.data[i + 2];
		          // red
		          imageData.data[i] = brightness;
		          // green
		          imageData.data[i + 1] = brightness;
		          // blue
		          imageData.data[i + 2] = brightness;
		        }

		        // overwrite original image
		        snapshot_canvas_ctx.putImageData(imageData, 0, 0);
	    	}

	        if (filter_effect == 'sepia') {

				var opts = {
					useWorker:true, //Whether to use Web Worker to do the processing or not
					workerPath:'js/CanvasEffects.worker.min.js', //The path to the worker
					width: 700, //Override the width of the original canvas
					height: 700 //Override the height of the original canvas
				}
				var fx = new CanvasEffects(canvas_effect,opts);

				fx.sepia().gamma(0.7);
	        };
            
            // stop camera when photo is snapped
            stop_camera();

            $(".cam_component").removeClass('cam_live');
            $(".cam_component").addClass('cam_ended');

            // delay base64 export incase of rendering delays
            setTimeout(function(){ 
            	export_base64()
            }, 300);
            
        } else {
            start_camera();
        }
    });

    // download captured image
	$('.cam_download').click(function() {
		$(this).addClass('disabled');
		export_img('seongbukgu_img');

	})

	// html2canvas functions
	var opt = {backgroundColor:'black', logging: false }
	function export_img(filename) {
	    html2canvas(document.querySelector('.ratio_guide .inner'), opt).then(function(canvas) {
	        console.log(filename);
	        saveAs(canvas.toDataURL(), String(filename)+'.png');
	    });
	};

	// html2canvas functions
	function saveAs(uri, filename) {

	    var link = document.createElement('a');

	    if (typeof link.download === 'string') {

	        link.href = uri;
	        link.download = filename;

	        //Firefox requires the link to be in the body
	        document.body.appendChild(link);

	        //simulate click
	        link.click();

	        //remove the link when done
	        document.body.removeChild(link);
	        $('.cam_download').removeClass('disabled');
	    } else {
	    	console.log('case window open');
	    	$('.enable_popup').fadeIn('fast', function() {
	    		setTimeout(function(){ 
					$('.enable_popup').fadeOut('fast');
					$('.cam_download').removeClass('disabled');
				}, 3000);
	    	});

	    	

	        window.open(uri);
	    }
	};


	// get base64 and pass to variable
	function export_base64() {
	    html2canvas(document.querySelector('.ratio_guide .inner'), opt).then(function(canvas) {
	    	base64_export = canvas.toDataURL().replace("data:image/png;base64,","");
	    	// console.log(base64_export)
	    });
	};
	

	// share captured image
    $('.cam_share').click(function() {
		send_image();
    });


    // resize canvas on resize
    window.addEventListener("resize", resize_event, false);

    // resize canvas
    function resize_event() {

		snapshot_canvas.width = canvas_width;
		snapshot_canvas.height = canvas_height;
    };
    //FN resize_event


    // FN send base64
    function send_image() {


    	$('.share_image').addClass('show');
		// var base64_export = {)};
		//console.log(base64_export);

		$.ajax({
			method: "POST",
			url: domain+'/mobile/api/v1/upload/camera.do',
           	contentType:"application/json; charset=utf-8",
            dataType:"json",
            data: "\"" + base64_export + "\""
		})
		.always(function(data) {
			console.log('made post base64 request')
		})
		.done(function( json, textStatus, jqXHR ) {
			console.log('base64 post success',json);

			if (json.meta.status == 200) {
				url_to_share = "https://archive.sb.go.kr/isbcc"+json.shareUrl;
				$('.share_image').addClass('loaded');				
			}


		})
		.fail(function(jqXHR, textStatus, errorThrown) {
		  	console.log("HTTP Request Failed",jqXHR);
		});
    };



    // FN populate list
    function populate_list(data_type, is_now_on_list) {
		
		var datatouse = list_data['list_'+data_type];

		console.log(data_type,'aaa');

		$('.btn_map').addClass('show');
		$('.menu_wave').addClass('straight');
		
		function get_list_data(data_type) {

			$(".ui_list .list_content").empty();


	    	for (var i = 0; i < datatouse.length; i++) {
	    		$(".ui_list .list_content").append("\
	    			<li data-type="+data_type+" data-code="+datatouse[i].sn+" data-index='"+i+"'>\
	    			<span class='list_thumb'>\
	    			<img src='\
	    			"+( datatouse[i].thumbnailPath != null ? domain+datatouse[i].thumbnailPath +' ' : 'img/icn/marker_'+data_type+'_active_default.png')+"\
	    			'>\
	    			</span>\
	    			<div class='list_right'>\
	    				<span class='list_title'>"+datatouse[i].name.korean+"</span>\
	    				<span class='list_subtitle'>"
	    				+( data_type == "place" ? ( datatouse[i].address.area != null ? datatouse[i].address.area+' ' : '') + ( datatouse[i].address.si != null ? datatouse[i].address.si+' ' : '') + ( datatouse[i].address.lotNo != null ? datatouse[i].address.lotNo : '') : '')
	    				+( data_type == "work" ? ( datatouse[i].writer != null ? datatouse[i].writer : '') : '')+"</span>\
	    			</div>\
	    			</li>"
	    		);
	    	}

	    	if (data_type == 'place' || data_type == 'work') {
	    		$('.list_subtitle').show();
	    	} else {
	    		$('.list_subtitle').hide();
	    	}

	    	// $(".ui_list .list_content_wrap").fadeIn();
	    	// timeout needed because scrolltop wont reset when its hidden

			setTimeout(function(){ 
				$('.ui_list .list_content_wrap .inner').fadeIn('fast');
			}, 100);

		};     	

		if (data_type == 'place' ) {
			$('.list_head_title').html(list_data.list_text[2].title);
			$('.list_desc').html(list_data.list_text[2].description);
		} 
		else if (data_type == 'writer') {
			$('.list_head_title').html(list_data.list_text[1].title);
			$('.list_desc').html(list_data.list_text[1].description);
		}
		else if (data_type == 'work') {
			$('.list_head_title').html(list_data.list_text[0].title);
			$('.list_desc').html(list_data.list_text[0].description);
		}
 

    	$(".ui_list .list_buttons li").removeClass("active");


    	if (is_now_on_list) {
    		$(".ui_list .list_first_view").fadeOut("fast", function() {
    			get_list_data(data_type);
    			setTimeout(function(){ 
					$('.menu_btn').fadeIn();
					$('.menu_top').removeClass('list_menu')
				}, 100);
    		});
    	} else {
    		$(".ui_list").fadeIn();
    		get_list_data(data_type);
    	}
	    
	    $(".ui_list .list_content_wrap").animate({ scrollTop: "0" }, 200);

    };
    // END FN populate_list()


    //FN populate detail panel
    function populate_details(data_type, data_id, data_code, via_history, via_map) {

    	$('#meta_wrap').attr('class', 'type_'+data_type);
    	// prevent double click on markers
    	$('#map').addClass('disabled');

    	$('.menu_wave').addClass('straight');
    	$('.btn_map').addClass('show');
    	$('.toggle_list').removeClass('active');

		$('.menu_btn').fadeIn();	
		$('.menu_top').removeClass('list_menu')

		//update url of detail page with data_type + data_id
		// only update url if not populating via history api call
		if (!via_history){
			updateURL("?"+data_type+"="+data_code);		
		}
		

		get_single_data(data_type, data_code, null, via_map);

		current_view = "details";
		current_code = data_code;


    };
    // END populate_details() 


    // FN request single data. use params eg ('place', 'P00004')
	function get_single_data(data_type, data_code, method, via_map) {

		// use to show correct data on list when closing detail panel
		current_type = data_type;

	    $.ajax({
	      method: "POST",
	      url: domain+"/mobile/api/v1/theme/1/story/"+data_code+".do",
	      contentType: "application/json",
	      crossDomain: true,
	    })
	    .done(function( json, textStatus, jqXHR ) {
			// detail_data = json.response.data;8
			console.log("data_detail received", json.data)
			data_detail = json.data;


			if (method != 'getquotes') {
			
				$(".ui_detail").fadeIn();
				$(".ui_detail").scrollTop(0);
				$('#meta_wrap').fadeIn();
				off_tts();
				show_sticky_title();
				$('.share_detail_after').removeClass('show');

				//////// clear all fields
				$('.ui_detail .meta_single').empty();
				$('.content_hooks').empty();

				//////// title
				if (data_type == 'work') {
					$('.ui_detail .meta_title').html('«'+data_detail.name.korean+'»');
				} else {
					$('.ui_detail .meta_title').html(data_detail.name.korean);
				}
				


				//////// subtitle
				if (data_type == 'place') {
					$('.meta_subtitle').append(
						( data_detail.name.chinese != null ? data_detail.name.chinese+' <br>' : '')+
						( data_detail.name.similar != null ? data_detail.name.similar : '')
					);
				} else if ( data_type == 'writer') {

					var _start = data_detail.era.date.start;
					if(_start == null || _start.length == 0){
						_start = '';
					}
					var _end = data_detail.era.date.end;
					if(_end == null || _end.length == 0){
						_end = '';
					}

					var _era = null;
					if(_start != '' || _end != ''){
						if(_start.length > 4){
							_start = _start.substring(0,4);
						}
						if(_end.length > 4){
							_end = _end.substring(0,4);
						}

						_era = _start + '~' + _end;
					}

					$('.meta_subtitle').append(
						( _era != null ? _era+' ' : '')+
						( data_detail.name.similar != null ? data_detail.name.similar+' ' : '')+
						( data_detail.name.chinese != null ? data_detail.name.chinese : '')
					);
				} else if ( data_type == 'work') {

					var writers_name;
					if (data_detail.writer != null) {
						for (var ii = 0; ii < data_detail.writer.length; ii++) {
							writers_name = '<span class="writers_name" data-type="writer" data-code="'+data_detail.writer[ii].sn+'">'+data_detail.writer[ii].name+',</span>'
						}	
					}
					

					if (data_detail.era != null) {		
						$('.meta_subtitle').append(
							( writers_name != null ? writers_name : '')+
							( data_detail.era.date.start != null ? data_detail.era.date.start : '')+
							( data_detail.era.date.end != null ? '~'+data_detail.era.date.end : '')
						);
					};


				};

				//////// address or residential address
				if (data_type == 'place' || data_type == 'writer') {
					

					if (data_type == 'place') {
						$('.meta_address_bar').append(
							( data_detail.address.area != null ? data_detail.address.area+' ' : '') +
							( data_detail.address.si != null ? data_detail.address.si+' ' : '') +
							( data_detail.address.lotNo != null ? data_detail.address.lotNo+' ' : '')
						);
					} else if ( data_type == 'writer') {

						if (data_detail.description.residence != null) {
							$('.meta_address_bar').show();	
							$('.meta_address_bar').append(data_detail.description.residence);							
						} else {
							$('.meta_address_bar').hide();
						}

					}
				} else {
					$('.meta_address_bar').hide();
				};


				//////// description summary
				$('.ui_detail .meta_desc').html(data_detail.description.summary);

				//////// description desc resource
				if (data_detail.description.basis != null) {
					$('.meta_resource').show();
					$('.meta_resource').html(data_detail.description.basis);			
				} else {
					$('.meta_resource').hide();
				}
				


				//////// works content loop
				if (data_type == 'work') {


					for (var i = 0; i < data_detail.contents.length; i++) {
						$('.meta_works_wrap').append('<ul data-index="'+i+'" class="works_content works_content'+i+'"></ul>');
						$('.meta_works_wrap .works_content'+i).append('\
							<li id="section'+(i+1)+'">\
								<span class="work_detail_title">«'+data_detail.name.korean+'»<br>작품 속 성북 이야기</span>\
								<span class="work_detail_index">'+(i+1)+'</span>\
								<span class="work_detail_text" data-index="'+i+'">'+data_detail.contents[i].original.replace(/(?:\r\n|\r|\n)/g, '<br>')+'</span>\
								<span class="work_detail_resource">'+data_detail.contents[i].resource+'. '+data_detail.contents[i].pages+'.</span>'
								// if description snippet exists, show
								+( data_detail.contents[i].description != null ? '<div class="work_detail_snippet"><span class="snippet_text">'+data_detail.contents[i].description+'</span><span class="toggle_snippet close_snippet"><img src="img/icn/icn_plus.svg">설명보기</span></div>' : '')+
							'</li>\
						');

						$('.meta_title_sticky .content_hooks').append('\
							<div class="sticky_btn sticky_btn_'+i+'"><a class="scrollhash" href="#section'+(i+1)+'">'+(i+1)+'</a></div>\
						')

						if (data_detail.contents[i].places.length > 0  ) {

							$('.meta_works_wrap').append('<ul class="related_places related_places'+i+' related_list"><li class="related_first"><span>관련<br>장소</span></li></ul>')

							for (var y = 0; y < data_detail.contents[i].places.length; y++) {
								$('.meta_works_wrap .related_places'+i).append('\
								<li class="related_thumb" data-type="place" data-code="'+data_detail.contents[i].places[y].sn+'">\
									<div>\
										<img src="'+( data_detail.contents[i].places[y].thumbnailPath != null ? domain+data_detail.contents[i].places[y].thumbnailPath : 'img/icn/marker_place_active_default.png')+'">\
									</div>\
									<span>'+data_detail.contents[i].places[y].name.korean+'</span>\
								</li>\
								')

								$('.related_places'+i).prev().addClass('anchor_'+data_detail.contents[i].places[y].sn)
							}


						}
					};


					//////// content snippet
					$('.snippet_text').each(function() {
						$(this).attr('data-height', $(this).height()+20 )
						$(this).height(0)
					})

					// update waypoints for contents in

					$('.works_content').waypoint(function(direction) {
						if ( $('#meta_wrap').hasClass('type_work') ) {
							var wp_id = $(this.element).attr('data-index');
						    if (direction == 'down') {
						        console.log('down', wp_id)
						        $('.sticky_btn').removeClass('active');
						        $('.sticky_btn_'+wp_id).addClass('active');

						        if (window.innerWidth < 768) {
									$('.content_hooks').animate({
								        scrollLeft: (wp_id*44) + 10
								    }, 200);	
						        }

						        tts_text_all = $('.works_content'+wp_id+' .work_detail_title').text()+'.'+ $('.works_content'+wp_id+' .work_detail_text').text();
						    }

						}
					},{
					    offset: '170px',
					    context: '.ui_detail'
					});
					$('.work_detail_text').waypoint(function(direction) {
						if ( $('#meta_wrap').hasClass('type_work') ) {
							var wp_id = $(this.element).attr('data-index');
						    if (direction == 'up') {
						        console.log('up text', wp_id)
						        $('.sticky_btn').removeClass('active');
						        $('.sticky_btn_'+wp_id).addClass('active');

						        if (window.innerWidth < 768) {
									$('.content_hooks').animate({
								        scrollLeft: wp_id*44 + (wp_id*10)
								    }, 200);
								}

						        tts_text_all = $('.works_content'+wp_id+' .work_detail_title').text()+'.'+ $('.works_content'+wp_id+' .work_detail_text').text();
						    }

						}
					},{
					    offset: '-50%',
					    context: '.ui_detail'
					});

					$('.meta_images').waypoint(function(direction) {
						if ( $('#meta_wrap').hasClass('type_work') ) {
						    if (direction == 'down') {
						        $('.sticky_btn').removeClass('active');
						        $('.sticky_btn_img').addClass('active');
						    } else {
						        console.log('up')
						    }
						}
					},{
					    offset: '170px',
					    context: '.ui_detail'
					});
				};

				//////// related works for places and writers
				if (data_type == 'place' || data_type == 'writer' ) {

					$('.meta_works_wrap').append('<ul class="related_works related_list"><li class="related_first"><span>관련<br>작품</span></li></ul>')

					if (data_detail.works.length > 0  ) {
						for (var z = 0; z < data_detail.works.length; z++) {
							$('.meta_works_wrap .related_works').append('\
							<li class="related_thumb" data-type="work" data-code="'+data_detail.works[z].sn+'">\
								<div>\
									<img src="'+( data_detail.works[z].thumbnailPath != null ? domain+data_detail.works[z].thumbnailPath : 'img/icn/marker_work_active_default.png')+'">\
								</div>\
								<span>'+data_detail.works[z].name.korean+'</span>\
							</li>\
							')
						}
					}
				}


				//////// images
				if (data_detail.images != null) {

					$('.meta_images').append('<div class="contents_divider"></div><ul></ul>');

					// append images. add caption only if available
					for (var i = 0; i < data_detail.images.length; i++) {


						$('.meta_images ul').append('\
							<li>\
								<a class="fancybox_gal" data-fancybox="gallery" href="'+domain+data_detail.images[i].servicePath+'" data-caption="'+( data_detail.images[i].caption != null ? data_detail.images[i].caption : '')+'">\
									<img src="'+domain+data_detail.images[i].servicePath+'">\
									'+( data_detail.images[i].caption != null ? '<span class="img_caption">'+data_detail.images[i].caption.replace(/(?:\r\n|\r|\n)/g, '<br>')+'</span>'+' ' : '')+'\
									<span class="img_copyright">해당 이미지에 대한 권리는 이미지 소장‧제공기관에 있으며, 이를 무단 사용할 경우 법적 책임을 질 수 있습니다.</span>\
								</a>\
							</li>\
						');
					}

					$('.meta_title_sticky .content_hooks').append('\
						<div class="sticky_btn sticky_btn_img"><a class="scrollhash" href="#section-image">이미지</a></div>\
					');

					$('.meta_images').show();
				} else {
					$('.meta_images').hide();
				};

				//////// youtube
				if (data_detail.youtube != null) {

					$('.meta_video').append('<div class="contents_divider"></div><ul></ul>');

					// standardise youtube url format for embedding
					var parsed_youtube_url = data_detail.youtube;
					parsed_youtube_url = parsed_youtube_url.replace("https://www.youtube.com","").replace("https://youtu.be/","").replace("watch?v=","").replace("/","");
					parsed_youtube_url = "https://www.youtube.com/embed/"+parsed_youtube_url;

					// add youtube
					$('.meta_video').append("\
					<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='"+parsed_youtube_url+"' frameborder='0' allowfullscreen></iframe></div>\
					");


					$('.meta_title_sticky .content_hooks').append('\
						<div class="sticky_btn sticky_btn_vid"><a class="scrollhash" href="#section-video">영상</a></div>\
					');

					$('.meta_video').show();
				} else {
					$('.meta_video').hide();
				};			

				// add transparent button as spacer as final button
				$('.meta_title_sticky .content_hooks').append('\
					<div class="sticky_btn sticky_btn_last"></div>\
				');

				// define what to read for tts_text_all
				if (data_type == 'place' || data_type == 'writer') {
					tts_text_all = $('.ui_detail .meta_title').text() +'.'+ $('.meta_address_bar').text()+'.'+ $('.ui_detail .meta_desc').text() ;	
				} 
				else if (data_type == 'work') {
					tts_text_all = $('.ui_detail .meta_title').text() +'.'+ $('.meta_address_bar').text()+'.'+ $('.ui_detail .meta_desc').text();

					$('.works_content').each(function(index) {
						tts_text_all = tts_text_all + $('.works_content'+index+ ' .work_detail_title').text() +'.'+ $('.works_content'+index+' .work_detail_text').text();
						if ( $('.works_content'+index+' .snippet_text').length > 0 ) {
							tts_text_all = tts_text_all + $('.works_content'+index+' .snippet_text').text();
						}			
					})
				}
				
				// update waypoints
				Waypoint.refreshAll();

			}//getquotes
			else {
				console.log('get quotes');
				closest_place_work_writer = json.data.writer[0].name;
				closest_place_work_year = ( json.data.era != null ? json.data.era.date.start +', ' : '');

		    	$('.location_text').html(closest_place_text);
		    	$('.location_name').html('— '+closest_place_work_writer+', '+closest_place_work_year+'«'+closest_place_name+'»');
			};


			//if open works from map, scroll to related work
			if (data_type == 'work' && via_map) {
				console.log('hey',via_map, current_open_place)
				var target_id = $('.anchor_'+current_open_place+' > li').attr('id')

			    $('.ui_detail').animate({
			        scrollTop: $("#"+target_id).offset().top - 100
			    }, 2000);


			}

	    })
	    .fail(function(jqXHR, textStatus, errorThrown) {
	        console.log("HTTP Request Failed",jqXHR);
	    })
	    .always(function() {
	    	// console.log("detail data request made")
	    });
	};
	// END


	// check location in intro
	$(".location_check").click(function() {
		getUserLocation();

	});

	// go to map from intro
	$(".btn_start").click(function() {
		$(".ui_intro").fadeOut();
		setTimeout(function(){ 
			$('.intro_anim').removeClass('anim-on');
			$('.ui_intro').removeClass('intro_show');
		}, 600);

	});
	
	// refresh location while viewing map
	$(".btn_update_loc").click( function() {
		getUserLocation();
		$('.btn_update_loc img').attr('src', 'img/icn/icn_loading.svg');
		$('.btn_update_loc').addClass('checking')
		clear_map();
	})

	// click on PLACE markers
	$(document).on("click",".marker_places",function(){

		if ( !$(this).hasClass("show_relations")  ) {
			$(this).find('img').attr('src', null);
		}
		click_place_marker(this);
	});





	//FN click place marker event 
	function click_place_marker(place_togo, from_chapter) {
		console.log('clicked marker_places')

		current_place_index = $(place_togo).attr("data-index");
		var data_code = $(place_togo).attr("data-code");
		current_open_place = $(place_togo).attr("data-code");

		// check if this place has related places
		// if no, directly open details panel instead of zooming in to place marker first
		// if 1st click, zoom to place marker
		// if 2nd click, open detail
		// console.log(all_data.places[current_place_index].work.length)
		if ( $(place_togo).hasClass("show_relations") && !from_chapter  ) {
			console.log('case A');
			populate_details("place", current_place_index, data_code);
		} else {


				console.log('case B');
				map.easeTo(
					{
						center 	: [map_markers.features[current_place_index].geometry.coordinates[0], map_markers.features[current_place_index].geometry.coordinates[1]],
						zoom 	: 15,
						duration: 600
					});	

				check_relation(current_place_index);	
				
				if ( all_data[current_place_index].thumbnailPath != null ) {
					//$(place_togo).css('background-image', 'url('+domain.substring(0, domain.length - 1)+all_data.places[1].images[0].image_thumb+')');	
					$(place_togo).find('img').attr('src',domain+all_data[current_place_index].thumbnailPath)
					console.log('case1')
				} else {
					console.log('case2')
					//$(place_togo).css('background-image', 'url(img/icn/marker_places_active_default.png)');	
					$(place_togo).find('img').attr('src',"img/icn/marker_place_active_default.png");
				}

				// $(".ui_detail").fadeIn();
				$('.marker_places').removeClass("show_relations");	
				$(place_togo).addClass("show_relations");	
				$(".mapboxgl-canvas-container").addClass("showing_relations");



		}
	};

	// click on RELATED markers
	$(document).on("click",".marker_floaters",function(){

		current_work_index = $(this).attr("data-index");
		var related_type = $(this).attr("data-type");
		var related_code = $(this).attr("data-code");

		if (related_type == 'work') {
			populate_details(related_type, current_work_index, related_code, null, true);	
		} 
		

		// $(".ui_detail").fadeIn();
		// $(".ui_detail").scrollTop(0);
	});


    // change filter 
    $(".cam_filter_gray").click(function() {
        filter_effect = "grayscale";
        $(".cam_component").removeClass("filter_sepia");
        $(".cam_component").addClass("filter_grayscale");
    });
    $(".cam_filter_sepia").click(function() {
		filter_effect = "sepia"
		$(".cam_component").addClass("filter_sepia");
		$(".cam_component").removeClass("filter_grayscale");
    });



    // open camera
    $(".btn_opencam").click(function() {
    	updateURL("?camera");		
	    start_camera();
    });

    // close camera
    $(".cam_close").click(function(){
		stop_camera();
		$(".cam_component").hide();
    });

    // open list view
    $(".btn_menu").click(function() {
		$('.list_first_view').fadeIn();
    	// populate_list('place');
    	$('.ui_list').fadeIn();
    	$('.menu_btn').fadeOut();
    	$('.menu_top').addClass('list_menu')

    	$(".ui_detail, .ui_about").fadeOut();
    	$('.list_content_wrap').show();
    	$(".ui_list .list_content_wrap .inner").fadeOut(200);

    	updateURL("?menu");		

    });
    $('.dt_right').click(function() {
    	populate_list('work');
    	$('.list_first_view').hide();
    })

    // go to map
    $(".btn_map, .menu_top .theme_title").click(function() {
    	// populate_list('place');
    	$('.ui_list, .ui_detail').fadeOut();
    	// $('.menu_top').fadeIn();
    	$('.menu_btn').fadeIn();
		$('.menu_top').removeClass('list_menu')
		close_detail();
    });

    // 
    $(document).on("click",".toggle_snippet",function(){
    	var closest_snippet = $(this).prev( ".snippet_text" ); 

    	if ( $(this).hasClass('close_snippet') ){
    		$(this).removeClass('close_snippet');
			$(closest_snippet).height($(closest_snippet).attr('data-height'))	
			$(this).html('— 닫기');
    	} else {
    		$(this).addClass('close_snippet');
    		$(closest_snippet).height(0)	
    		$(this).html('<img src="img/icn/icn_plus.svg">설명보기');
    	}
    });

    // change list data
    $(".ui_list .list_buttons li").click(function() {
    	var data_type = $(this).attr("data-type")
    	populate_list(data_type, true);
    });
    
    // toggle menu categories
    $('.toggle_list').click( function() {
    	$('.toggle_list').removeClass('active');
    	$(this).addClass('active');
    	var data_type = $(this).attr('data-id')
		populate_list(data_type, true);    	
    })

    // click on single list item
    $(document).on("click",".ui_list .list_content li, .drawer_works li",function(){
    	var data_index = $(this).attr("data-index");
    	var data_type  = $(this).attr("data-type");
    	var data_code  = $(this).attr("data-code");
    	populate_details(data_type, data_index, data_code );

    	// temp add disabled
    	$('.ui_list .list_content_wrap').addClass('disabled');
		setTimeout(function(){ 
			$('.ui_list .list_content_wrap').removeClass('disabled');
		}, 1000);
    	
    });

	// close list panel
	$(".close_list").click(function() {
		$(".ui_list, .list_content_wrap").fadeOut();
		$('.menu_btn').fadeIn();
		$('.menu_top').removeClass('list_menu')
		$('.toggle_list').removeClass('active');

		if (current_view == 'details') {
			$(".ui_detail").fadeIn();
			updateURL("?"+current_type+"="+current_code);		
		}
	});

	// FN close detail panel 
	function close_detail() {
		$(".ui_detail, .ui_about").fadeOut();
		off_tts();
		wipeclean_url();

		$('.ui_detail .meta_desc span').height('auto');
		$('#map, .ui_list .list_content_wrap').removeClass('disabled');

		$('.btn_map').removeClass('show');
		$('.menu_wave').removeClass('straight');
		$('.toggle_list').removeClass('active');
		$('.meta_title_sticky, .back_to_top').removeClass('show');

		current_view = "map";
	};
	// END fn close_detail();


	$('.share_detail').click(function() {
		$('.share_detail_after').toggleClass('show');
	})

	$('.back_detail').click(function() {
		window.history.back()
	})

	$(document).on("click",".related_thumb, .writers_name",function(){
		var that = this
		change_detail_data(that);
	});

	// click on chapter's place and focus on map
	$(document).on("click",".chapter_place",function(){

		// case 1 - if user clicks on chapter's place while map didnt load,
		// change detail page instead
		if ($('.ui_intro').is(':visible')) {
			change_detail_data(this);
		}
		// case 2 -
		// if map is already showing, close detail page and focus on place marker
 		else {
			var data_code = $(this).attr('data-code');
			var data_type = $(this).attr('data-type');
			click_place_marker('.place_'+data_code, true);
			close_detail();
			$(".ui_list").fadeOut();
 		}
	});

	$('.drawer_open_btn').click(function() {
		$('.ui_map_bottom, #map').addClass('drawer_open');
	})
	$('.drawer_close_btn').click(function() {
		$('.ui_map_bottom, #map').removeClass('drawer_open');
	})
	
	// function to change detail page data when click on related items
	function change_detail_data(that) {
		var data_code = $(that).attr('data-code');
		var data_type = $(that).attr('data-type');
		$('#meta_wrap').fadeOut("fast", function() {
			populate_details(data_type, null, data_code);	
		})
	};
	
	/*** TEXT-TO-SPEECH data_detail.work ***/

	var tts_text;
	var tts_text_all;
	var tts_voice = "Korean Male";

	// FN show / hide share to fb kakao
	function toggle_tts(all) {
		// turn on tts
		if ( !$(".tts_switch").hasClass("tts_on") ) {
			$(".tts_switch").addClass("tts_on")
			if (all) {
				responsiveVoice.speak(tts_text_all, tts_voice, {pitch: 1.0, rate:0.9, onend: off_tts})	
			} else {
				responsiveVoice.speak(tts_text, tts_voice, {pitch: 1.0, rate:0.9, onend: off_tts})
			}
			
		} 
		// turn off tts
		else {
			off_tts()
		}
	};
	// END

	// CLICKING ON READ CHAPER
	function read_chapter(that, all) {
		$('.chapter_read').addClass('read_off');
		responsiveVoice.cancel();
		$(".detail_tts").removeClass("tts_nowoff");
		$(".tts_turnon").hide();
		$(".tts_turnoff").show();
		$('.detail_tts').css('display', 'flex');
		if (all) {
			responsiveVoice.speak(tts_text_all, tts_voice, {pitch: 1.0, rate:0.9, onend: off_tts})	
		} else {
			responsiveVoice.speak(tts_text, tts_voice, {pitch: 1.0, rate:0.9, onend: off_tts})
		}

		if (that != undefined) {
			// $('.chapter_read').addClass('read_off');
			$('.chapter_read').removeClass('read_off');
		}	
	}

	// FN turn off tts
	function off_tts() {
		console.log('off_tts called')
		$(".tts_switch").removeClass("tts_on")
		responsiveVoice.cancel();
	};
	// END


	$(".tts_switch").click(function() {
		toggle_tts(true);
	});

	$(document).on("click",".tts_read",function(){

		// different text for meta_desc and chapters
		if ( $(this).parent('.chapter_read').parent('.ui_detail .meta_desc').length > 0 ) {
			tts_text = $(this).closest('.meta_desc').find('span').html();	
			console.log('ttsxx', tts_text)
		} 
		else if ( $(this).parent('.chapter_read').parent('.chapter_header').parent('.single_chapter').length > 0 ) {
			tts_text = $(this).closest('.single_chapter').find('span').html();
		}
		
		//	console.log(tts_text)
		var that = $(this).parent('.chapter_read')
		if ( that.hasClass('read_off') ) {
			console.log('case1 x')
			read_chapter(that);	
		}
	});

	$(document).on("click",".tts_read_all",function(){

		//	console.log(tts_text)
		var that = $(this).parent('.chapter_read')
		if ( that.hasClass('read_off') ) {
			console.log('case1 x')
			read_chapter(that, true);	
		} 
	});

	$(document).on("click",".tts_stopread",function(){
		off_tts();
	});

	$( ".ui_detail" ).scroll(function() {
		show_sticky_title();
	});

	// show sticky detail title when scrolling
	function show_sticky_title() {
		if ($(".ui_detail").scrollTop() > 50) {
			$('.meta_title_sticky').addClass('show');
			$('.back_to_top').addClass('show');
		} else {
			$('.meta_title_sticky').removeClass('show');
			$('.back_to_top').removeClass('show');
		}
	};

	// detail page back to top
	$('.back_to_top').click(function() {
	    $('.ui_detail').animate({
	        scrollTop: 0
	    }, 400);

	})

	// toggle about
	$('.toggle_about').click(function() {
		$(".ui_list, .list_content_wrap").fadeOut();
		$('.menu_btn').fadeIn();
		$('.menu_top').removeClass('list_menu')
		$('.toggle_list').removeClass('active');

		$(".ui_about").fadeIn();
		$('.btn_map').addClass('show');
		$('.menu_wave').addClass('straight');

		updateURL("?about");		
	})


	/*** FB SHARE ***/
	function share_fb(url) {
		FB.ui({
		  method: 'share',
		  mobile_iframe: false,
		  href: url,
		}, function(response){});
	}


	$(".share_detail_after .share_fb").click(function() {
		var share_url = window.location.href;
		share_fb(share_url)
	});

	$(".share_image .share_fb").click(function() {
		share_fb(url_to_share);
	});


	/*** KAKAO SHARE ***/
	// FN share url on kakao
	Kakao.init("4a7e960f8fb31f91104d97f8e51dd852");
    function share_kakao(share_url) {
      Kakao.Link.sendDefault({
        objectType: "feed",
        content: {
          title: "성북마을발견×문학",
          description: "문학 작품 속 성북구 이야기",
          // 800x800
          imageUrl: "https://archive.sb.go.kr/litmap/img/ograph/ograph_square.jpg",
          link: {
            mobileWebUrl: "https://archive.sb.go.kr/litmap/",
            webUrl: "https://archive.sb.go.kr/litmap/"
          }
        },
        buttons: [
          {
            title: "웹으로 보기",
            link: {
              mobileWebUrl: share_url,
              webUrl: share_url
            }
          },
        ]
      });
    };

	$(".share_detail_after .share_kakao").click(function() {
		var share_url = window.location.href;
		share_kakao(share_url);
	});
	$(".share_image .share_kakao").click(function() {
		share_kakao(url_to_share);
	});

	/*** TWITTER SHARE ***/

	function share_twitter(url) {
		var page_description = "성북천을 따라 흘러가는 문학 이야기."
		window.open('https://twitter.com/intent/tweet?url=' + url,
		    'facebook-share-dialog',
		    'width=800,height=600'
		);
		return false;
	}

	$('.share_detail_after .share_tw').click(function() {
		var share_url = window.location.href;
		share_twitter(share_url)
	});
	$(".share_image .share_tw").click(function() {
		share_twitter(url_to_share);
	});

	/*** UPDATE URL ***/

	// FN UPDATE BROWSER URL
	function updateURL(params) {
		if (history.pushState) {
		    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + params;
		    window.history.pushState({path:newurl},"",newurl);
		}
	};
	// END


	// FN to delete params from browser url
	function wipeclean_url() {
		var current_url = window.location.href.split("?")[0]; 
		window.history.pushState({}, "", current_url );      
	};
  	// END


	// let state = { /* properties here */ };
	// (function initialize() {
	//   window.history.replaceState(state, null, "");
	//   render(state);
	// })();
	// function handleButtonClick() {
	//   /* mutate state */
	//   window.history.pushState(state, null, "");
	//   render(state);
	// }
	// button.addEventListener("click", handleButtonClick);
	window.onpopstate = function (event) {

		console.log('state popped')

		url_params = window.location.search;

		// if url has place / work / writer 
		if (url_params.indexOf("?place") >= 0 || url_params.indexOf("?work") >= 0 || url_params.indexOf("?writer") >= 0) {
		  
			var data_type = url_params.substring(0, url_params.indexOf("=")).replace("?","");
			var data_code = url_params.substring(url_params.indexOf("=") + 1);

			$('#meta_wrap').fadeOut("fast", function() {
				populate_details(data_type, null, data_code, true);	
			});

		} 
		else if ( url_params.indexOf("?menu") >= 0  && current_type != undefined) {
			$('.list_first_view').fadeIn();
	    	// populate_list('place');
	    	$('.ui_list').fadeIn();
	    	$('.menu_btn').fadeOut();
	    	$('.menu_top').addClass('list_menu')

	    	$(".ui_detail, .ui_about").fadeOut();
	    	$('.list_content_wrap').show();
	    	$(".ui_list .list_content_wrap .inner").fadeOut(200);
	    	$('.meta_title_sticky, .back_to_top').removeClass('show');

			populate_list(current_type, true);  

		}
		// if url doesnt match anything, wipe clean
		else {
			console.log("case3 popstate, url doesnt match anything, return to map")
			$('.ui_list, .ui_detail, .ui_about').fadeOut();
			$('.menu_top').fadeIn();
			$('.menu_wave').removeClass('straight');

	    	$('.btn_map').addClass('show');
	    	$('.toggle_list').removeClass('active');

			$('.menu_btn').fadeIn();	
			$('.menu_top').removeClass('list_menu');
			close_detail();

			if( $(".cam_component").is(":visible") ) {
				stop_camera();
				$(".cam_component").hide();	
			} 
			
		}	

	};




  	// INIT ALL AT START
	$( document ).ready(function() {
		init_mapbox();
	}); 




	// scroll to hash links
	// Select all links with hashes
	$(document).on("click",".scrollhash",function(event){	
		// On-page links
		if (
		  location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
		  && 
		  location.hostname == this.hostname
		) {
		  // Figure out element to scroll to
		  var target = $(this.hash);
		  var targetPos = target.offset();
		  var parentPos = $('#meta_wrap').offset();
		  target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
		  // Does a scroll target exist?
		  if (target.length) {
		    // Only prevent default if animation is actually gonna happen
		    event.preventDefault();
		    $('.ui_detail').animate({
		      scrollTop: targetPos.top - parentPos.top - 60
		    }, 400, function() {

		    });
		  }
		}
	});


	/*** fancybox for image gallery ***/
	$().fancybox({
  		selector : '.fancybox_gal',
		// toolbar  : false,
		idleTime: 30,
		smallBtn : false,
		buttons: [
		"close"
		],
	    btnTpl: {
	      close:
	          '<button data-fancybox-close class="fancybox-button fancybox-button--close">' +
	          '<img src="img/icn/icn_close.svg">' +
	          "</button>",
	    }
	})	    
	/***/


