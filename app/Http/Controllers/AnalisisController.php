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
use Illuminate\Routing\Controller;
use DB;
use Illuminate\Http\Request;
use Auth;

class AnalisisController extends Controller
{
    public static function e() {
        // connect to local server, authenticate and spawn an object for the virtual server on port 9987
        $ts3_VirtualServer = TeamSpeak3::factory("serverquery://serveradmin:Sofiab123asd@92.222.70.70:10011/?server_port=9987");
    }

    public static function devolverAnalisis($juego) {
        return DB::table('analisis')->where('juego', $juego)->first();
    }

    public static function devolverTotal($juego) {
        $analisis = DB::table('analisis')->where('juego', $juego)->first();
        return ($analisis->jugabilidad + $analisis->graficos + $analisis->sonidos + $analisis->innovacion)/4;
    }

    public static function devolverNota($articulo) {
        $analisis = DB::table('analisis')->where('articulo', $articulo)->first();
        return round((($analisis->jugabilidad + $analisis->graficos + $analisis->sonidos + $analisis->innovacion)/4)/10,1);
    }

    public static function devolverColor($nota) {
        if ($nota < 5) {
            echo "label-danger";
        } else if ($nota < 8) {
            echo "label-warning";
        } else if ($nota >= 8) {
            echo "label-success";
        }
    }
}