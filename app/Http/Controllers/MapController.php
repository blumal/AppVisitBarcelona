<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MapController extends Controller
{

    // Entrar al login //

    public function login(){
        return view('login');
      }

    // Verificar si el usuario es Admin o Customer //

    public function loginpost(Request $request){
        $email = $request->input('email_us');
        $password = $request->input('pass_us');
        $user=DB::select('select * from tbl_usuario where email_us=? and pass_us=?',[$email,$password]);
        if (count($user)==1){
            if($user[0]->id_rol_fk==1){
                session(['user' => $user[0]->nombre_us]);
                session(['tipo' => $user[0]->id_rol_fk]);
                return redirect('admin'); 
            } else {
                session(['user' => $user[0]->nombre_us]);
                session(['tipo' => $user[0]->id_rol_fk]);
                return redirect('index'); 
            }       
        }
        Session::flash('error_inicio','Las credenciales son incorrectas'); 
        return redirect('login'); 
    }

    // Cerrar sesion (Logout) //

    public function logout(){
        session()->forget('user');
        return redirect('login');
    }

    // Registrar usuario (Crear usuario) //

    public function registro(Request $request){
        try {
            $datos = $request->except('_token');
            DB::table('tbl_usuario')->insertGetId(["nombre_us"=>$datos['nombre_us'],"apellido1_us"=>$datos['apellido1_us'],"apellido2_us"=>$datos['apellido2_us'],"email_us"=>$datos['email_us'],"pass_us"=>$datos['pass_us']]);
            return redirect('login');
            Session::flash('exito_registro','Usuario registrado correctamente');          
        } catch (\Throwable $th) {
            return redirect('login');
            Session::flash('error_registro','Error al registrar el usuario'); 
        }
    }

    // Entrar en la pagina Admin //

    public function admin(){
        $lista = DB::table('tbl_lugar')->get();
        return view('admin', compact('lista'));
    }

    public function mostrarUser(){
        $listaUsuario = DB::table('tbl_usuario')->get();
        return view('usuarios', compact('listaUsuario'));
    }

    public function show(Request $request)
    {
        $valor = $request->input('nombre');
        if ($valor == 1) {
        $listaUsuario= DB::select('select * from tbl_usuario');
        return response()->json($listaUsuario);
        }
        else {
            $listaLugar= DB::select('select * from tbl_lugar inner join tbl_direccion on tbl_lugar.id_direccion_fk=tbl_direccion.id_di');
            return response()->json($listaLugar);
        }
    }

    // Crear usuario //

    public function crear(){
        try {
            $email = $request->input('email');
            DB::insert('insert into tbl_usuario (email_su,pass_su,nombre_su,apellido1_su,apellido2,tipo_rol) values (?,?,?,?,?,?)',[$request->input('email_us'),$request->input('pass_us'),$request->input('apellido1_us'),$request->input('apellido2')('2')]);
            return redirect('admin');
            Session::flash('exito_crear','Usuario creado correctamente');           
        } catch (\Throwable $th) {
            return redirect('admin');
            Session::flash('error_crear','Error al crear el usuario'); 
        }
    }

    // Moficiar usuario //

    public function modificar($id){
        $lista=DB::table('tbl_usuario')->where('id_us','=',$id)->first();
        return view('modificar',compact('lista'));
    }

    public function modificarPut(Request $request){
        try {
            $datos=$request->except('_token','_method');
            DB::table('tbl_usuario')->where('id_us','=',$datos['id_us'])->update($datos);
            return redirect('admin');
        } catch (\Throwable $th) {
            return redirect('admin');
            Session::flash('error_moficiar','Error al modificar el usuario'); 
        }
    }

    // Eliminar usuario //

    public function eliminar($id){
        try {
            $lista=DB::table('tbl_usuario')->where('id_us','=',$id)->delete();
            return redirect('admin');
            Session::flash('exito_eliminar','Usuario eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect('admin');
            Session::flash('error_eliminar','Error al eliminar el usuario'); 
        }
    }

}


