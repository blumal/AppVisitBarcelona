<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="../public/fontawesome/js/all.js"></script>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <script src="../public/js/ajax.js"></script>
    <script src="../public/js/code.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/style.css">

    <title></title>
</head>
<body id="portada">
    <div class="header">
        <div class="titulo-admin">
            <h1>ZONA <b>ADMIN</b></h1>
        </div>
        {{-- <div id="message" style="color:green"></div> --}}
        <div class="select">
            <form method="post" onsubmit="return false;">
                <input type="hidden" name="_method" value="POST" id="postFiltro">
                <select class="select_input" name="nombre" type="search" id="search" aria-label="Search" onchange="filtro(); return false;">>
                    <option value="1"><b>USUARIOS</b></option>
                    <option value="2"><b>LUGARESS</b></option>
                </select>
             </form>
        </div>
        <div class="crear" id="boton">
            <button class="crear_input" name="Crear" value="Crear" id="botoncrear"  ><b><i class="fa-solid fa-circle-plus"></i> CREAR</b></button>
        </div>
        
        <div class="logout">
            <form action="{{url('logout')}}" method="POST">
                @csrf
                <button class="logout_input" type="submit" name="logout" value="logout"><b>LOGOUT</b>   <i class="fa-solid fa-right-from-bracket"></i></button>
            </form>
        </div>
    </div>
    <div>
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
                        <input type="hidden" name="_method" value="DELETE" id="deleteNotee">
                        <button class="btn btn-danger" type="submit" value="Delete" onclick="eliminar({{$usuario->id_us}}); return false;">Eliminar</button>
                     </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7">No hay registros</td></tr>
            @endforelse
        </table>
    </div>
    <div class="modalbox_crearlugar" id="modalbox_crearlugar">
        <div class="modalcrear_header">
            <span class="close_crear" onclick="closeModal_crear_lugar(); return false;">&times;</span>
            <h2 class="titulomodal">CREAR <b>LUGAR</b></h2>
        </div>
        <div class="modalcrear_lugar" id="modalcrear_lugar">
            <form onsubmit="crear2();closeModal_crearlugar();return false;" method="get" id="formcrear2" enctype="multipart/form-data">
                <input class="inputcrear" type="text" name="nombre_lu" id="nombre_lu" placeholder="Nombre" onfocus="error_registro()">
                <input class="inputcrear" type="text" name="descripcion_lu" id="descripcion_lu" placeholder="Descripcion" onfocus="error_registro()">
                <input class="inputcrear" type="file" name="foto" id="foto" placeholder="Foto" onfocus="error_registro()">
                <input class="inputcrear" type="text" name="direccion_di" id="direccion_di" placeholder="Direccion" onfocus="error_registro()">
                <select class="inputcrear" name="id_etiqueta_fk" id="id_etiqueta_fk" onchange="etiquetas()" onfocus="error_registro()">
                    <option value=""></option>
                     @foreach ($dbEtiquetas as $item)
                        <option value="{{$item->id_et}}">{{$item->etiqueta_et}}</option>
                    @endforeach
                </select>
                <div id="mensaje_registro">
                </div>
                <button class="botoncrear" type="submit" value="CREAR" ><b>CREAR</b></button>
                <input type="hidden" name="_method" value="POST" id="createNote2">
            </form>
        </div>
    </div>
    <div class="modalbox_editar_lugar" id="modalbox_editar_lugar">
        <div class="modalcrear_header">
            <span class="close_crear" onclick="closeModal_editarlugar(); return false;">&times;</span>             
            <h2 class="titulomodal">EDITAR <b>LUGAR</b></h2>
        </div>
        <div class="modaleditar_lugar" id="modaleditar_lugar">
            <form id="formUpdate2" method="post" onsubmit="actualizar2();closeModal_editarlugar();return false;" enctype="multipart/form-data">
                <input class="inputcrear" type="text" name="nombre_lu_e" id="nombre_lu_e" placeholder="Nombre" onfocus="error_registro()">
                <input class="inputcrear" type="text" name="descripcion_lu_e" id="descripcion_lu_e" placeholder="Descripcion" onfocus="error_registro()">
                <input class="inputcrear" type="file" name="foto_e" id="foto_e" placeholder="Foto" onfocus="error_registro()">
                <input class="inputcrear" type="text" name="direccion_di_e" id="direccion_di_e" placeholder="Direccion" onfocus="error_registro()">
                <select class="inputcrear" name="id_etiqueta_fk_e" id="id_etiqueta_fk_e" onchange="etiquetas()" onfocus="error_registro()">
                    <option></option>
                     @foreach ($dbEtiquetas as $item)
                        <option value="{{$item->id_et}}">{{$item->etiqueta_et}}</option>
                    @endforeach
                </select>
                <div id="mensaje_registro">
                </div>
                <button class="botoncrear" type="submit" value="Editar"><b>EDITAR</b></button>
                <input type="hidden" name="id_lu_e" id="idUpdate2">
            </form>
        </div>
    </div>
    <div class="modalbox_editar" id="modalbox_editar">
        <div class="modalcrear_header">
            <span class="close_crear" onclick="closeModal_editar(); return false;">&times;</span>             
            <h2 class="titulomodal">EDITAR <b>USUARIO</b></h2>
        </div>
        <div class="modaleditar" id="modaleditar">
            <form id="formUpdate" method="post" onsubmit="actualizar();closeModal_editar();return false;">
                <input type="hidden" name="_method" value="PUT" id="modifNote">
                <input class="inputcrear" type="text" name="nombre_us" id="nombre_us_e" placeholder="Nombre">
                <input class="inputcrear" type="text" name="apellido1_us" id="apellido1_us_e" placeholder="Apellido 1">
                <input class="inputcrear" type="text" name="apellido2_us" id="apellido2_us_e" placeholder="Apellido 2">
                <div class="hr1">
                    <hr>
                </div>
                <div class="no-cuenta-text">
                    <p>Datos de inicio de sesion</p>
                </div>
                <div class="hr2">
                    <hr>
                </div>
                <input class="inputcrear" type="email" name="email_us" id="email_us_e" placeholder="Usuario">
                <div class="divcontraseña_crear" id="div_password">
                    <input class="contraseñacrear" type="password" name="pass_us" id="pass_us_e" placeholder="Contraseña">
                    <label onchange="mostrar_contraseña_icono2()"><input id="ojo2" class="mostrarcontraseña" type="checkbox" onclick="mostrarContraseña_editar()"><div class="checkbox" id="mostrar_contraseña2"><i class="fa-solid fa-eye-slash"></i></div></label>
                </div>
                <button class="botoncrear" type="submit" value="Editar"><b>EDITAR</b></button>
                <input type="hidden" name="id_us" id="idUpdate">
            </form>
        </div>
    </div>
    <div class="modalbox_crear" id="modalbox_crear">
        <div class="modalcrear_header">
            <span class="close_crear" onclick="closeModal_crear(); return false;">&times;</span>             
            <h2 class="titulomodal">CREAR <b>USUARIO</b></h2>
        </div>
        <div class="modalcrear" id="modalcrear">
            <form onsubmit="crear();closeModal_crear();return false;" method="post" id="formcrear">
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
                <div class="divcontraseña_crear" id="div_password">
                    <input class="contraseñacrear" type="password" name="pass_us" id="pass_us" placeholder="Contraseña">
                    <label onchange="mostrar_contraseña_icono2()"><input id="ojo2" class="mostrarcontraseña" type="checkbox" onclick="mostrarContraseña_crear()"><div class="checkbox" id="mostrar_contraseña2"><i class="fa-solid fa-eye-slash"></i></div></label>
                </div>
                <button class="botoncrear" type="submit" value="Crear"><b>CREAR</b></button>
                <input type="hidden" name="_method" value="POST" id="createNote">
            </form>
        </div>
    </div>
    <div id="message" style="color:green"></div>
</body>
</html>