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

            document.getElementById('mensaje').innerHTML = "<p>No se ha especificado ningun Valor</p>";
            document.getElementById('mensaje').style.color = "red";
            document.getElementById('password').style.border = "2px solid red";
            document.getElementById('email').style.border = "2px solid red";
            return false;
        }
    } else {
        return true;
    }
}