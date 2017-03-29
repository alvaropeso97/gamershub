<?php

namespace App\Http\Controllers;

use App\ConfigGeneral;
use Illuminate\Http\Request;

class ConfigGeneralController extends Controller
{
    public function update(Request $request) {
        $configuracion_general = ConfigGeneral::first();
        $configuracion_general->nombre_aplicacion = $request->get('nombre_aplicacion');
        $configuracion_general->titulo_inicio = $request->get('titulo_inicio');
        $configuracion_general->imagen_fondo = $request->get('imagen_fondo');
        $configuracion_general->noticias_dest = $request->get('noticias_dest');
        $configuracion_general->copyright = $request->get('copyright');
        $configuracion_general->save();
        return redirect('/backend/configuracion');
    }
}
