<div id="map_wrap">
    <div id='map'></div>
</div>



    <script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoic3VyaWNpdHkiLCJhIjoiY2tiZnpzaGtzMTB5NTJwcWVtOHF5anRmMCJ9.CI4QuMCsvVak3vrNtnJWcw';
    var map = new mapboxgl.Map({
    container: 'map',
    // style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
    style: 'mapbox://styles/suricity/ckbg1kxyd3jjo1is4ro4nkpb5', // stylesheet location
    center: [-74.5, 40], // starting position [lng, lat]
    zoom: 9 // starting zoom
    });
    </script>