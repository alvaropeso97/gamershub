<?php

namespace App\Http\Controllers;

use App\Foros;
use App\Foros_temas;
use App\Order;
use Request;
use Illuminate\Support\Facades\Mail;
use DB;

class ForosController extends Controller
{
    public static function mostrarForo($id, $nombre) {
        $foro = DB::table('foros')->where('lnombre', $nombre)->where('id', $id)->first();
        return view('layouts.paginas.foros.foro', ['id' => Foros::findOrFail($foro->id)]);
    }

    public static function mostrarForoId($id) {
        $foro = DB::table('foros')->where('id', $id)->first();
        return redirect("/foro/$id/$foro->lnombre");
    }

    public static function devolverForos() {
        return DB::select("select * from foros");
    }

    public static function contarTemas($foro) {
        $temas = DB::select("select * from foros_temas where respuesta_de = 0 and foro=".$foro);
        return count($temas);
    }

    public static function contarForosRespuestas($foro) {
        $respuestas = DB::select("select * from foros_temas where respuesta_de != 0 and foro=".$foro);
        return count($respuestas);
    }

    public static function mostrarTema($id, $nombre) {
        $tema = DB::table('foros_temas')->where('lnombre', $nombre)->where('id', $id)->first();
        return view('layouts.paginas.foros.tema', ['id' => Foros_temas::findOrFail($tema->id)]);
    }

    public static function devolverUltimaRespuesta($tema) {
        return $respuesta = DB::table('foros_temas')->where('respuesta_de', $tema)->orderby('fecha_creacion')->first();
    }

    public static function contarRespuestas($tema) {
        $respuesta = DB::select("select * from foros_temas where respuesta_de=".$tema);
        return count($respuesta);
    }

    public static function devolverCategoriaTema($tema) {
        return $categoria = DB::select("select * from categorias where id = (select plataforma from foros where id = (select foro from foros_temas where id = ".$tema."))");
    }

    public static function devolverForoTema($tema) {
        return $foro = DB::select("select * from foros where id = (select foro from foros_temas where id=".$tema.")");
    }

    public static function devolverAutor ($id) {
        return DB::table('users')->where('id', $id)->first();
    }

    public static function devolverFecha($fecha) {
        $fecha_n = new \DateTime($fecha);
        return date_format($fecha_n, 'd \d\e F \d\e Y');
    }

    public static function devolverRespuestas($tema) {
        return $temas = DB::select("select * from foros_temas where respuesta_de =".$tema);
    }

    public function store(Request $request, $id)
    {
        Foros_temas::create(Request::all());
        return view('layouts.paginas.foros.tema', ['id' => Foros_temas::findOrFail($id)]);
    }

    public function crearForo(Request $request) {
            \App\Foros::create(Request::all());
            return redirect('/panel/foros')->with('mensaje', 'Has creado un foro correctamente.');
    }

    public function eliminarForo($id) {
        //Eliminar el foro
        DB::table('foros')->where('id', $id)->delete();
        //Eliminar los temas y las respuestas
        DB::table('foros_temas')->where('foro', $id)->delete();
        return redirect('/panel/foros')->with('mensaje', 'El foro, sus temas y respuestas han sido eliminados correctamente de la base de datos.');
    }

    public function mostrarEditarForo($id) {
        return view('layouts.paginas.administracion.edit_for', ['id' => Foros::findOrFail($id)]);
    }

    public function modificarForo($id, \Illuminate\Http\Request $request) {
        //Actualizar la información del foro genérica
        Foros::where('id', $id)
            ->update(['nombre' => $request->get('nombre'),'esjuego' => $request->get('esjuego'),'plataforma' => $request->get('plataforma'),'lnombre' => $request->get('lnombre')]);

        return redirect('/panel/foros')->with('mensaje', 'Has modificado el foro correctamente.');
    }
}