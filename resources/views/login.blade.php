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
            <input class="inputlogin" type="email" name="email_us" id="email" placeholder="Email" onfocus="error_validar();error_inicio();">
            <div class="divcontraseña" id="div_password">
                <input class="inputcontraseña" type="password" id="password" name="pass_us"placeholder="Contraseña" onfocus="error_validar();error_inicio();">
                <label onchange="mostrar_contraseña_icono()"><input id="ojo" class="mostrarcontraseña" type="checkbox" onclick="mostrarContraseña()"><div class="checkbox" id="mostrar_contraseña"><i class="fa-solid fa-eye-slash"></i></div></label>
            </div>
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
        <div class="contraseña-olvidada">
            <button class="contraseña-olvidada-btn" onclick="abrirmodal_olvido_contraseña(); return false;">¿Has olvidado la contraseña?</button>
        </div>          
        </div>
        
    </div>

    <div class="modalbox" id="modalbox">
        <div class="modalregistro" id="modalregistro">
            <span class="close" onclick="closeModal(); return false;">&times;</span>             
            <h2>Bienvenido</h2>
            <form action="{{url('registro')}}" method="post" onsubmit="validar_registro(); return false;">
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
                <label onchange="mostrar_contraseña_icono2()"><input id="ojo2" class="mostrarcontraseña" type="checkbox" onclick="mostrarContraseña_registro()"><div class="checkbox" id="mostrar_contraseña2"><i class="fa-solid fa-eye-slash"></i></div></label>
                <input class="inputregistro" type="password" name="pass_us2" id="pass_us2" placeholder="Repite contraseña" onfocus="error_registro()">
                <div id="mensaje_registro">
                </div>
                <button class="botonregistro" type="submit" value="REGISTRARSE" onclick="return comprobarClave();"><b>REGISTRARSE<b></button>
            </form>
            @if(Session::has('correo_enviado'))
                <div id='correo_enviado' class="correo_enviado"><br>{{Session::get('correo_enviado') }} <br></div>
            @endif  
        </div>
    </div>

    <div class="modalbox_olvido" id="modalbox_olvido">
        <div class="modalolvido" id="modalolvido">
            <span class="close" onclick="closeModal_olvido_contraseña(); return false;">&times;</span>             
            <h2>Contraseña olvidada</h2>
            <form action="{{url('envio')}}" method="get" onsubmit="return validar_olvido_contraseña();">
                @csrf
                <input class="inputregistro" type="email" name="correo" id="correo" placeholder="Introduce tu email" onfocus="error_olvido()">
                <div id="mensaje_olvido">
                </div>
                <button class="botonregistro" type="submit" value="ENVIAR"><b>ENVIAR<b></button>
            </form>
        </div>
    </div>

</body>
</html>