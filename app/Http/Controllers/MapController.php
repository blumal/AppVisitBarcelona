<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MapController extends Controller
{
    public function mostrarUser(){
        $listaUsuario=DB::select('select * from tbl_usuario;');
        $dbEtiquetas=DB::select('select * from tbl_etiqueta;');
        return view('admin', compact('listaUsuario'), compact('dbEtiquetas'));
    }

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
            return view('map', compact(/* 'dbLugar' */'dbEtiquetas', 'dbFavs'));
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
            ->select('*')
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

    // public function (){
    //     $listaUsuario = DB::table('tbl_usuario')->get();
    //     return view('usuarios', compact('listaUsuario'));
    // }

    // Mostrar tablas pagina Admin con AJAX //

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

        try{
            DB::insert('insert into tbl_usuario (nombre_us,apellido1_us,apellido2_us,email_us,pass_us,id_rol_fk) values (?,?,?,?,?,?)',[$request->input('nombre_us'),$request->input('apellido1_us'),$request->input('apellido2_us'),$request->input('email_us'),$request->input('pass_us'),('2')]);  
            return response()->json(array('resultado'=> 'OK'));
        }catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
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
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    public function eliminar2($id){
        //return $id2[0]->id_direccion_fk;
        try {
            DB::beginTransaction();
            $id2=DB::select('select id_direccion_fk from tbl_lugar where id_lu =?',[$id]);
            $id3=DB::select('select id_foto_fk from tbl_lugar where id_lu =?',[$id]);
            $id4=DB::select('select id_icono_fk from tbl_lugar where id_lu =?',[$id]);
            // return $id2[0]->id_direccion_fk;
            DB::table('tbl_lugar')->where('id_lu','=',$id)->delete();
            DB::table('tbl_direccion')->where('id_di','=',$id2[0]->id_direccion_fk)->delete();
            DB::table('tbl_foto')->where('id_fo','=',$id3[0]->id_foto_fk)->delete();
            DB::table('tbl_icono')->where('id_ic','=',$id4[0]->id_icono_fk)->delete();
            DB::commit();
            return response()->json(array('resultado'=> 'OK'));
        }catch(\Exception $th){
            DB::rollBack();
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    public function update(Request $request) {
        try {
            DB::update('update tbl_usuario set nombre_us=?, apellido1_us=?, apellido2_us=?, email_us=?, pass_us =? where id_us=?',[$request->input('nombre_us'),$request->input('apellido1_us'),$request->input('apellido2_us'),$request->input('email_us'),$request->input('pass_us'),$request->input('id_us')]);
            //return response()->json(array('resultado'=> 'NOK: '.$request->input('id_us')));
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }
    public function crear2(Request $request) {
        try{
            DB::beginTransaction();	
            $datos = $request->except('_token');
            $vara =  $request->input('direccion_di');
            $url = "https://geokeo.com/geocode/v1/search.php?q=".urlencode($vara)."&api=78bac5213ba4d91f97794e4e4f5c1543";

            //call api
            $json = file_get_contents($url);
            $json = json_decode($json);
	
		    $address = $json->results[0]->formatted_address;
		    $latitude = $json->results[0]->geometry->location->lat;
		    $longitude = $json->results[0]->geometry->location->lng;
            if($request->hasFile('foto')){
                $ffoto = $request->file('foto')->store('uploads','public');
            }else{
                $datos['foto'] = NULL;
            }
            if($request->hasFile('icono')){
                $iicono = $request->file('icono')->store('uploads','public');
            }else{
                $datos['icono'] = NULL;
            }
            DB::insert('insert into tbl_icono (icono_ic) values(?)',[$iicono]);
            $id5 = DB::select('select id_ic from tbl_icono where icono_ic =?',[$iicono]);
			DB::insert('insert into tbl_foto (foto_fo) values(?)',[$ffoto]);
            $id4 = DB::select('select id_fo from tbl_foto where foto_fo =?',[$ffoto]);
            DB::insert('insert into tbl_direccion (direccion_di,latitud_di,longitud_di) values (?,?,?)',[$request->input('direccion_di'),($latitude),($longitude)]);
            $id3 = DB::select('select id_di from tbl_direccion where direccion_di =?',[$vara]);
            DB::insert('insert into tbl_lugar (nombre_lu,descripcion_lu,id_foto_fk,id_direccion_fk,id_etiqueta_fk,id_icono_fk) values (?,?,?,?,?,?)',[$request->input('nombre_lu'),$request->input('descripcion_lu'),($id4[0]->id_fo),($id3[0]->id_di),$request->input('id_etiqueta_fk'),($id5[0]->id_ic)]);  
            DB::commit();
            
            return response()->json(array('resultado'=> 'OK'));
        }catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }
}