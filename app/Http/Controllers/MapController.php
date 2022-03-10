<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Facade\FlareClient\View;
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
                return redirect('map'); 
            }       
        }
        Session::flash('error_inicio','Las credenciales son incorrectas'); 
        return redirect('login'); 
    }

    public function index()
    {
       try {
            $dbEtiquetas = DB::table('tbl_etiqueta')->select('*')->get();
            //Para saber los lugares favoritos del usuario, añadir el where
            $dbFavs = DB::table('tbl_lugar_tags')
                ->join('tbl_usuario', 'tbl_lugar_tags.id_usuario_fk', '=', 'tbl_usuario.id_us')
                ->join('tbl_lugar', 'tbl_lugar_tags.id_lugar_fk', '=', 'tbl_lugar.id_lu')
                ->select('tbl_lugar.*')
                ->where('tbl_usuario.id_us','=', '2')
                ->get();
            return view('map', compact('dbEtiquetas', 'dbFavs'));
       } catch (\Throwable $e) {
            return $e->getMessage();
       }
    }

    // Función orientada a obtener todos los datos de los markets, para posteriormente insertarlos en el mapa mediante ajax, y todos estos datos los pasaremos a JS con la variable generada
    // dbLugar mediante una respuesta JSON

    public function montarMarkets()
    {
        $dbLugar = DB::table('tbl_lugar')
            ->from('tbl_lugar')
            ->join('tbl_direccion', 'tbl_lugar.id_direccion_fk', '=', 'tbl_direccion.id_di')
            ->join('tbl_etiqueta', 'tbl_lugar.id_etiqueta_fk', '=', 'tbl_etiqueta.id_et')
            ->join('tbl_icono', 'tbl_lugar.id_icono_fk', '=', 'tbl_icono.id_ic')
            ->select('tbl_lugar.*', 'tbl_direccion.*', 'tbl_etiqueta.*', 'tbl_icono.*')
            ->get();
        return response()->json($dbLugar);
    }

    public function etiquetas($id){
        try {
            $dbExtractEtiquetas = "";
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $e) {
            return response()->json(array('resultado'=> 'NOK: '.$e->getMessage()));
        }
    }

    public function favoritos($id){
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // Cerrar sesion (Logout) //

    public function logout(){
        session()->forget('user');
        return redirect('login');
    }

    // Registrar usuario (Crear usuario) //

    public function registro(Request $request){
        try {
            $email = $request->input('email');
            DB::insert('insert into tbl_usuario (nombre_us,apellido1_us,apellido2_us,email_us,pass_us,id_rol_fk) values (?,?,?,?,?,?)',[$request->input('nombre_us'),$request->input('apellido1_us'),$request->input('apellido2_us'),$request->input('email_us'),$request->input('pass_us'),'2']);
            return redirect('login');
            Session::flash('exito_registro','Usuario registrado correctamente');           
        } catch (\Throwable $th) {
            return redirect('login');
            Session::flash('error_registro','Error al registrar su usuario'); 
        }
    }

    // Entrar en la pagina Admin //

    public function admin(){
        $lista = DB::table('tbl_lugar')->get();
        return view('admin', compact('lista'));
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

    public function crear(Request $request){
        try {
            $email = $request->input('email');
            DB::insert('insert into tbl_usuario (email_us,pass_us,nombre_us,apellido1_us,apellido2_us,id_rol_fk) values (?,?,?,?,?,?)',[$request->input('nombre_us'),$request->input('email_us'),$request->input('pass_us'),$request->input('apellido1_us'),$request->input('apellido2_us'),'2']);
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


