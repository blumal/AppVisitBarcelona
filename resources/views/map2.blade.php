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
    <div class="header">
        <div class="select">
            <form action="{{url('markets')}}" method="post">
                <label for="Etiquetas"></label>
                <!--Método onchange, cada vez que se modifique algo del select se disparará-->
                    <select class="filtro_input" name="etiqueta_et" onchange="filter()">
                        <option value=""></option>
                        @foreach ($dbEtiquetas as $item)
                            <option value="{{$item->id_et}}">{{$item->etiqueta_et}}</option>
                        @endforeach
                    </select>
        </div>
        <div class="favoritos">
            <label onchange="favoritos()"><input type="checkbox" id="favoritos" name="favoritos" value="Favorito"><div class="checkbox" id="estrella" onclick="filter()"><i class="fa-regular fa-star"></i></div></label>
        </div>
        <div class="etiquetas">
            <label for="Etiquetas"></label>
                <select class="filtro_input" name="tag_ta" onchange="filter()">
                    <option disabled selected><p class='filtro_text'>Mis Etiquetas</p></option>
                    @foreach ($dbTags as $result)
                        <option value="{{$result->id_ta}}">{{$result->tag_ta}}</option>
                    @endforeach
                </select>
            </form>                
        </div>          
    </div>

    <div class="modalbox_lugar" id="modalbox_lugar">
        <div class="modallugar" id="modallugar">
            <span class="close" onclick="closeModal_lugar(); return false;">&times;</span>
            <div class="fotos">
                {{-- <img class="foto_modal" src="media/picture/{{$result->foto_fo}}">                
            </div>
            <hr>
            <div class="titulo">
                <h1>{{$result->nombre_lu}}</h1>
            </div>
            <div class="categoria">
                <h3>{{$result->etiqueta_et}}</h3>
            </div>
            <div class="descripcion">
                <p>{{$result->descripcion_lu}}</p>
            </div> --}}
            {{-- <div class="favoritos">
                <i class="fa-regular fa-star"></i>
            </div> --}}
        </div>
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
    <div class="footer">
        <div class="logout">
            <form action="{{url('logout')}}" method="POST">
                @csrf
                <button class="logout_input" type="submit" name="logout" value="logout"><b>LOGOUT</b>   <i class="fa-solid fa-right-from-bracket"></i></button>
            </form>
        </div>
        <div class="centrar">
            <form method="POST">
                @csrf
                <button class="centrar_ubicacion" type="submit" name="centrar" value="centrar" onclick="backToCenter()"><i class="fa-solid fa-location-crosshairs"></i></button>
            </form>
        </div>
    </div>
</center>
</body>
</html>