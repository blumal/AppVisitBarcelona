<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            $dbTags = DB::table('tbl_lugar_tags_favs')
                ->join('tbl_usuario', 'tbl_lugar_tags_favs.id_usuario_fk', '=', 'tbl_usuario.id_us')
                ->join('tbl_tag', 'tbl_lugar_tags_favs.id_tag_fk', '=', 'tbl_tag.id_ta')
                ->select('*')
                ->where('tbl_usuario.id_us','=', '1')
                //->groupBy('tbl_tag.tag_ta')
                ->get();
                //->groupBy('tbl_tag.tag_ta');
            return view('map', compact('dbEtiquetas', 'dbTags'));
       } catch (\Throwable $e) {
            return $e->getMessage();
       }
    }
    //Función orientada a obtener todos los datos de los markets, para posteriormente insertarlos en el mapa mediante ajax, y todos estos datos los pasaremos a JS con la variable generada
    //dbLugar mediante una respuesta JSON
    public function montarMarkets()
    {
        $dbLugar = DB::table('tbl_lugar')
            ->join('tbl_direccion', 'tbl_lugar.id_direccion_fk', '=', 'tbl_direccion.id_di')
            ->join('tbl_etiqueta', 'tbl_lugar.id_etiqueta_fk', '=', 'tbl_etiqueta.id_et')
            ->join('tbl_icono', 'tbl_lugar.id_icono_fk', '=', 'tbl_icono.id_ic')
            ->join('tbl_foto', 'tbl_lugar.id_foto_fk', '=', 'tbl_foto.id_fo')
            ->select('*')
            ->get();
        return response()->json($dbLugar);
    }

    public function filtro(){
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
            $dbFilter = DB::table('tbl_lugar_tags_favs')
                ->join('tbl_usuario', 'tbl_lugar_tags_favs.id_usuario_fk', '=', 'tbl_usuario.id_us')
                ->join('tbl_lugar', 'tbl_lugar_tags_favs.id_lugar_fk', '=', 'tbl_lugar.id_lu')
                ->join('tbl_tag', 'tbl_lugar_tags_favs.id_tag_fk', '=', 'tbl_tag.id_ta')
                ->join('tbl_etiqueta', 'tbl_lugar.id_etiqueta_fk', '=', 'tbl_etiqueta.id_et')
                ->select('tbl_usuario.nombre_us', 'tbl_lugar.id_lu', 'tbl_lugar.nombre_lu', 'tbl_etiqueta.etiqueta_et', 'tbl_tag.tag_ta', 'tbl_lugar_tags_favs.fav_lt')
                //->where('')
                ->get();
            return response()->json($dbFilter);
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function show(Map $map)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function edit(Map $map)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Map $map)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function destroy(Map $map)
    {
        //
    }
}
