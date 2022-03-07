<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style.css">
    <script defer src="../public/fontawesome/js/all.js"></script>
    <title>Login</title>
    <script src="../public/js/code.js"></script>
</head>

<body id="portada">
    <br>
    <div class="titulo">
        <h1>APP VISIT BARCELONA</h1>
    </div>
    <br>
    <div class="login">
        <div class="loginicon">
            <i class="fa-solid fa-lock"></i>
        </div>
        <form action="{{url('loginpost')}}" method="post" onsubmit="return validar();">
            @csrf
            <input class="inputlogin" type="email" name="email_us" id="email" placeholder="Email">
            <input class="inputcontraseña" type="password" name="pass_us" id="password" placeholder="Contraseña">
            <button class="mostrarcontraseña" type="button" onclick="mostrarContraseña()"><i id="eye" class="fa-solid fa-eye"></i></button>
                <div id="mensaje">
                </div>
            <button class="botonlogin" type="submit" value="INICIAR SESION"><b>INICIAR SESSION<b></button>
        </form>
        <div class="hr1">
            <hr>
        </div>
        <div class="no-cuenta-text">
            <p>¿No tienes cuenta?</p>
        </div>
        <div class="hr2">
            <hr>
        </div>
            <button class="botonregistrar" value="REGISTRARSE" onclick="abrirmodal(); return false;">REGISTRARSE</button>          
        </div>
    </div>

    <div class="modalbox" id="modalbox">
        <div class="modalregistro" id="modalregistro">
            <span class="close" onclick="closeModal(); return false;">&times;</span>             
            <h2>Bienvenido</h2>
            <form action="{{url('registro')}}" method="post">
                @csrf
                <input class="inputregistro" type="text" name="nombre_us" id="nombre_us" placeholder="Nombre">
                <input class="inputregistro" type="text" name="apellido1_us" id="apellido1_us" placeholder="Apellido 1">
                <input class="inputregistro" type="text" name="apellido2" id="apellido2" placeholder="Apellido 2">
                <input class="inputregistro" type="email" name="email_us" id="email_us" placeholder="Usuario">
                <input class="contraseñaregistro" type="password" name="pass_us" id="pass_us" placeholder="Contraseña">
                <button class="mostrarcontraseña" type="button" onclick=""><i id="eye" class="fa-solid fa-eye"></i></button>
                <input class="inputregistro" type="password" name="pass_us2" id="pass_us2" placeholder="Repite contraseña">
                <button class="botonregistro" type="submit" value="INICIAR SESION"><b>REGISTRARSE<b></button>
            </form>
        </div>
</body>

</html>