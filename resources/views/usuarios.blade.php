<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="js/ajax.js"></script>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<div>
    <form method="post" onsubmit="return false;">
        <input type="hidden" name="_method" value="POST" id="postFiltro">
        <select name="nombre" type="search" id="search" aria-label="Search" onchange="filtro(); return false;">>
            <option value="1">Usuarios</option>
            <option value="2">Lugares</option>
        </select>
     </form>
</div>

<div id="message" style="color:green"></div>
<!--
<div>
    <form method="post" onsubmit="return false;">
        <input type="hidden" name="_method" value="POST" id="postFiltro">
        <div class="form-outline">
           <input type="search" id="search" name="nombre" class="form-control" placeholder="Buscar por titulo..." aria-label="Search" onkeyup="filtro(); return false;"/>
        </div>
     </form>
</div>
-->
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