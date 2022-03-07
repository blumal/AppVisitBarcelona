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
<!--Filtro-->
<center>
    <div class="filtro">
        <form action="{{url('etiquetas')}}" method="get">
            
            <label for="Etiquetas">Etiquetas: </label>
            <!--Método onchange, cada vez que se modifique algo del select se disparará-->
                <select class="etiqueta_et" name="etiqueta_et" onchange="etiquetas()">
                    <option value=""></option>
                    @foreach ($dbEtiquetas as $item)
                        <option value="{{$item->id_et}}">{{$item->etiqueta_et}}</option>
                    @endforeach
                </select>
                <label for="Favoritos">Favoritos</label>
                    <input type="checkbox" id="favorito" name="favorito" value="Favorito" onchange="favoritos()">
                <label for="Etiquetas">Mis etiquetas: </label>
                <select class="nombre_lu" name="id_lt" onchange="favoritos()">
                    <option value=""></option>
                    @foreach ($dbFavs as $item)
                        <option value="{{$item->id_lu}}">{{$item->nombre_lu}}</option>
                    @endforeach
                </select>
        </form>
    </div>
<!---->
    <div class="container">
        <div id="map"></div>
            <script>
                //Obtenemos la ubicación solicitándosela al usuario
                /* if (navigator.geolocation) {
                    var success = function(position) {
                        lat = position.coords.latitude;
                        long = position.coords.longitude; */

                        //------API mapa--------, mediante addTo(Movemos la info al id map)
                        var map = L.map('map').
                            setView([41.38724300721724, 2.184340276522324],
                            /* setView([lat, long], */
                            16);

                        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
                            maxZoom: 18
                            }).addTo(map);

                        L.control.scale().addTo(map);
                        L.marker([41.38724300721724, 2.184340276522324], { draggable: true }).addTo(map);
                        
                        //Icono metro
                        var myIcon = L.icon({
                            //Fotos de la carpeta proyecto
                            iconUrl: '{{asset('media/train-subway-solid.svg')}}',
                            iconSize: [30, 80],
                            iconAnchor: [22, 94],
                            //popupAnchor: [-3, -76],
                            /* shadowSize: [68, 95], */
                            //shadowAnchor: [22, 94]
                        });

                        L.marker([41.38216646438212, 2.185901305267271], {icon: myIcon}).addTo(map);
                        /* L.marker([lat, long], { draggable: true }).addTo(map); */
                        //------------------------
                    /* }
                    //Si no acepta la ubi...
                    navigator.geolocation.getCurrentPosition(success, function(msg) {
                        alert.error(msg);
                    });
                } */
            </script>
    </div>
</center>
</body>
</html>