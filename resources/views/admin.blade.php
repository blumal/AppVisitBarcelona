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
                <input class="inputregistro" type="text" name="nombre_us" id="nombre_us" placeholder="Nombre">
                <input class="inputregistro" type="text" name="apellido1_us" id="apellido1_us" placeholder="Apellido 1">
                <input class="inputregistro" type="text" name="apellido2_us" id="apellido2_us" placeholder="Apellido 2">
                <div class="hr1">
                    <hr>
                </div>
                <div class="no-cuenta-text">
                    <p>Datos de inicio de sesion</p>
                </div>
                <div class="hr2">
                    <hr>
                </div>
                <input class="inputregistro" type="email" name="email_us" id="email_us" placeholder="Usuario">
                <input class="contraseñaregistro" type="password" name="pass_us" id="pass_us" placeholder="Contraseña">
                <button class="mostrarcontraseña" type="button" onclick=""><i id="eye" class="fa-solid fa-eye"></i></button>
                <input class="inputregistro" type="password" name="pass_us2" id="pass_us2" placeholder="Repite contraseña">
                <button class="botonregistro" type="submit" value="INICIAR SESION"><b>CREAR</b></button>
            </form>
    </div>

    <div class="modalbox_editar" id="modalbox_editar">
        <div class="modaleditar" id="modaleditar">
            <span class="close" onclick="closeModal_editar(); return false;">&times;</span>             
            <h2><b>CRffEAR USUARIO</b></h2>
            <form action="{{url('crear')}}" method="post">
                @csrf
                <input class="inputregistro" type="text" name="nombre_us" id="nombre_us" placeholder="Nombre">
                <input class="inputregistro" type="text" name="apellido1_us" id="apellido1_us" placeholder="Apellido 1">
                <input class="inputregistro" type="text" name="apellido2_us" id="apellido2_us" placeholder="Apellido 2">
                <div class="hr1">
                    <hr>
                </div>
                <div class="no-cuenta-text">
                    <p>Datos de inicio de sesion</p>
                </div>
                <div class="hr2">
                    <hr>
                </div>
                <input class="inputregistro" type="email" name="email_us" id="email_us" placeholder="Usuario">
                <input class="contraseñaregistro" type="password" name="pass_us" id="pass_us" placeholder="Contraseña">
                <button class="mostrarcontraseña" type="button" onclick=""><i id="eye" class="fa-solid fa-eye"></i></button>
                <input class="inputregistro" type="password" name="pass_us2" id="pass_us2" placeholder="Repite contraseña">
                <button class="botonregistro" type="submit" value="INICIAR SESION"><b>CREAR</b></button>
            </form>
    </div>
    <div>pp
        <table class="table" id="table">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Email</th>
                <th scope="col" colspan="2">Acciones</th>
            </tr>
            @forelse ($listaUsuario as $usuario)
            <tr>
                <td scope="row">{{$usuario->id_us}}</td>
                <td>{{$usuario->nombre_us}}</td>
                <td>{{$usuario->apellido1_us}} {{$usuario->apellido2_us}}</td>
                <td>{{$usuario->email_us}}</td>
                <td>
                    {{-- Route::get('/clientes/{cliente}/edit',[ClienteController::class,'edit'])->name('clientes.edit'); --}}
                    <button class= "btn btn-secondary" type="submit" value="Edit" onclick="modalbox({{$usuario->id_us}},'{{$usuario->nombre_us}}','{{$usuario->apellido1_us}}','{{$usuario->email_us}}');return false;">Editar</button>
                </td>
                <td>
                    {{-- Route::delete('/clientes/{cliente}',[ClienteController::class,'destroy'])->name('clientes.destroy'); --}}
                    <form method="post">
                        <input type="hidden" name="_method" value="DELETE" id="deleteNote">
                        <button class="btn btn-danger" type="submit" value="Delete" onclick="eliminar({{$usuario->id_us}}); return false;">Eliminar</button>
                     </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7">No hay registros</td></tr>
            @endforelse
        </table>
    </div>
</body>
</html>