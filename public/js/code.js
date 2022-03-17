/* ----------------------------------------------- MODAL BOX PARA REGISTRAR UN USUARIO EN EL LOGIN ----------------------------------------------- */

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

/* Modal olvido contraseña */

function abrirmodal_olvido_contraseña() {
    modal = document.getElementById('modalbox_olvido')
    modal.style.display = "block";
    modal_login = document.getElementById('modalolvido')
    modal_login.style.display = "block";
}

function closeModal_olvido_contraseña() {
    let modal = document.getElementById("modalbox_olvido");
    modal.style.display = "none";
}

window.onclick = function(event) {
    let modal = document.getElementById("modalbox_olvido");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

/* -------------------------------------------- MODAL BOX PARA CREAR/EDITAR UN USUARIO EN EL ADMIN ZONE -------------------------------------------- */

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

function abrirmodal_editar(id_us, nombre_us, apellido1_us, apellido2_us, email_us, pass_us) {
    document.getElementById('nombre_us_e').value = nombre_us;
    document.getElementById('apellido1_us_e').value = apellido1_us;
    document.getElementById('apellido2_us_e').value = apellido2_us;
    document.getElementById('email_us_e').value = email_us;
    document.getElementById('pass_us_e').value = pass_us;
    document.getElementById('idUpdate').value = id_us;
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

/* -------------------------------------------------- FUNCIONES PARA PARA MOSTRAR LAS CONTRASEÑAS -------------------------------------------------- */


/* Boton mostrar contraseña en login */

function mostrarContraseña() {
    var tipo = document.getElementById("password");
    if (tipo.type == "password") {
        tipo.type = "text";
    } else {
        tipo.type = "password";
    }
}

/* Boton mostrar contraseña en registro */

function mostrarContraseña_registro() {
    var tipo = document.getElementById("pass_us");
    var tipo2 = document.getElementById("pass_us2");
    if (tipo.type == "password" || tipo2.type == "password") {
        tipo.type = "text";
        tipo2.type = "text";
    } else {
        tipo.type = "password";
        tipo2.type = "password";
    }
}

/* Cambiar iconos mostrar contraseña */

function mostrar_contraseña_icono() {
    var favoritos = document.getElementById('ojo');
    var estrella = document.getElementById('mostrar_contraseña');
    if (favoritos.checked == true) {
        estrella.innerHTML = "<i class='fa-solid fa-eye'></i>";
    } else {
        estrella.innerHTML = "<i class='fa-solid fa-eye-slash'></i>";
    }
}

function mostrar_contraseña_icono2() {
    var favoritos = document.getElementById('ojo2');
    var estrella = document.getElementById('mostrar_contraseña2');
    if (favoritos.checked == true) {
        estrella.innerHTML = "<i class='fa-solid fa-eye'></i>";
    } else {
        estrella.innerHTML = "<i class='fa-solid fa-eye-slash'></i>";
    }
}


/* ----------------------------------------------- FUNCIONES PARA CREAR/EDITAR LUGARES EN ADMIN ZONE ----------------------------------------------- */

/* Modal crear lugar */

function abrirmodal_crear_lugar() {
    modal = document.getElementById('modalbox_crearlugar')
    modal.style.display = "block";
    modal_login = document.getElementById('modalcrear_lugar')
    modal_login.style.display = "block";
}

function closeModal_crear_lugar() {
    let modal = document.getElementById("modalbox_crearlugar");
    modal.style.display = "none";
}

window.onclick = function(event) {
    let modal = document.getElementById("modalbox_crearlugar");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

/* Modal editar lugar*/

function abrirmodal_editar_lugar() {
    modal = document.getElementById('modalbox_editarlugar')
    modal.style.display = "block";
    modal_login = document.getElementById('modaleditar')
    modal_login.style.display = "block";
}

function closeModal_editar_lugar() {
    let modal = document.getElementById("modalbox_editar");
    modal.style.display = "none";
}

window.onclick = function(event) {
    let modal = document.getElementById("modalbox_editar");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

/* ---------------------------------------------------------- QUERY ---------------------------------------------------------- */


/* Query etiquetas */

function etiquetas_lugar() {
    //Obtenemos el resultado del select, cada vez que cambie irá actualizando el dato
    let a = document.querySelector('.id_etiqueta_fk').value;
    alert(a);
}

/* ---------------------------------------------------------- VALIDACIONES ---------------------------------------------------------- */

/* Validación iniciar sesion */

function validar() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    if (email == "" || password == "") {

        if (email == "" && password != "") {

            document.getElementById('mensaje').innerHTML = "<p>No se ha especificado ningun Email</p>";
            document.getElementById('mensaje').style.color = "red";
            document.getElementById('email').style.border = "2px solid red";
            document.getElementById('div_password').style.border = "2px solid grey";
            return false;

        } else if (email != "" && password == "") {

            document.getElementById('mensaje').innerHTML = "<p>No se ha especificado ninguna Contraseña</p>";
            document.getElementById('mensaje').style.color = "red";
            document.getElementById('div_password').style.border = "2px solid red";
            document.getElementById('email').style.border = "2px solid grey";
            return false;

        } else {

            document.getElementById('mensaje').innerHTML = "<p>No se ha especificado ningun valor</p>";
            document.getElementById('mensaje').style.color = "red";
            document.getElementById('div_password').style.border = "2px solid red";
            document.getElementById('email').style.border = "2px solid red";
            return false;
        }
    } else {
        return true;
    }
}

/* Validación registro usuario */

function validar_registro() {
    var nombre = document.getElementById('nombre_us').value;
    var apellido1 = document.getElementById('apellido1_us').value;
    var apellido2 = document.getElementById('apellido2_us').value;
    var email = document.getElementById('email_us').value;
    var password1 = document.getElementById('pass_us').value;
    var password2 = document.getElementById('pass_us2').value;

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
        comprobarClave()
        closeModal();
    }
}

/* Validación crear usuario */

function validar_crear() {
    var nombre = document.getElementById('nombre_us').value;
    var apellido1 = document.getElementById('apellido1_us').value;
    var apellido2 = document.getElementById('apellido2_us').value;
    var email = document.getElementById('email_us').value;
    var pass_us = document.getElementById('pass_us').value;

    if (nombre == "" || apellido1 == "" || apellido2 == "" || email == "" || pass_us == "") {

        document.getElementById('mensaje_error_crear').innerHTML = "<p>Faltan campos por rellenar</p>";
        document.getElementById('mensaje_error_crear').style.color = "red";
        document.getElementById('nombre_us').style.border = "2px solid red";
        document.getElementById('apellido1_us').style.border = "2px solid red";
        document.getElementById('apellido2_us').style.border = "2px solid red";
        document.getElementById('email_us').style.border = "2px solid red";
        document.getElementById('div_password_crear').style.border = "2px solid red";
        return false;

    } else {
        crear();
        closeModal_crear();
    }
}


/* Validación registro lugar */

function validar_crear_lugar() {
    var nombre = document.getElementById('nombre_lu').value;
    var descripcion = document.getElementById('descripcion_lu').value;
    var foto = document.getElementById('id_foto_fk').value;
    var direccion = document.getElementById('id_direccion_fk').value;
    var etiqueta = document.getElementById('id_etiqueta_fk').value;
    var icono = document.getElementById('id_icono_fk').value;

    if (nombre == "" || descripcion == "" || foto == "" || direccion == "" || etiqueta == "" || icono == "") {

        document.getElementById('mensaje_error_crear_lugar').innerHTML = "<p>Faltan campos por rellenar</p>";
        document.getElementById('mensaje_error_crear_lugar').style.color = "red";
        document.getElementById('nombre_lu').style.border = "2px solid red";
        document.getElementById('descripcion_lu').style.border = "2px solid red";
        document.getElementById('apellido1_us').style.border = "2px solid red";
        document.getElementById('id_foto_fk').style.border = "2px solid red";
        document.getElementById('id_direccion_fk').style.border = "2px solid red";
        document.getElementById('id_etiqueta_fk').style.border = "2px solid red";
        document.getElementById('id_icono_fk').style.border = "2px solid red";
        return false;

    } else {
        crear2();
        closeModal_crear_lugar();
    }
}

/* Comprobar si las contraseñas son iguales */

function comprobarClave() {
    var clave1 = document.getElementById('pass_us').value;
    var clave2 = document.getElementById('pass_us2').value;

    if (clave1 == clave2) {
        document.getElementById('mensaje_registro').innerHTML = "";
        return true;
    } else {
        document.getElementById('mensaje_registro').style.color = "red";
        document.getElementById('mensaje_registro').innerHTML = "Las contraseñas no coinciden";
        document.getElementById('pass_us').style.border = "2px solid red";
        document.getElementById('pass_us2').style.border = "2px solid red";
        return false;
    }
}

function validar_olvido_contraseña() {
    var correo = document.getElementById('correo').value;

    if (correo == "") {
        document.getElementById('correo').style.border = "2px solid red";
        document.getElementById('mensaje_olvido').innerHTML = "<p>Tienes que introducir un correo valido</p>";
        document.getElementById('mensaje_olvido').style.color = "red";
        return false;
    } else {
        return true;
    }

}

/* --------------------------- FUNCIONES PARA HACER DESAPARECER LOS MENSAJES DE ERROR AL REGISTRAR O INICIAR SESSION ------------------------------- */

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

/*  Desaparece mensaje error_inicio cuando pulsamos en un input */

function error_inicio() {
    document.getElementById('error_inicio').innerHTML = "";
}

/* Desaparece mensaje de validar cuando pulsamos en un input */

function error_validar() {
    document.getElementById('mensaje').innerHTML = "";
    document.getElementById('div_password').style.border = "2px solid black";
    document.getElementById('email').style.border = "2px solid black";
}

/* Desaparece mensaje del envio de correo */

function error_olvido() {
    document.getElementById('mensaje_olvido').innerHTML = "";
    document.getElementById('correo').style.border = "2px solid black";
}

/* --------------------------- FUNCIONES PARA HACER DESAPARECER LOS MENSAJES DE ERROR AL CREAR USUARIO ------------------------------- */

function error_crear() {
    document.getElementById('mensaje_error_crear').innerHTML = "";
    document.getElementById('nombre_us').style.border = "2px solid black";
    document.getElementById('apellido1_us').style.border = "2px solid black";
    document.getElementById('apellido2_us').style.border = "2px solid black";
    document.getElementById('email_us').style.border = "2px solid black";
    document.getElementById('div_password_crear').style.border = "2px solid black";
}

/* --------------------------- FUNCIONES PARA HACER DESAPARECER LOS MENSAJES DE ERROR AL CREAR LUGAR ------------------------------- */

function error_crear_lugar() {
    document.getElementById('mensaje_error_crear_lugar').innerHTML = "";
    document.getElementById('nombre_lu').style.border = "2px solid black";
    document.getElementById('descripcion_lu').style.border = "2px solid black";
    document.getElementById('apellido1_us').style.border = "2px solid black";
    document.getElementById('id_foto_fk').style.border = "2px solid black";
    document.getElementById('id_direccion_fk').style.border = "2px solid black";
    document.getElementById('id_etiqueta_fk').style.border = "2px solid black";
    document.getElementById('id_icono_fk').style.border = "2px solid black";
}