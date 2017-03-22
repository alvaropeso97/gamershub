<?php
/**
 *           ___                       _  _ _   _ ___
 *          / __|__ _ _ __  ___ _ _ __| || | | | | _ )
 *         | (_ / _` | '  \/ -_) '_(_-< __ | |_| | _ \
 *          \___\__,_|_|_|_\___|_| /__/_||_|\___/|___/
 *
 * TODOS LOS DERECHOS RESERVADOS, ÁLVARO PESO GARCÍA y GAMERSHUB
 *
 */

namespace App\Http\Controllers;


use App\Juego;
use Illuminate\Routing\Controller;
use DB;
use App\Http\Requests;
use Request;
use Auth;

class JuegosController extends Controller
{
    public function mostrarJuego($id, $titulo) {
        $juego = DB::table('juegos')->where('lnombre', $titulo)->where('id', $id)->first();
        return view('layouts.paginas.juego', ['id' => Juego::findOrFail($juego->id)]);
    }

    public function mostrarAnalisis($id, $titulo) {
        $analisis = DB::table('analisis')->where('juego', $id)->first();
        $juego = DB::table('juegos')->where('lnombre', $titulo)->where('id', $id)->first();
        if (count($analisis) == 1) { //El juego tiene análisis
            $articulo = DB::table('articulos')->where('tipo', 'ana')->where('juego_rel', $id)->first();
            return view('layouts.paginas.juego_analisis', ['id' => Juego::findOrFail($id), 'analisis' => $analisis, 'articulo' => $articulo]);
        } else {
            return redirect("/juego/$id/$juego->lnombre")->with('mensaje', 'Este juego todavía no ha sido analizado.');
        }
    }

    public function mostrarNoticias($id, $titulo) {
        $juego = DB::table('juegos')->where('lnombre', $titulo)->where('id', $id)->first();
        $noticias = DB::table('articulos')->where('juego_rel', $id)->where('tipo', 'art')->paginate(9);
        return view('layouts.paginas.juego_noticias', ['noticias' => $noticias, 'juego' => $juego]);
    }

    public function mostrarJuegoDos ($id) {
        $juego = DB::table('juegos')->where('id', $id)->first();
        return redirect("/juego/$id/$juego->lnombre");
    }

    public static function devolverJuegos() {
        return $juegos = DB::select("select * from juegos order by id desc");
    }

    public static function devolverJuego ($id) {
        return $juego = DB::table('juegos')->where('id', $id)->first();
    }

    public static function devolverNombre ($id) {
        $juego = DB::table('juegos')->where('id', $id)->first();
        return $juego->titulo;
    }

    public static function devolverProximosLanzamientos() {
        return $juegos = DB::select("select * from juegos where fecha_lanzamiento > UTC_DATE() order by fecha_lanzamiento ASC");
    }

    public static function devolverPlataformas($juego) {
        return $plataformas = DB::select("select * from categorias where id in (select id_categoria from juegos_categorias where id_juego = $juego)");
    }

    public function nuevoJuego() {
        if (Auth::user()->acceso == 2) { //Los moderadores no pueden crear juegos
            return redirect('/panel/juegos')->with('error', 'No tienes los permisos para crear juegos.');
        } else {
            return view('layouts.paginas.administracion.nuev_jue');
        }
    }

    public function store(\Illuminate\Http\Request $request)
    {
        Juego::create(Request::all());

        //Devolver id_art
        $juego = DB::table('juegos')->orderBy('id', 'DESC')->first();

        //Establecer el link
        $link = ArticulosController::sanear_string($juego->titulo);
        Juego::where('id', $juego->id)
            ->update(['lnombre' => $link]);

        //Asociar las categorias a el juego
        foreach ($request->get('plataformas') as $plataforma) {
            DB::table('juegos_categorias')->insert([
                ['id_categoria' => $plataforma, 'id_juego' => $juego->id]
            ]);
        }
        return redirect('/panel/juegos')->with('mensaje', 'Has añadido un nuevo juego a la base de datos.');
    }

    public function eliminarJuego($id) {
        if (Auth::user()->acceso == 2) { //Los moderadores no pueden eliminar juegos
            return redirect('/panel/juegos')->with('error', 'No tienes los permisos para eliminar juegos.');
        } else {
            //Eliminar juego
            DB::table('juegos')->where('id', $id)->delete();
            //Eliminar asociaciones con las categorías
            DB::table('juegos_categorias')->where('id_juego', $id)->delete();
            return redirect('/panel/juegos')->with('mensaje', 'El juego ha sido eliminado correctamente de la base de datos.');
        }
    }

    public function mostrarEditarJuego($id) {
        return view('layouts.paginas.administracion.edit_jue', ['id' => Juego::findOrFail($id)]);
    }

    public function modificarJuego($id, \Illuminate\Http\Request $request) {
        //Obtener juego
        $juego = DB::table('juegos')->where('id', $id)->first();

        //Actualizar la información del juego genérica
        Juego::where('id', $id)
            ->update(['titulo' => $request->get('titulo'),'descripcion' => $request->get('descripcion'),'dispo_en' => $request->get('dispo_en'),
                'desarrollador' => $request->get('desarrollador'), 'distribuidor' => $request->get('distribuidor'),'jugadores' => $request->get('jugadores'),
                'duracion' => $request->get('duracion'),'idioma' => $request->get('idoma'), 'fecha_lanzamiento' => $request->get('fecha_lanzamiento'), 'lnombre' => $request->get('lnombre')]);

        //Eliminar las categorias
        DB::table('juegos_categorias')->where('id_juego', $id)->delete();

        //Volver a crear las categorias
        foreach ($request->get('plataformas') as $plataforma) {
            DB::table('juegos_categorias')->insert([
                ['id_juego' => $juego->id, 'id_categoria' => $plataforma]
            ]);
        }

        return redirect('/panel/juegos')->with('mensaje', 'Has modificado el juego correctamente.');
    }

}