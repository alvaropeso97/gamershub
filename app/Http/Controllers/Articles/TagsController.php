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

namespace App\Http\Controllers\Articles;


use Illuminate\Routing\Controller;
use DB;

class TagsController extends Controller
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