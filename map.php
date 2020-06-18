<div id="map_wrap">
    <div id='map' style='width: 100%; height: 100%;'></div>
</div>



    <script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoic3VyaWNpdHkiLCJhIjoiY2tiZnpzaGtzMTB5NTJwcWVtOHF5anRmMCJ9.CI4QuMCsvVak3vrNtnJWcw';
    var map = new mapboxgl.Map({
    container: 'map',
    // style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
    // style: 'mapbox://styles/suricity/ckbg1kxyd3jjo1is4ro4nkpb5', // stylesheet location
    style: 'mapbox://styles/suricity/ckbhx3huo0xb11ip5hywb59rx', // stylesheet location
    // center: [192, 37], // starting position [lng, lat]
    center: [127.060444, 37.911627], // starting position [lng, lat]
    maxBounds: [
	    	// 	// strictly seongbukgu
	    	// 	// [126.972368, 37.572532], // Southwest coordinates
	    	// 	// [127.073682, 37.629226]  // Northeast coordinates
	    		
	    	// 	// limit hapjeong <-> nowon 
	    	// 	[126.907793, 37.547946], // Southwest limit coordinates 
	    	// 	[127.093138, 37.643414]  // Northeast limit coordinates

	    	// limit seoul city 
	    	[127.061343, 37.843099], // Southwest limit coordinates 
	    	[127.064452, 38.027590] // Northeast limit coordinates


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

    // document.querySelector(".mapboxgl-canvas").style.width = "100%";
    // document.querySelector(".mapboxgl-canvas").style.height = "100%";
    </script>