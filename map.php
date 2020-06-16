<div id="map_wrap">
    <div id='map' style='width: 100%; height: 100%;'></div>
</div>



    <script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoic3VyaWNpdHkiLCJhIjoiY2tiZnpzaGtzMTB5NTJwcWVtOHF5anRmMCJ9.CI4QuMCsvVak3vrNtnJWcw';
    var map = new mapboxgl.Map({
    container: 'map',
    // style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
    style: 'mapbox://styles/suricity/ckbg1kxyd3jjo1is4ro4nkpb5', // stylesheet location
    // center: [192, 37], // starting position [lng, lat]
    center: [127.057193, 37.914048], // starting position [lng, lat]
    zoom: 12 // starting zoom
    });

    // document.querySelector(".mapboxgl-canvas").style.width = "100%";
    // document.querySelector(".mapboxgl-canvas").style.height = "100%";
    </script>