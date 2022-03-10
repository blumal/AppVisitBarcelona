<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
    <script type="text/javascript" src="{{asset('js/map.js')}}"></script>
    <script defer src="../public/fontawesome/js/all.js"></script>
    <script src="../public/js/code.js"></script>
    <link rel="stylesheet" href="{{asset('css/map.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
    <link rel="stylesheet" href="../public/css/style.css">
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
                <select class="nombre_lu" name="nombre_lu" onchange="favoritos()">
                    <option value=""></option>
                    @foreach ($dbFavs as $item)
                        <option value="{{$item->id_lu}}">{{$item->nombre_lu}}</option>
                    @endforeach
                </select>
        </form>
        <form action="{{url('logout')}}" method="POST">
            @csrf
            <button class="logout_input" type="submit" name="logout" value="logout"><b>LOGOUT</b>   <i class="fa-solid fa-right-from-bracket"></i></button>
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
                        var markerIconPopup = L.popup().setContent('<h1>{{}}</h1><p>Description</p><button class="ver" onclick="abrirmodal_lugar(); return false;">Ver mas...</button>');
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


<div class="modalbox_lugar" id="modalbox_lugar">
    <div class="modallugar" id="modallugar">
        <span class="close" onclick="closeModal_lugar(); return false;">&times;</span>
        <div class="fotos">
            <img src="">
        </div>
        <hr>
        <div class="titulo">
            <h1>TITULO DE MUESTRA<h1>
        </div>
        <div class="categoria">
            <h3>Soy un restaurante<h3>
        </div>
        <div class="descripcion">
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
        </div>
        <div class="favoritos">
            <i class="fa-regular fa-star"></i>
        </div>
    </div>
</div>

</center>
</body>
</html>