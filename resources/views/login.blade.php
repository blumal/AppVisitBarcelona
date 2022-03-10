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
            <input class="inputlogin" type="email" name="email_us" id="email" placeholder="Email" onfocus="error_inicio()">
            <input class="inputcontraseña" type="password" name="pass_us" id="password" placeholder="Contraseña" onfocus="error_inicio()">
            <button class="mostrarcontraseña" type="button" onclick="mostrarContraseña()"><i id="eye" class="fa-solid fa-eye"></i></button>
                <div id="mensaje">
                </div>
                @if(Session::has('error_inicio'))
                    <div id='error_inicio' class="error_inicio"><br>{{Session::get('error_inicio') }} <i class="fa-solid fa-triangle-exclamation"></i><br><br></div>
                @endif
            <button class="botonlogin" type="submit" value="INICIAR SESION"><span>INICIAR SESSION</span></button>
        </form>
        <div class="hr1">
            <hr>
        </div>
        <div class="no-cuenta-text">
            <p>¿No tienes cuenta?</p>
        </div>
        <div class="hr1">
            <hr>
        </div>
            <button class="botonregistrar" value="REGISTRARSE" onclick="abrirmodal(); return false;">REGISTRARSE</button>
            @if(Session::has('error_registro'))
                <div id='error_registro' class="error_inicio"><br>{{Session::get('error_registro') }} <i class="fa-solid fa-triangle-exclamation"></i><br><br></div>
            @endif
            @if(Session::has('exito_registro'))
                <div id='exito_registro' class="error_inicio"><br>{{Session::get('exito_registro') }} <br></div>
            @endif            
        </div>
    </div>

    <div class="modalbox" id="modalbox">
        <div class="modalregistro" id="modalregistro">
            <span class="close" onclick="closeModal(); return false;">&times;</span>             
            <h2>Bienvenido</h2>
            <form action="{{url('registro')}}" method="post" onsubmit="return validar_registro();">
                @csrf
                <input class="inputregistro" type="text" name="nombre_us" id="nombre_us" placeholder="Nombre" onfocus="error_registro()">
                <input class="inputregistro" type="text" name="apellido1_us" id="apellido1_us" placeholder="Apellido 1" onfocus="error_registro()">
                <input class="inputregistro" type="text" name="apellido2_us" id="apellido2_us" placeholder="Apellido 2" onfocus="error_registro()">
                <div class="hr1">
                    <hr>
                </div>
                <div class="no-cuenta-text">
                    <p>Datos de inicio de sesión</p>
                </div>
                <div class="hr2">
                    <hr>
                </div>
                <input class="inputregistro" type="email" name="email_us" id="email_us" placeholder="Usuario" onfocus="error_registro()">
                <input class="contraseñaregistro" type="password" name="pass_us" id="pass_us" placeholder="Contraseña" onfocus="error_registro()">
                <button class="mostrarcontraseña" type="button" onclick=""><i id="eye" class="fa-solid fa-eye"></i></button>
                <input class="inputregistro" type="password" name="pass_us2" id="pass_us2" placeholder="Repite contraseña" onfocus="error_registro()">
                <div id="mensaje_registro">
                </div>
                <button class="botonregistro" type="submit" value="REGISTRARSE" onclick="return comprobarClave();"><b>REGISTRARSE<b></button>
            </form>
        </div>
</body>

</html>