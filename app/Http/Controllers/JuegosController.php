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


use App\Analisis;
use App\Exceptions\JuegoNoEncontradoException;
use App\Juego;
use Illuminate\Routing\Controller;
use DB;
use App\Http\Requests;
use Request;
use Auth;

class JuegosController extends Controller
{
    /**
     * Muestra un juego a través de su id y su título
     * @param $id del juego
     * @param $titulo del juego
     * @return vista paginas.juego
     * @throws JuegoNoEncontradoException si no encuentra el juego asociado con el id y el título
     */
    public function mostrarJuego($id, $titulo) {
        $juego = Juego::where('lnombre', $titulo)->where('id', $id)->first();
        if (!$juego) {
            throw new JuegoNoEncontradoException;
        } else {
            return view('layouts.paginas.juego', ['id' => Juego::findOrFail($juego->id)]);
        }
    }

    /**
     * Muestra un juego a través de su id redirigiendo a la página /juego/id/lnombre
     * @param $id del juego
     * @return vista paginas.juego
     * @throws JuegoNoEncontradoException si no encuentra el juego asociado con el id y el título
     */
    public function mostrarJuegoDos ($id) {
        $juego = Juego::where('id', $id)->first();
        if (!$juego) {
            throw new JuegoNoEncontradoException;
        } else {
            return redirect("/juego/$id/$juego->lnombre");
        }
    }

    public function mostrarAnalisis($id, $titulo) {
        $analisis = Analisis::where('juego', $id)->first();
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

    public static function devolverJuegos() {
        return $juegos = DB::select("select * from juegos order by id desc");
    }

    public static function devolverJuego ($id) {
        return $juego = DB::table('juegos')->where('id', $id)->first();
    }

    public static function devolverProximosLanzamientos() {
        return $juegos = DB::select("select * from juegos where fecha_lanzamiento > UTC_DATE() order by fecha_lanzamiento ASC");
    }

    public static function devolverPlataformas($juego) {
        return $plataformas = DB::select("select * from categorias where id in (select id_categoria from juegos_categorias where id_juego = $juego)");
    }

}