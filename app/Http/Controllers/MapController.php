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
            //Para saber los lugares favoritos del usuario, añadir el where
            $dbFavs = DB::table('tbl_lugar_tags')
                ->join('tbl_usuario', 'tbl_lugar_tags.id_usuario_fk', '=', 'tbl_usuario.id_us')
                ->join('tbl_lugar', 'tbl_lugar_tags.id_lugar_fk', '=', 'tbl_lugar.id_lu')
                ->select('tbl_lugar.*')
                ->where('tbl_usuario.id_us','=', '1')
                ->get();
            return view('map', compact('dbEtiquetas', 'dbFavs'));
       } catch (\Throwable $e) {
            return $e->getMessage();
       }
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
