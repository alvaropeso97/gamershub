<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * @param $fecha
     * @return false|string
     */
    public static function fechaEs($fecha) {
        $fecha = strtotime($fecha);
        return date('d/m/Y', $fecha);
    }

    /**
     * @param $fecha
     * @return string
     */
    function fechaMysql($fecha) {
        $mifecha = explode("/", $fecha);
        $lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0];
        return $lafecha;
    }

    static function fechaHora($fecha) {
        $fecha_n = new \DateTime($fecha);
        return $fecha_n->format('d \d\e F \d\e Y \a \l\a\s h:m');
    }

    /**
     * Sanea una cadena de caracteres
     * @param string la cadena a sanear
     * @return string cadena saneada
     */
    public static function sanear_string($s)
    {
        $s = preg_replace("/á|à|â|ã|ª/","a",$s);
        $s = preg_replace("/Á|À|Â|Ã/","a",$s);
        $s = preg_replace("/é|è|ê/","e",$s);
        $s = preg_replace("/É|È|Ê/","e",$s);
        $s = preg_replace("/í|ì|î/","i",$s);
        $s = preg_replace("/Í|Ì|Î/","i",$s);
        $s = preg_replace("/ó|ò|ô|õ|º/","o",$s);
        $s = preg_replace("/Ó|Ò|Ô|Õ/","o",$s);
        $s = preg_replace("/ú|ù|û/","u",$s);
        $s = preg_replace("/Ú|Ù|Û/","u",$s);
        $s = str_replace(" ","-",$s);
        $s = str_replace("ñ","n",$s);
        $s = str_replace("Ñ","n",$s);

        $s = preg_replace('/[^a-zA-Z0-9_.-]/', '', $s);
        return strtolower($s);
    }

    /**
     * Esta función recibe una fecha en formato UNIX y la convierte a un formato en español
     * legible para los usuarios
     * @param $fecha Fecha a traducir
     * @return string Fecha traducida
     */
    public static function traducirFecha($fecha) {
        $fechaCadena = strtotime($fecha);
        $mes = strftime("%B", $fechaCadena);
        $mesTraducido = "";
        switch ($mes) {
            case "January":
                $mesTraducido = "enero";
                break;
            case "February":
                $mesTraducido = "febrero";
                break;
            case "March":
                $mesTraducido = "marzo";
                break;
            case "April":
                $mesTraducido = "abril";
                break;
            case "May":
                $mesTraducido = "mayo";
                break;
            case "June":
                $mesTraducido = "junio";
                break;
            case "July":
                $mesTraducido = "julio";
                break;
            case "August":
                $mesTraducido = "agosto";
                break;
            case "September":
                $mesTraducido = "septiembre";
                break;
            case "October":
                $mesTraducido = "octubre";
                break;
            case "November":
                $mesTraducido = "noviembre";
                break;
            case "December":
                $mesTraducido = "diciembre";
                break;
        }
        return strftime("%e de $mesTraducido del %Y",$fechaCadena);
    }
}
