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

function leerMarkets() {

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