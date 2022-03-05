<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
    <script type="text/javascript" src="{{asset('js/map.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/map.css')}}">
    <title>Home</title>
</head>
<body>
<center>
    <div id="map"></div>
    <script>
        //Obtenemos la ubicación solicitándosela al usuario
        if (navigator.geolocation) {
            var success = function(position) {
                lat = position.coords.latitude;
                long = position.coords.longitude;

                //------API mapa--------
                var map = L.map('map').
                    setView([lat, long],
                    16);

                L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
                    maxZoom: 18
                    }).addTo(map);

                L.control.scale().addTo(map);
                L.marker([lat, long], { draggable: true }).addTo(map);
                //------------------------
            }
            //Si no acepta la ubi...
            navigator.geolocation.getCurrentPosition(success, function(msg) {
                alert.error(msg);
            });
        }
        
        /* var map = L.map('map').
            setView([41.3497854, 2.1078363],
            14);

        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
            maxZoom: 18
            }).addTo(map);

        L.control.scale().addTo(map);
        L.marker([41.3497854, 2.1078363], { draggable: true }).addTo(map); */
    </script>
</center>
</body>
</html>