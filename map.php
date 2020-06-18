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
	    	//limit dongducheon 
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

		// geocoder = new MapboxGeocoder({
		// 	mapboxgl: mapboxgl,
		//     accessToken: mapboxgl.accessToken,
		// });

		// map.addControl(geocoder);

    
    </script>