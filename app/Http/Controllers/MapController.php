<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Mail\EnviarMensaje;
use Illuminate\Support\Facades\Mail;

class MapController extends Controller
{

    //------------------------------------------------------------ FUNCIONES LOGIN --------------------------------------------------------------\\
    
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

    // Cerrar sesion (Logout) //

    public function logout(){
        session()->forget('user');
        return redirect('login');
    }

    //---------------------------------------------------------- FUNCIONES MOSTRAR ADMIN ------------------------------------------------------------\\

    public function admin(){
        $lista = DB::table('tbl_lugar')->get();
        return view('admin', compact('lista'));
    }

    public function mostrarUser(){
        $listaUsuario=DB::select('select * from tbl_usuario where id_rol_fk=2;');
        $dbEtiquetas=DB::select('select * from tbl_etiqueta;');
        return view('admin', compact('listaUsuario'), compact('dbEtiquetas'));
    }

    // Mostrar tablas pagina Admin con AJAX //

    public function show(Request $request)
    {
        $valor = $request->input('nombre');
        if ($valor == 1) {
        $listaUsuario= DB::select('select * from tbl_usuario where id_rol_fk=2;');
        return response()->json($listaUsuario);
        }
        else {
            $listaLugar= DB::select('select * from tbl_lugar inner join tbl_direccion on tbl_lugar.id_direccion_fk=tbl_direccion.id_di');
            return response()->json($listaLugar);
        }
    }

    //---------------------------------------------------------- FUNCIONES MOSTRAR MAPA ------------------------------------------------------------\\

    public function index()
    {
       try {
            $dbEtiquetas = DB::table('tbl_etiqueta')->select('*')->get();
            //Query de consulta de tags del usuario
            /* SELECT tbl_usuario.nombre_us, tbl_tag.tag_ta
            FROM tbl_lugar_tags_favs 
            INNER JOIN tbl_usuario ON tbl_lugar_tags_favs.id_usuario_fk = tbl_usuario.id_us
            INNER JOIN tbl_tag ON tbl_lugar_tags_favs.id_tag_fk = tbl_tag.id_ta
            WHERE tbl_usuario.id_us = 1
            GROUP BY tbl_tag.tag_ta */
            //Error Group By
            //https://www.feynmandigital.com/problemas-con-group-by-en-laravel-eloquent.html
            $dbTags = DB::table('tbl_lugar_tags_favs')
                ->join('tbl_usuario', 'tbl_lugar_tags_favs.id_usuario_fk', '=', 'tbl_usuario.id_us')
                ->join('tbl_tag', 'tbl_lugar_tags_favs.id_tag_fk', '=', 'tbl_tag.id_ta')
                ->select('*')
                ->where('tbl_usuario.id_us','=', '1')
                ->groupBy('tbl_tag.tag_ta')
                ->get();
            return view('map', compact('dbEtiquetas', 'dbTags'));
       } catch (\Throwable $e) {
            return $e->getMessage();
       }
    }

    // Función orientada a obtener todos los datos de los markets, para posteriormente insertarlos en el mapa mediante ajax, y todos estos datos los pasaremos a JS con la variable generada
    // dbLugar mediante una respuesta JSON

    public function montarMarkets()
    {
        $dbLugar = DB::table('tbl_lugar')
            ->join('tbl_direccion', 'tbl_lugar.id_direccion_fk', '=', 'tbl_direccion.id_di')
            ->join('tbl_etiqueta', 'tbl_lugar.id_etiqueta_fk', '=', 'tbl_etiqueta.id_et')
            ->join('tbl_icono', 'tbl_lugar.id_icono_fk', '=', 'tbl_icono.id_ic')
            ->join('tbl_foto', 'tbl_lugar.id_foto_fk', '=', 'tbl_foto.id_fo')
            ->select('tbl_lugar.*','tbl_etiqueta.etiqueta_et','tbl_direccion.direccion_di','tbl_direccion.longitud_di','tbl_direccion.latitud_di','tbl_icono.tipo_icono_ic','tbl_icono.path_ic','tbl_foto.foto_fo')
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

    public function filtro(Request $request){
        /* SELECT tbl_usuario.nombre_us, tbl_lugar.id_lu, tbl_lugar.nombre_lu, tbl_etiqueta.etiqueta_et, tbl_tag.tag_ta, tbl_lugar_tags_favs.fav_lt
        FROM tbl_lugar_tags_favs 
        INNER JOIN tbl_usuario ON tbl_lugar_tags_favs.id_usuario_fk = tbl_usuario.id_us 
        INNER JOIN tbl_lugar ON tbl_lugar_tags_favs.id_lugar_fk = tbl_lugar.id_lu
        INNER JOIN tbl_tag ON tbl_lugar_tags_favs.id_tag_fk = tbl_tag.id_ta
        INNER JOIN tbl_etiqueta ON tbl_lugar.id_etiqueta_fk = tbl_etiqueta.id_et
        WHERE
        tbl_etiqueta.id_et = 8
        AND tbl_usuario.id_us = 1 */

        try {

            $dbFiltro = DB::select('SELECT *
                FROM tbl_lugar_tags_favs 
                INNER JOIN tbl_usuario ON tbl_lugar_tags_favs.id_usuario_fk = tbl_usuario.id_us 
                INNER JOIN tbl_lugar ON tbl_lugar_tags_favs.id_lugar_fk = tbl_lugar.id_lu
                INNER JOIN tbl_tag ON tbl_lugar_tags_favs.id_tag_fk = tbl_tag.id_ta
                INNER JOIN tbl_etiqueta ON tbl_lugar.id_etiqueta_fk = tbl_etiqueta.id_et
                INNER JOIN tbl_direccion ON tbl_lugar.id_direccion_fk = tbl_direccion.id_di
                INNER JOIN tbl_icono ON tbl_lugar.id_icono_fk = tbl_icono.id_ic
                INNER JOIN tbl_foto ON tbl_lugar.id_foto_fk = tbl_foto.id_fo
                WHERE tbl_etiqueta.id_et LIKE ? AND tbl_tag.id_ta LIKE ? AND tbl_lugar_tags_favs.fav_lt LIKE ? AND tbl_usuario.id_us = 1',
                ['%'.$request->input('etiqueta_et').'%', '%'.$request->input('tag_ta').'%', '%'.$request->input('fav').'%']);

                /* WHERE tbl_etiqueta.id_et LIKE ? AND tbl_tag.id_ta LIKE ? AND tbl_lugar_tags_favs.fav_lt LIKE ? AND tbl_usuario.id_us = 1',
                ['%'.$request->input('etiqueta_et').'%', '%'.$request->input('tag_ta').'%', '%'.$request->input('fav').'%']); */

                
            /* $dbFilter = DB::table('tbl_lugar_tags_favs')
                ->join('tbl_usuario', 'tbl_lugar_tags_favs.id_usuario_fk', '=', 'tbl_usuario.id_us')
                ->join('tbl_lugar', 'tbl_lugar_tags_favs.id_lugar_fk', '=', 'tbl_lugar.id_lu')
                ->join('tbl_tag', 'tbl_lugar_tags_favs.id_tag_fk', '=', 'tbl_tag.id_ta')
                ->join('tbl_etiqueta', 'tbl_lugar.id_etiqueta_fk', '=', 'tbl_etiqueta.id_et')
                ->select('tbl_usuario.nombre_us', 'tbl_lugar.id_lu', 'tbl_lugar.nombre_lu', 'tbl_etiqueta.etiqueta_et', 'tbl_tag.tag_ta', 'tbl_lugar_tags_favs.fav_lt')
                //->where('')
                ->get(); */
            return response()->json($dbFiltro);
        } catch (\Throwable $e) {
            return response()->json(array('resultado'=> 'NOK: '.$e->getMessage()));
        }
    }

    //---------------------------------------------------------- FUNCIONES LOGIN EXTRA ------------------------------------------------------------\\

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

    // Enviar correo al usuario //

    public function envio(Request $request){           
        $correo=$request->input('correo');
        $pass = DB::select('select pass_us from tbl_usuario where email_us=?', [$correo]);
        $sub = "Contraseña olvidada";
        $msj = "Su contraseña es ".$pass[0]->pass_us;
        $datos = array('message'=>$msj);
        $enviar = new EnviarMensaje($datos);
        $enviar->sub = $sub;
        Mail::to($correo)->send($enviar);
        return redirect('login');
        Session::flash('correo_enviado','Correo enviado correctamente'); 
}

    //------------------------------------------------------------ FUNCIONES CREAR --------------------------------------------------------------\\

    // Crear usuario //

    public function crear(Request $request){

        try{
            DB::insert('insert into tbl_usuario (nombre_us,apellido1_us,apellido2_us,email_us,pass_us,id_rol_fk) values (?,?,?,?,?,?)',[$request->input('nombre_us'),$request->input('apellido1_us'),$request->input('apellido2_us'),$request->input('email_us'),$request->input('pass_us'),('2')]);  
            return response()->json(array('resultado'=> 'OK'));
        }catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    //------------------------------------------------------------ FUNCIONES MODIFICAR --------------------------------------------------------------\\

    // Modificar usuario //

    public function update(Request $request) {
        try {
            DB::update('update tbl_usuario set nombre_us=?, apellido1_us=?, apellido2_us=?, email_us=?, pass_us =? where id_us=?',[$request->input('nombre_us'),$request->input('apellido1_us'),$request->input('apellido2_us'),$request->input('email_us'),$request->input('pass_us'),$request->input('id_us')]);
            //return response()->json(array('resultado'=> 'NOK: '.$request->input('id_us')));
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    //------------------------------------------------------------ FUNCIONES ELIMINAR --------------------------------------------------------------\\

    // Eliminar usuario //

    public function eliminar($id){
        try {
            $lista=DB::table('tbl_usuario')->where('id_us','=',$id)->delete();
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    // Eliminar ubicacion //

    public function eliminar2($id){
        //return $id2[0]->id_direccion_fk;
        try {
            DB::beginTransaction();
            $id2=DB::select('select id_direccion_fk from tbl_lugar where id_lu =?',[$id]);
            // return $id2[0]->id_direccion_fk;
            DB::table('tbl_lugar')->where('id_lu','=',$id)->delete();
            DB::table('tbl_direccion')->where('id_di','=',$id2[0]->id_direccion_fk)->delete();
            DB::commit();
            return response()->json(array('resultado'=> 'OK'));
        }catch(\Exception $th){
            DB::rollBack();
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

}