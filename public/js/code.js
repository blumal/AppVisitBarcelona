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

/*Modal editar lugar*/

function abrirmodal_editarlugar(id_lu, nombre_lu, descripcion_lu, direccion_di, id_etiqueta_fk, id_icono_fk) {
    document.getElementById('nombre_lu_e').value = nombre_lu;
    document.getElementById('descripcion_lu_e').value = descripcion_lu;
    // document.getElementById('foto_e').value = foto_fo;
    document.getElementById('direccion_di_e').value = direccion_di;
    document.getElementById('id_etiqueta_fk_e').value = id_etiqueta_fk;
    console.log(id_etiqueta_fk)
        // document.getElementById('icono_e').value = id_icono_fk;
    document.getElementById('idUpdate2').value = id_lu;
    modal = document.getElementById('modalbox_editar_lugar')
    modal.style.display = "block";
    modal_login = document.getElementById('modaleditar_lugar')
    modal_login.style.display = "block";
}

function closeModal_editarlugar() {
    let modal = document.getElementById("modalbox_editar_lugar");
    modal.style.display = "none";
}

window.onclick = function(event) {
    let modal = document.getElementById("modalbox_editar_lugar");
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

function mostrarContraseña2() {
    var tipo = document.getElementById("pass_us");
    if (tipo.type == "pass_us") {
        tipo.type = "text";
    } else {
        tipo.type = "pass_us";
    }
}

/* Modal ver mas lugar */

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

/* Validación registro usuario */

function validar_registro() {
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

function etiquetas_lugar() {
    //Obtenemos el resultado del select, cada vez que cambie irá actualizando el dato
    let a = document.querySelector('.id_etiqueta_fk').value;
    alert(a);
}

function ar() {
    alert('');
}