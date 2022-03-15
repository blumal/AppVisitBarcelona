<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script type="text/javascript" src="{{asset('js/map.js')}}"></script>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/map.css')}}">
    <title>Home</title>
</head>
<body>
<!--Filtro-->
<center>
    <div class="filtro">
        <form action="{{url('markets')}}" method="post">
            
            <label for="Etiquetas">Etiquetas: </label>
            <!--Método onchange, cada vez que se modifique algo del select se disparará-->
                <select class="etiqueta_et" name="etiqueta_et" onchange="filter()">
                    <option value=""></option>
                    @foreach ($dbEtiquetas as $item)
                        <option value="{{$item->id_et}}">{{$item->etiqueta_et}}</option>
                    @endforeach
                </select>
                <label for="Favoritos">Mis favoritos</label>
                    <input type="checkbox" id="favoritos" name="favoritos" value="favoritos" onclick="filter()">
                <label for="Etiquetas">Mis etiquetas: </label>
                <select class="tag_ta" name="tag_ta" onchange="filter()">
                    <option value=""></option>
                    @foreach ($dbTags as $result)
                        <option value="{{$result->id_ta}}">{{$result->tag_ta}}</option>
                    @endforeach
                </select>
        </form>
    </div>
    
<!---->
    <div class="container">
        <div id="map"></div>
        
            {{-- <script>
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
                        /* L.marker([lat, long], { draggable: true }).addTo(map); */
                        //Icono 
                        
                        var markerIcon = L.icon({
                            //Fotos de la carpeta proyecto
                            iconUrl: 'media/icon/train-subway-solid.svg',
                            iconSize: [20, 20],
                            iconAnchor: [20, 20],
                            popupAnchor: [10, 10]
                        })

                        //var m = L.marker([41.38216646438212, 2.185901305267271], {icon: markerIcon}).addTo(map);
                        //Popup con contenido HTML
                        var markerIconPopup = L.popup().setContent('<h1>{{$item->nombre_lu}}</h1><p>Description</p><a href="">Link</a>');
                        var m = L.marker([41.38216646438212, 2.185901305267271], {icon: markerIcon}).bindPopup(markerIconPopup).addTo(map);
                
                        //----Polígono---ZONA asignada
                        var polygon = L.polygon([
                            [41.38848031881683, 2.1728329066133387],
                            [41.38060621214661, 2.1832460464946237],
                            [41.386391196711145, 2.1937038462573764],
                            [41.39147730418495, 2.1867770464946505],
                            [41.38987919499876, 2.1845477287036847],
                            [41.39225621821237, 2.1813844575398154],
                            [41.39110128001272, 2.179905953240446],
                            [41.390143268433626, 2.17742745753982],
                            [41.38899809706758, 2.1758068219578766],
                            [41.38848031881683, 2.1728329066133387]
                        ]).addTo(map);

                    /* }
                    //Si no acepta la ubi...
                    navigator.geolocation.getCurrentPosition(success, function(msg) {
                        alert.error(msg);
                    });
                } */
            </script> --}}
    </div>
</center>
</body>
</html>