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

use App\ConfigGeneral;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Esta clase contiene lo necesario para gestionar la configuración general de la aplicación
 * Class ConfigGeneralController
 * @package App\Http\Controllers\Backend
 */
class ConfigGeneralController extends Controller
{
    /**
     * Muestra la vista que contiene el formulario para configurar los parámetros de la aplicación
     * @return $this
     */
    public function show() {
        $configuracion_general = ConfigGeneral::first();
        return view('backend.configuracion')->with(['configuracion_general' => $configuracion_general]);
    }

    /**
     * Recibe los datos del formulario y modifica los parámetros de la aplicación
     * @param Request $request datos del formulario
     * @return \Illuminate\Http\RedirectResponse página de configuración general con un mensaje
     */
    public function update(Request $request) {
        $configuracion_general = ConfigGeneral::first();
        $configuracion_general->nombre_aplicacion = $request->get('nombre_aplicacion');
        $configuracion_general->titulo_inicio = $request->get('titulo_inicio');
        $configuracion_general->imagen_fondo = $request->get('imagen_fondo');
        $configuracion_general->noticias_dest = $request->get('noticias_dest');
        $configuracion_general->copyright = $request->get('copyright');
        $configuracion_general->save();
        return redirect('/backend/configuracion')->with('mensaje', 'Configuración actualizada');
    }
}