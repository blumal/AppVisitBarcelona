<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style.css">
    <script defer src="../public/fontawesome/js/all.js"></script>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <script src="../public/js/ajax.js"></script>
    <script src="../public/js/code.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title></title>
</head>
<body id="portada">
    <div class="header">
        <div class="titulo-admin">
            <h1>ZONA <b>ADMIN</b></h1>
        </div>
        <div class="select">
            <form method="post" onsubmit="return false;">
                <input type="hidden" name="_method" value="POST" id="postFiltro">
                <select class="select_input" name="nombre" type="search" id="search" aria-label="Search" onchange="filtro(); return false;">>
                    <option value="1"><b>USUARIOS</b></option>
                    <option value="2"><b>LUGARES</b></option>
                </select>
             </form>
        </div>
        <div class="crear" id="boton">
            <button class="crear_input" name="Crear" value="Crear" onclick="abrirmodal_crear(); return false;"><b><i class="fa-solid fa-circle-plus"></i> CREAR</b></button>
        </div>
        <div class="logout">
            <form action="{{url('logout')}}" method="POST">
                @csrf
                <button class="logout_input" type="submit" name="logout" value="logout"><b>LOGOUT</b>   <i class="fa-solid fa-right-from-bracket"></i></button>
            </form>
        </div>
    </div>
    <div>
        <table class="table crud" id="table">
        </table>
    </div>

    <div class="modalbox_crear" id="modalbox_crear">
        <div class="modalcrear_header">
            <span class="close_crear" onclick="closeModal_crear(); return false;">&times;</span>             
            <h2 class="titulomodal">CREAR <b>USUARIO</b></h2>
        </div>
        <div class="modalcrear" id="modalcrear">
            <form action="{{url('crear')}}" method="post">
                @csrf
                <input class="inputcrear" type="text" name="nombre_us" id="nombre_us" placeholder="Nombre">
                <input class="inputcrear" type="text" name="apellido1_us" id="apellido1_us" placeholder="Apellido 1">
                <input class="inputcrear" type="text" name="apellido2_us" id="apellido2_us" placeholder="Apellido 2">
                <div class="hr1">
                    <hr>
                </div>
                <div class="no-cuenta-text">
                    <p>Datos de inicio de sesion</p>
                </div>
                <div class="hr2">
                    <hr>
                </div>
                <input class="inputcrear" type="email" name="email_us" id="email_us" placeholder="Usuario">
                <input class="contraseñacrear" type="password" name="pass_us" id="pass_us" placeholder="Contraseña">
                <button class="mostrarcontraseña" type="button" onclick=""><i id="eye" class="fa-solid fa-eye"></i></button>
                <input class="inputcrear" type="password" name="pass_us2" id="pass_us2" placeholder="Repite contraseña">
                <button class="botoncrear" type="submit" value="CREAR"><b>CREAR</b></button>
            </form>
    </div>

    <div class="modalbox_editar" id="modalbox_editar">
        <div class="modalcrear_header">
            <span class="close_crear" onclick="closeModal_editar(); return false;">&times;</span>             
            <h2 class="titulomodal">MODIFICAR <b>USUARIO</b></h2>
        </div>
        <div class="modaleditar" id="modaleditar">
            <form action="{{url('modificar')}}" method="post">
                @csrf
                <input class="inputcrear" type="text" name="nombre_us" id="nombre_us" placeholder="Nombre">
                <input class="inputcrear" type="text" name="apellido1_us" id="apellido1_us" placeholder="Apellido 1">
                <input class="inputcrear" type="text" name="apellido2_us" id="apellido2_us" placeholder="Apellido 2">
                <div class="hr1">
                    <hr>
                </div>
                <div class="no-cuenta-text">
                    <p>Datos de inicio de sesion</p>
                </div>
                <div class="hr2">
                    <hr>
                </div>
                <input class="inputcrear" type="email" name="email_us" id="email_us" placeholder="Usuario">
                <input class="contraseñacrear" type="password" name="pass_us" id="pass_us" placeholder="Contraseña">
                <button class="mostrarcontraseña" type="button" onclick=""><i id="eye" class="fa-solid fa-eye"></i></button>
                <input class="inputcrear" type="password" name="pass_us2" id="pass_us2" placeholder="Repite contraseña">
                <button class="botoncrear" type="submit" value="MODIFICAR"><b>MOFIFICAR</b></button>
            </form>
    </div>
        
</body>

</html>