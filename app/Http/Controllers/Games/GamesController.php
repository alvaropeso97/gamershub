<?php
/**
 *  ____  _             _     _ _
 * |  _ \| | __ _ _   _| |__ (_) |_   ___  ___
 * | |_) | |/ _` | | | | '_ \| | __| / _ \/ __|
 * |  __/| | (_| | |_| | |_) | | |_ |  __/\__ \
 * |_|   |_|\__,_|\__, |_.__/|_|\__(_)___||___/
 *                |___/
 *
 * TODOS LOS DERECHOS RESERVADOS ÁLVARO PESO GARCÍA
 * WWW.PLAYBIT.ES
 * CONTACTO@PLAYBIT.ES
 * ALVARO.PESO@PLAYBIT.ES
 * @PlaybitES
 * 2017
 *
 */

namespace App\Http\Controllers;


use App\Review;
use App\Exceptions\JuegoNoEncontradoException;
use App\Game;
use Illuminate\Routing\Controller;
use DB;
use App\Http\Requests;
use Request;
use Auth;

class GamesController extends Controller
{
    /**
     * Muestra un juego a través de su id y su título
     * @param $id del juego
     * @param $titulo del juego
     * @return vista paginas.juego
     * @throws JuegoNoEncontradoException si no encuentra el juego asociado con el id y el título
     */
    public function mostrarJuego($id, $titulo) {
        $juego = Game::where('lnombre', $titulo)->where('id', $id)->first();
        if (!$juego) {
            throw new JuegoNoEncontradoException;
        } else {
            return view('layouts.paginas.juego', ['id' => Game::findOrFail($juego->id)]);
        }
    }

    /**
     * Muestra un juego a través de su id redirigiendo a la página /juego/id/lnombre
     * @param $id del juego
     * @return vista paginas.juego
     * @throws JuegoNoEncontradoException si no encuentra el juego asociado con el id y el título
     */
    public function mostrarJuegoDos ($id) {
        $juego = Game::where('id', $id)->first();
        if (!$juego) {
            throw new JuegoNoEncontradoException;
        } else {
            return redirect("/juego/$id/$juego->lnombre");
        }
    }

    public function mostrarAnalisis($id, $titulo) {
        $analisis = Review::where('juego', $id)->first();
        $juego = DB::table('juegos')->where('lnombre', $titulo)->where('id', $id)->first();
        if (count($analisis) == 1) { //El juego tiene análisis
            $articulo = DB::table('articulos')->where('tipo', 'ana')->where('juego_rel', $id)->first();
            return view('layouts.paginas.juego_analisis', ['id' => Game::findOrFail($id), 'analisis' => $analisis, 'articulo' => $articulo]);
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
        return $juegos = DB::select("select * from games where release_date > UTC_DATE() order by release_date ASC");
    }

    public static function devolverPlataformas($juego) {
        return $plataformas = DB::select("select * from categorias where id in (select id_categoria from juegos_categorias where id_juego = $juego)");
    }

}