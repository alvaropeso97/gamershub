<?php

namespace App\Http\Controllers\Backend;

use App\ConfigGeneral;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigGeneralController extends Controller
{
    public function show() {
        $configuracion_general = ConfigGeneral::first();
        return view('backend.configuracion')->with(['configuracion_general' => $configuracion_general]);
    }
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