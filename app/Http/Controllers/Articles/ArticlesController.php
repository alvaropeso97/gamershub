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

namespace App\Http\Controllers;


use App\Review;
use App\Article;
use App\Tag;
use App\Exceptions\ArticuloNoEncontradoException;
use App\Game;
use App\Mail\ConfirmacionRegistro;
use App\Video;
use Illuminate\Routing\Controller;
use DB;
use App\Http\Requests;
use Request;
use Auth;
use Mail;
use Intervention\Image\Facades\Image;
class ArticlesController extends Controller
{
    /**
     * Muestra un listado de todos los artículos de tipo "art"
     * @return vista de paginas.noticias
     */
    public static function mostrarNoticias() {
        $cons =  Article::whereRaw('tipo = "art"')->orderBy('id','desc')->paginate(9);
        return view('layouts.paginas.noticias', ['cons' => $cons]);
    }

    /**
     * Muestra un listado de todos los artículos de tipo "art" ordenados de ascendentemente por el título
     * @return vista de paginas.noticias
     */
    public static function mostrarNoticiasAZ() {
        $cons =  Article::whereRaw('tipo = "art"')->orderBy('titulo','asc')->paginate(9);
        return view('layouts.paginas.noticias', ['cons' => $cons]);
    }

    /**
     * Muestra un artículo a través de su id y título, comprueba si es un análisis y si lo es lo muestra.
     * Si es un vídeo, envía a la vista los datos del vídeo
     * @param $id artículo a mostrar
     * @param $titulo título del artículo formateado
     * @return vista paginas.articulo
     * @throws ArticuloNoEncontradoException si no encuentra el artículo asociado con el id y el título
     */
    public static function mostrarArticulo($id, $titulo) {
        $articulo = Article::where('lnombre', $titulo)->where('id', $id)->first();
        if (!$articulo) {
            throw new ArticuloNoEncontradoException;
        } else {
            if ($articulo->tipo == 'ana') { //Comprobar si es un análisis y mostrarlo
                $juego = $articulo->getJuego;
                return redirect("/juego/$juego->id/$juego->lnombre/analisis");
            } else {
                switch ($articulo->tipo) {
                    case "vid":
                        return view('layouts.paginas.articulo', ['id' => Article::findOrFail($articulo->id), 'vid' => $articulo->getVideo]);
                        break;
                    case "art":
                        return view('layouts.paginas.articulo', ['id' => Article::findOrFail($articulo->id)]);
                        break;
                }
            }
        }
    }

    /**
     * Muestra un artículo únicamente a través de su id, comprueba si es un análisis y si lo es lo muestra.
     * Redirige a la vista de la noticia con el id y el enlace formateado al igual que en mostrarArticulo()
     * @param $id artículo a mostrar
     * @return redirección a /articulo/id-articulo/titulo-formateado
     * @throws ArticuloNoEncontradoException si no encuentra el artículo asociado con el id
     */
    public static function mostrarArticuloDos ($id) {
        $articulo = Article::where('id', $id)->first();
        if (!$articulo) {
            throw new ArticuloNoEncontradoException;
        } else {
            if ($articulo->tipo == 'ana') { //Comprobar si es un análisis y mostrarlo
                $juego = DB::table('juegos')->where('id', $articulo->juego_rel)->first();
                return redirect("/juego/$juego->id/$juego->lnombre/analisis");
            } else {
                return redirect("/articulo/$id/$articulo->lnombre");
            }
        }
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

    public static function devolverCantidadBusqueda($tag) {
        $cantidad['articulos'] = Article::where('titulo','LIKE',"%$tag%")->where('tipo','art')->get()->count();
        $cantidad['juegos'] = Game::where('titulo','LIKE',"%$tag%")->get()->count();
        $cantidad['analisis'] = Article::where('titulo','LIKE',"%$tag%")->where('tipo','ana')->get()->count();
        $cantidad['videos'] = Article::where('titulo','LIKE',"%$tag%")->where('tipo','vid')->get()->count();
        $cantidad['etiquetas'] = Tag::where('nombre','LIKE',"$tag")->get()->count();
        return $cantidad;
    }

    function mostrarBusqueda($tipo,$tag) {
        if ($tipo == 'articulos') {
            //Seleccionar todos los artículos que se asemejen a la búsqueda
            $busqueda_a = Article::where('titulo','LIKE',"%$tag%")->where('tipo','art')->orderBy('id','desc')->paginate(10);
            return view('layouts.paginas.busqueda', ['busq_a' => $busqueda_a, 'tag' => $tag, 'tipo' => $tipo]);
        }

        if ($tipo == 'videos') {
            $busqueda_v = Article::where('titulo','LIKE',"%$tag%")->where('tipo','vid')->orderBy('id','desc')->paginate(10);
            return view('layouts.paginas.busqueda', ['busq_a' => $busqueda_v, 'tag' => $tag, 'tipo' => $tipo]);
        }

        if ($tipo == 'analisis') {
            $busqueda_an = Article::where('titulo','LIKE',"%$tag%")->where('tipo','ana')->orderBy('id','desc')->paginate(10);
            return view('layouts.paginas.busqueda', ['busq_a' => $busqueda_an, 'tag' => $tag, 'tipo' => $tipo]);
        }

        if ($tipo == 'juegos') {
            $busqueda_j = Game::where('titulo','LIKE',"%$tag%")->orderBy('id','desc')->paginate(9);
            return view('layouts.paginas.busqueda_juegos', ['busq_j' => $busqueda_j, 'tag' => $tag, 'tipo' => $tipo]);
        }

        if ($tipo == 'etiquetas') {
            $art_etiq = TagsController::devolverArticulosEtiqueta($tag);
            $busqueda_a = Article::whereIn('id',$art_etiq)->orderBy('id','desc')->paginate(10);
            return view('layouts.paginas.busqueda', ['busq_a' => $busqueda_a, 'tag' => $tag, 'tipo' => $tipo]);
        }
    }
}