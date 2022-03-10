/* Modal registrar */

function abrirmodal() {
    modal = document.getElementById('modalbox')
    modal.style.display = "block";
    modal_login = document.getElementById('modalregistro')
    modal_login.style.display = "block";
}

function closeModal() {
    let modal = document.getElementById("modalbox");
    modal.style.display = "none";
}

window.onclick = function(event) {
    let modal = document.getElementById("modalbox");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

/* Modal crear */

function abrirmodal_crear() {
    modal = document.getElementById('modalbox_crear')
    modal.style.display = "block";
    modal_login = document.getElementById('modalcrear')
    modal_login.style.display = "block";
}

function closeModal_crear() {
    let modal = document.getElementById("modalbox_crear");
    modal.style.display = "none";
}

window.onclick = function(event) {
    let modal = document.getElementById("modalbox_crear");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

/* Modal editar */

function abrirmodal_editar_usuario() {
    modal = document.getElementById('modalbox_editar')
    modal.style.display = "block";
    modal_login = document.getElementById('modaleditar')
    modal_login.style.display = "block";
}

function closeModal_editar() {
    let modal = document.getElementById("modalbox_editar");
    modal.style.display = "none";
}

window.onclick = function(event) {
    let modal = document.getElementById("modalbox_editar");
    if (event.target == modal) {
        modal.style.display = "none";
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

/* Boton mostrar contraseña */

function mostrarContraseña() {
    var tipo = document.getElementById("password");
    if (tipo.type == "password") {
        tipo.type = "text";
    } else {
        tipo.type = "password";
    }
}

/* FUNCIONES DEL LOGIN DEL USUARIO */

/* Validación iniciar sesion */

function validar() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    // alert(email);
    // alert(password);

    if (email == "" || password == "") {

        if (email == "" && password != "") {

            //alert ("No se ha especificado ningun Email");

            document.getElementById('mensaje').innerHTML = "<p>No se ha especificado ningun Email</p>";
            document.getElementById('mensaje').style.color = "red";
            document.getElementById('email').style.border = "2px solid red";
            document.getElementById('password').style.border = "2px solid grey";
            return false;

        } else if (email != "" && password == "") {

            //alert ("No se ha especificado ninguna Contraseña");

            document.getElementById('mensaje').innerHTML = "<p>No se ha especificado ninguna Contraseña</p>";
            document.getElementById('mensaje').style.color = "red";
            document.getElementById('password').style.border = "2px solid red";
            document.getElementById('email').style.border = "2px solid grey";
            return false;

        } else {

            //alert ("No se ha especificado ningun valor");

            document.getElementById('mensaje').innerHTML = "<p>No se ha especificado ningun valor</p>";
            document.getElementById('mensaje').style.color = "red";
            document.getElementById('password').style.border = "2px solid red";
            document.getElementById('email').style.border = "2px solid red";
            return false;
        }
    } else {
        return true;
    }
}

/*  Desaparece mensaje error_inicio cuando pulsamos en un input */

function error_inicio() {
    document.getElementById('error_inicio').innerHTML = "";
    error_validar();
}

/* Desaparece mensaje de validar cuando pulsamos en un input */

function error_validar() {
    document.getElementById('mensaje').innerHTML = "";
    document.getElementById('password').style.border = "2px solid black";
    document.getElementById('email').style.border = "2px solid black";

}

/* FUNCIONES DEL REGISTRO DEL USUARIO */

/* Validación registro usuario */

function validar_registro() {
    var nombre = document.getElementById('nombre_us').value;
    var apellido1 = document.getElementById('apellido1_us').value;
    var apellido2 = document.getElementById('apellido2_us').value;
    var email = document.getElementById('email_us').value;
    var password1 = document.getElementById('pass_us').value;
    var password2 = document.getElementById('pass_us2').value;

    // alert(email);
    // alert(password);

    if (nombre == "" || apellido1 == "" || apellido2 == "" || email == "" || password1 == "" || password2 == "") {

        document.getElementById('mensaje_registro').innerHTML = "<p>Faltan campos por rellenar</p>";
        document.getElementById('mensaje_registro').style.color = "red";
        document.getElementById('nombre_us').style.border = "2px solid red";
        document.getElementById('apellido1_us').style.border = "2px solid red";
        document.getElementById('apellido2_us').style.border = "2px solid red";
        document.getElementById('email_us').style.border = "2px solid red";
        document.getElementById('pass_us').style.border = "2px solid red";
        document.getElementById('pass_us2').style.border = "2px solid red";
        return false;

    } else {
        return true;
    }
}

/*  Desaparece mensaje mensaje_registro cuando pulsamos en un input */

function error_registro() {
    document.getElementById('mensaje_registro').innerHTML = "";
    document.getElementById('nombre_us').style.border = "2px solid black";
    document.getElementById('apellido1_us').style.border = "2px solid black";
    document.getElementById('apellido2_us').style.border = "2px solid black";
    document.getElementById('email_us').style.border = "2px solid black";
    document.getElementById('pass_us').style.border = "2px solid black";
    document.getElementById('pass_us2').style.border = "2px solid black";
}

/* Comprobar si las contraseñas son iguales */

function comprobarClave() {
    var clave1 = document.getElementById('pass_us').value;
    var clave2 = document.getElementById('pass_us2').value;

    if (clave1 == clave2) {
        document.getElementById('mensaje_registro').innerHTML = "";
    } else {
        document.getElementById('mensaje_registro').style.color = "red";
        document.getElementById('mensaje_registro').innerHTML = "Las contraseñas no coinciden";
        document.getElementById('pass_us').style.border = "2px solid red";
        document.getElementById('pass_us2').style.border = "2px solid red";
    }
}