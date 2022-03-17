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
  
    //Función orientada a obtener todos los datos de los markets, para posteriormente insertarlos en el mapa mediante ajax, y todos estos datos los pasaremos a JS con la variable generada
    //dbLugar mediante una respuesta JSON
  
    public function montarMarkets(Request $request)
    {
        //if ($request->input('etiqueta_et') == '' && $request->input('favoritos') == false && $request->input('tag_ta') == ''){
            $dbLugar = DB::table('tbl_lugar')
                ->join('tbl_direccion', 'tbl_lugar.id_direccion_fk', '=', 'tbl_direccion.id_di')
                ->join('tbl_etiqueta', 'tbl_lugar.id_etiqueta_fk', '=', 'tbl_etiqueta.id_et')
                ->join('tbl_icono', 'tbl_lugar.id_icono_fk', '=', 'tbl_icono.id_ic')
                ->join('tbl_foto', 'tbl_lugar.id_foto_fk', '=', 'tbl_foto.id_fo')
                ->select('*')
                ->get();
            return response()->json($dbLugar);
        /* }else{
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
                ['%'.$request->input('etiqueta_et').'%', '%'.$request->input('tag_ta').'%', '%'.$request->input('favoritos').'%']);

            /* $dbFilter = DB::table('tbl_lugar_tags_favs')
                ->join('tbl_usuario', 'tbl_lugar_tags_favs.id_usuario_fk', '=', 'tbl_usuario.id_us')
                ->join('tbl_lugar', 'tbl_lugar_tags_favs.id_lugar_fk', '=', 'tbl_lugar.id_lu')
                ->join('tbl_tag', 'tbl_lugar_tags_favs.id_tag_fk', '=', 'tbl_tag.id_ta')
                ->join('tbl_etiqueta', 'tbl_lugar.id_etiqueta_fk', '=', 'tbl_etiqueta.id_et')
                ->select('*')
                //->select('tbl_usuario.nombre_us', 'tbl_lugar.id_lu', 'tbl_lugar.nombre_lu', 'tbl_etiqueta.etiqueta_et', 'tbl_tag.tag_ta', 'tbl_lugar_tags_favs.fav_lt')
                ->where('tbl_etiqueta.id_et', 'like', '%'.$request->input('etiqueta_et').'%')
                ->where('tbl_usuario.id_us = 1')
                ->get(); */
            //return response()->json($dbFiltro); */
        //}
        
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
            $listaLugar= DB::select('select * from tbl_lugar inner join tbl_direccion on tbl_lugar.id_direccion_fk=tbl_direccion.id_di inner join tbl_foto on tbl_lugar.id_foto_fk=tbl_foto.id_fo inner join tbl_icono on tbl_lugar.id_icono_fk=tbl_icono.id_ic');
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
    public function update2(Request $request){
        try {
            DB::beginTransaction();	
            $id6 = DB::select('select id_foto_fk from tbl_lugar where id_lu=?',[$request->input('id_lu_e')]);
            $id8 = DB::select('select id_icono_fk from tbl_lugar where id_lu=?',[$request->input('id_lu_e')]);
            $datos = $request->except('_token');
            $vara =  $request->input('direccion_di_e');
            $url = "https://geokeo.com/geocode/v1/search.php?q=".urlencode($vara)."&api=78bac5213ba4d91f97794e4e4f5c1543";

            //call api
            $json = file_get_contents($url);
            $json = json_decode($json);
            
		    $address = $json->results[0]->formatted_address;
		    $latitude = $json->results[0]->geometry->location->lat;
		    $longitude = $json->results[0]->geometry->location->lng;
            if ($request->hasFile('foto_e')) {
                $foto = DB::select('select foto_fo from tbl_foto where id_fo =?',[$id6[0]->id_foto_fk]);
                if ($foto[0]->foto_fo != null) {
                    Storage::delete('public/'.$foto[0]->foto_fo);
                }
                $ffoto2 = $request->file('foto_e')->store('uploads','public');
            }else{
                $foto = DB::select('select foto_fo from tbl_foto where id_fo =?',[$id6[0]->id_foto_fk]);
                $ffoto2 = $foto[0]->foto_fo;
            }
            if ($request->hasFile('icono_e')) {
                $icono = DB::select('select icono_ic from tbl_icono where id_ic =?',[$id8[0]->id_icono_fk]);
                if ($icono[0]->icono_ic != null) {
                    Storage::delete('public/'.$icono[0]->icono_ic);
                }
                $iicono2 = $request->file('icono_e')->store('uploads','public');
            }else{
                $icono = DB::select('select icono_ic from tbl_icono where id_ic =?',[$id8[0]->id_icono_fk]);
                $iicono2 = $icono[0]->icono_ic;
            }
            DB::update('update tbl_foto set foto_fo=? where id_fo=?',[$ffoto2,$id6[0]->id_foto_fk]);
            $id4 = DB::select('select id_fo from tbl_foto where foto_fo =?',[$ffoto2]);
            DB::update('update tbl_icono set icono_ic=? where id_ic=?',[$iicono2,$id8[0]->id_icono_fk]);
            $id9 = DB::select('select id_ic from tbl_icono where icono_ic =?',[$iicono2]);
            $id7 = DB::select('select id_direccion_fk from tbl_lugar where id_lu =?',[$request->input('id_lu_e')]);
            DB::update('update tbl_direccion set direccion_di=?, latitud_di=?, longitud_di=? where id_di=?',[$request->input('direccion_di_e'),($latitude),($longitude),($id7[0]->id_direccion_fk)]);
            $id3 = DB::select('select id_di from tbl_direccion where direccion_di =?',[$vara]);
            DB::update('update tbl_lugar set nombre_lu=?, descripcion_lu=?, id_foto_fk=?, id_direccion_fk=?, id_etiqueta_fk =?, id_icono_fk=? where id_lu=?',[$request->input('nombre_lu_e'),$request->input('descripcion_lu_e'),($id4[0]->id_fo),($id3[0]->id_di),$request->input('id_etiqueta_fk_e'),($id9[0]->id_ic),($request->input('id_lu_e'))]);
            //return response()->json(array('resultado'=> 'NOK: '.$request->input('id_us')));
            DB::commit();
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            DB::rollBack();
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