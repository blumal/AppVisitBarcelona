//Cuando la página principal se recargue, llama a la función leerMarkets
window.onload = function() {
    leerMarkets();
    arr_markers = [];
    routingControl = null;
    zoom = null;
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
    if (navigator.geolocation) {
        var success = function(position) {
            lat = position.coords.latitude;
            long = position.coords.longitude;
            map = L.map('map').
                //setView([41.38724300721724, 2.184340276522324],
            setView([lat, long],
                16);

            L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
                maxZoom: 18
            }).addTo(map);

            L.control.scale().addTo(map);
            /* L.marker([41.38724300721724, 2.184340276522324], { draggable: true }).addTo(map); */
            L.marker([lat, long], { draggable: true }).addTo(map);

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
                    console.log(respuesta);
                    //Al no utilizar esta variable la comentamos, ya que aplicaremos los cambios directamente
                    //var recarga = '';

                    for (let i = 0; i < respuesta.length; i++) {
                        var markerIcon = L.icon({
                                //Fotos de la carpeta proyecto
                                iconUrl: 'media/icon/' + respuesta[i].path_ic,
                                iconSize: [20, 20],
                                iconAnchor: [20, 20],
                                popupAnchor: [10, 10]
                            })
                            //Contenido popup
                        var markerIconPopup = L.popup().setContent(
                            '<center>' + '<h1>' + respuesta[i].nombre_lu + '</h1>' +
                            '<img src="media/picture/' + respuesta[i].foto_fo + '" width="150px">' + '<br/><br/>' +
                            '<div class="vermas">' +
                            '<button class="ver" onclick="abrirmodal_lugar(' + respuesta[i].id_lu + ',\'' + respuesta[i].nombre_lu + '\',\'' + respuesta[i].descripcion_lu + '\',\'' + respuesta[i].foto_fo + '\',\'' + respuesta[i].etiqueta_et + '\'); return false;">Ver mas...</button>' +
                            '</div>' +
                            '<div class="comollegar">' +
                            '<button class="crosshair" onclick="routingMap(' + respuesta[i].latitud_di + ',' + respuesta[i].longitud_di + ')"><i class="fa-solid fa-location-dot"></i></button>' +
                            '</div>' +
                            '<br>' +
                            '<br>' +
                            '</center>'
                        );
                        //Marker juntando Popup
                        var m = L.marker([respuesta[i].latitud_di, respuesta[i].longitud_di], { icon: markerIcon }).bindPopup(markerIconPopup).addTo(map);
                        //L.marker([41.39147730418495, 2.1867770464946505], { draggable: true }).addTo(map);
                        arr_markers.push(m);

                    }
                    //A la variable que contiene el id, le añadimos, los resultados de el for
                    //iconsToMap.innerHTML = recarga;
                    //console.log(arr_markers);
                }
            }

            ajax.send(formData);
        }

    }
    //Si no acepta la ubi...
    navigator.geolocation.getCurrentPosition(success, function(msg) {
        alert.error(msg);
    });
}

function filter() {
    if (arr_markers != []) {
        for (let i = 0; i < arr_markers.length; i++) {
            //Eliminamos el contenido del array
            map.removeLayer(arr_markers[i]);
            console.log('Eliminando array: ' + arr_markers.length)
        }
    }
    //Definimos el array vacío
    arr_markers = [];

    var formData = new FormData();
    formData.append('_token', document.getElementById('token').getAttribute("content"));
    //--------Filtro--------
    formData.append('etiqueta_et', document.querySelector('.etiqueta_et').value);
    var fav = document.getElementById('favoritos');
    if (fav.checked == true) {
        fav = 1;
        formData.append('fav', fav);
    }
    formData.append('tag_ta', document.querySelector('.tag_ta').value);
    //formData.append('favoritos', document.getElementById('favoritos').checked);
    /* alert(formData.append('etiqueta_et', document.querySelector('.etiqueta_et').value));
    alert(formData.append('favoritos', document.getElementById('favoritos').checked));
    alert(formData.append('tag_ta', document.querySelector('.tag_ta').value)); */
    //alert('test: ' + document.querySelector('.etiqueta_et').value);
    //alert('test2: ' + document.getElementById('favoritos').checked);
    //alert('test3: ' + document.querySelector('.tag_ta').value);
    //Inicializamos el objeto Ajax
    var ajax = objetoAjax();
    //Datos del fichero web
    ajax.open("POST", "filtro", true);

    ajax.onreadystatechange = function() {
        //Si la respuesta de Ajax es correcta, ejecuta...
        if (ajax.readyState == 4 && ajax.status == 200) {
            //Llama a la variable del controler
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta);
            //Al no utilizar esta variable la comentamos, ya que aplicaremos los cambios directamente
            //var recarga = '';

            for (let i = 0; i < respuesta.length; i++) {

                var markerIcon = L.icon({
                        //Fotos de la carpeta proyecto
                        iconUrl: 'media/icon/' + respuesta[i].path_ic,
                        iconSize: [20, 20],
                        iconAnchor: [20, 20],
                        popupAnchor: [10, 10]
                    })
                    //Contenido popup
                var markerIconPopup = L.popup().setContent(
                    '<center>' + '<h1>' + respuesta[i].nombre_lu + '</h1>' +
                    '<img src="media/picture/' + respuesta[i].foto_fo + '" width="150px">' + '<br/><br/>' +
                    '<div class="vermas">' +
                    '<button class="ver" onclick="abrirmodal_lugar(' + respuesta[i].id_lu + ',\'' + respuesta[i].nombre_lu + '\',\'' + respuesta[i].descripcion_lu + '\',\'' + respuesta[i].foto_fo + '\',\'' + respuesta[i].etiqueta_et + '\'); return false;">Ver mas...</button>' +
                    '</div>' +
                    '<div class="comollegar">' +
                    '<button class="crosshair" onclick="routingMap(' + respuesta[i].latitud_di + ',' + respuesta[i].longitud_di + ')">><i class="fa-solid fa-location-crosshairs"></i></button>' +
                    '</div>' +
                    '<br>' +
                    '<br>' +
                    '</center>'
                );
                //Marker juntando Popup
                var m = L.marker([respuesta[i].latitud_di, respuesta[i].longitud_di], { icon: markerIcon }).bindPopup(markerIconPopup).addTo(map);
                //L.marker([41.39147730418495, 2.1867770464946505], { draggable: true }).addTo(map);
                //Añadimos elementos de m al array
                arr_markers.push(m);

            }
            //A la variable que contiene el id, le añadimos, los resultados de el for
            //iconsToMap.innerHTML = recarga;
        }
    }

    ajax.send(formData);
}

//Asigno los valores pasados desde el botón, a los valores a y b
function routingMap(a, b) {
    //Si routing control no es nulo, significa que hay datos, por lo que eliminará todo el routing control
    if (routingControl != null) {
        map.removeControl(routingControl)
    }
    routingControl =
        L.Routing.control({
            waypoints: [
                L.latLng(lat, long),
                L.latLng(a, b)
            ],
            language: 'es',
        }).addTo(map);
}

function backToCenter() {
    map.setView([lat, long], 16);
}

/* //Obtenemos los resultados del select, para filtrar directamente por los sitios favoritos del usuario
function favoritos() {
    //let b = document.querySelector('.nombre_lu').value;
    //alert(b);
    alert('Favoritos is working');
} */

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

//Obtenemos los resultados del select, para filtrar directamente por los sitios favoritos del usuario
function favoritos() {
    var favoritos = document.getElementById('favoritos');
    var estrella = document.getElementById('estrella');
    if (favoritos.checked == true) {
        estrella.innerHTML = "<i class='fa-regular fa-star'></i>";
    } else {
        estrella.innerHTML = "<i class='fa-solid fa-star'></i>";
    }
}

/* Modal ver mas lugar */

function abrirmodal_lugar() {
    modal = document.getElementById('modalbox_lugar')
    modal.style.display = "block";
    modal_login = document.getElementById('modallugar')
    modal_login.style.display = "block";
}

function closeModal_lugar() {
    let modal = document.getElementById("modalbox_lugar");
    modal.style.display = "none";
}

window.onclick = function(event) {
    let modal = document.getElementById("modalbox_lugar");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}