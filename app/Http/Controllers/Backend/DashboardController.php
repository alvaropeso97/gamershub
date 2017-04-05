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

namespace App\Http\Controllers\Backend;

use App\Articulo;
use App\Comentario;
use App\Http\Controllers\Controller;
use App\Juego;
use App\User;

/**
 * Esta clase contiene lo necesario para manipular lo información de la página principal del backend
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class DashboardController extends Controller
{

    /**
     * Carga las estadísticas de la aplicación en la matriz $estadisticas además de las 10 últimas noticias y de
     * los próximos lanzamientos y posteriormente muestra la vista backend.dashboard con la información
     * @return $this
     */
    public static function show() {
        $estadisticas = array (
            "usuarios"  => count(User::all()),
            "articulos" => count(Articulo::all()),
            "comentarios"   => count(Comentario::all())
        );
        $noticias_recientes = Articulo::all()->sortByDesc('id')->take(10);
        $proximos_lanzamientos = Juego::all()->sortByDesc('id');
        return view('backend.dashboard')->with(['estadisticas' => $estadisticas, 'noticias_recientes' => $noticias_recientes, 'proximos_lanzamientos' => $proximos_lanzamientos]);
    }
}