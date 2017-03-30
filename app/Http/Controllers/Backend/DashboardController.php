<?php

namespace App\Http\Controllers\Backend;

use App\Articulo;
use App\Comentario;
use App\Http\Controllers\Controller;
use App\Juego;
use App\User;

class DashboardController extends Controller
{
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