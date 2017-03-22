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


use Illuminate\Routing\Controller;
use DB;
use Illuminate\Http\Request;

class EtiquetasController extends Controller
{
    public static function devolverArticulosEtiqueta($etiqueta) {
        $results = DB::select("select cod_art from etiquetas where nombre LIKE '".$etiqueta."'");
        $data = array();
        foreach ($results as $result) {
            $data[] = (array)$result->cod_art;
        }
        return $data;
    }
}