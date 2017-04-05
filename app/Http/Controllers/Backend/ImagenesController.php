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

use App\Http\Controllers\Controller;
use App\Imagen;
use Illuminate\Http\Request;

/**
 * Esta clase contiene lo necesario para gestionar imágenes desde el backend de la aplicación
 * Class ImagenesController
 * @package App\Http\Controllers\Backend
 */
class ImagenesController extends Controller
{
    /**
     * Muestra la vista que contiene un listado con todas las imágenes almacenadas en la base de datos e información
     * relevante de las mismas
     * @return vista backend.imagenes con información de las imágenes almacenadas
     */
    public function show() {
        $imagenes = Imagen::all();
        return view('backend.imagenes')->with(['imagenes' => $imagenes]);
    }
}