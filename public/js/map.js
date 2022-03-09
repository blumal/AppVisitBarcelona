//Cuando la página principal se recargue, llama a la función leerMarkets
window.onload = function() {
    leerMarkets();
}

function objetoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function leerMarkets() {
    //---------------------------------------------------------------MAPA--------------------------------------------------------------------
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

    /* var markerIcon = L.icon({
        //Fotos de la carpeta proyecto
        iconUrl: 'media/icon/train-subway-solid.svg',
        iconSize: [20, 20],
        iconAnchor: [20, 20],
        popupAnchor: [10, 10]
    }) */

    //var m = L.marker([41.38216646438212, 2.185901305267271], {icon: markerIcon}).addTo(map);
    //Popup con contenido HTML
    /* var markerIconPopup = L.popup().setContent('<h1>{{$item->nombre_lu}}</h1><p>Description</p><a href="">Link</a>');
    var m = L.marker([41.38216646438212, 2.185901305267271], { icon: markerIcon }).bindPopup(markerIconPopup).addTo(map); */

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
    //-------------------------------------------------------------------------------------------------------------------------------

    //alert('heyy')
    //Obtenemos el div del mapa
    var iconsToMap = document.getElementById('map');
    //Creamos un nuevo objeto
    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));

    //Inicializamos el objeto Ajax
    var ajax = objetoAjax();
    //Datos del fichero web
    ajax.open("POST", "markets", true);
    ajax.onreadystatechange = function() {
        //Si la respuesta de Ajax es correcta, ejecuta...
        if (ajax.readyState == 4 && ajax.status == 200) {
            //Llama a la variable del controler
            var respuesta = JSON.parse(this.responseText);
            var recarga = '';

            for (let i = 0; i < respuesta.length; i++) {
                var markerIcon = L.icon({
                    //Fotos de la carpeta proyecto
                    iconUrl: 'media/icon/' + respuesta[i].path_ic,
                    iconSize: [20, 20],
                    iconAnchor: [20, 20],
                    popupAnchor: [10, 10]
                })
                var markerIconPopup = L.popup().setContent('<h1>Hola</h1><p>Description</p><a href="">Link</a>');
                var m = L.marker([respuesta[i].latitud_di, respuesta[i].longitud_di], { icon: markerIcon }).bindPopup(markerIconPopup).addTo(map);

            }
            //A la variable que contiene el id, le añadimos, los resultados de el for
            iconsToMap.innerHTML = recarga;
        }
    }

    ajax.send(formData);
}






//Obtenemos los resultados del select, para filtrar directamente por etiquetas del sistema
function etiquetas() {
    //Obtenemos el resultado del select, cada vez que cambie irá actualizando el dato
    let a = document.querySelector('.etiqueta_et').value;
    alert(a);
}

//Obtenemos los resultados del select, para filtrar directamente por los sitios favoritos del usuario
function favoritos() {
    /* let b = document.querySelector('.nombre_lu').value;
    alert(b); */
    alert('Favoritos is working');
}

//Api del mapa
/* var map = L.map('map').
setView([41.66, -4.72],
    14);

L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
    maxZoom: 18
}).addTo(map);

L.control.scale().addTo(map);
L.marker([41.66, -4.71], { draggable: true }).addTo(map); */

//alert("Hola");
//Preguntar geolocalización
/* if (navigator.geolocation) {
    var success = function(position) {
        var latitud = position.coords.latitude,
            longitud = position.coords.longitude;
    }
    navigator.geolocation.getCurrentPosition(success, function(msg) {
        console.error(msg);
    });
} */