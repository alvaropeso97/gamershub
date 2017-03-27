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
use App\Articulo;
use App\Etiqueta;
use App\Exceptions\ArticuloNoEncontradoException;
use App\Juego;
use App\Mail\ConfirmacionRegistro;
use App\Video;
use Illuminate\Routing\Controller;
use DB;
use App\Http\Requests;
use Request;
use Auth;
use Mail;
use Intervention\Image\Facades\Image;
class ArticulosController extends Controller
{
    /**
     * Recibe los datos del formulario de creación para el nuevo artículo, sanea la cadena del enlace,
     * asigna las categorías al artículo, las etiquetas, crea un registro de tipo análisis o de tipo vídeo si lo es,
     * envía un tweet a la cuenta @GamersHUBes con el título, enlace e imágen del artículo
     * @param datos del formulario de creación
     * @return redirección a la vista de administracion.articulo
     */
    public function store(\Illuminate\Http\Request $request)
    {
        Articulo::create(Request::all());

        //Validar el artículo

        //Devolver id_art
        $articulo = DB::table('articulos')->orderBy('id', 'DESC')->first();

        //Establecer el link
        $link = self::sanear_string($articulo->titulo);
        Articulo::where('id', $articulo->id)
            ->update(['lnombre' => $link]);


        //Asociar las categorias al artículo
        foreach ($request->get('categorias') as $categoria) {
            DB::table('categorias_articulos')->insert([
                ['id_cat' => $categoria, 'cod_art' => $articulo->id]
            ]);
        }

        //Asociar las etiquetas al artículo
        $etiquetas = explode( ',', $request->get('etiquetas'));
        foreach ($etiquetas as $etiqueta) {
            DB::table('etiquetas')->insert([
                ['nombre' => $etiqueta, 'cod_art' => $articulo->id]
            ]);
        }

        if ($request->get('tipo') == 'vid') { //El artículo es un vídeo
            DB::table('videos')->insert([
                ['id_art' => $articulo->id, 'cod_yt' => $request->get('cod_yt'), 'dur' => $request->get('dur')]
            ]);
        }

        if ($request->get('tipo') == 'ana') { //El artículo es un análisis
            DB::table('analisis')->insert([
                ['articulo' => $articulo->id, 'juego' => $articulo->juego_rel, 'jugabilidad' => $request->get('jugabilidad'),
                    'graficos' => $request->get('graficos'), 'sonidos' => $request->get('sonidos'), 'innovacion' => $request->get('innovacion')]
            ]);
        }

        /*
         * Almacenar la imágen en tamaños diferentes
         */
        // 1600x900 [BIG]
        $big = Image::make($request->file('img'))->resize(1600,900);
        \Storage::disk('s3')->put("/noticias/1600x900_$articulo->img", (string) $big->encode('jpg'));
        // 950x534 [MEDIUM]
        $med = Image::make($request->file('img'))->resize(950,534);
        \Storage::disk('s3')->put("/noticias/950x534_$articulo->img", (string) $med->encode('jpg'));
        // 500x281 [SMALL]
        $smll = Image::make($request->file('img'))->resize(500,281);
        \Storage::disk('s3')->put("/noticias/500x281_$articulo->img", (string) $smll->encode('jpg'));

        return redirect('/panel/articulos')->with('mensaje', 'Has creado un artículo correctamente.');
    }

    public static function convertirImagenes() {
        $articulos = Articulo::all();
        foreach ($articulos as $articulo) {
            $link = str_replace(' ','%20',$articulo->img);
            $big = Image::make("https://s3.eu-central-1.amazonaws.com/img.gamershub.es/noticias/$link")->resize(500,281);
            \Storage::disk('s3')->put("/noticias_rsz/500x281_$articulo->img", (string) $big->encode());
        }
    }

    /**
     * Modifica un artículo en concreto y lo actualiza en la base de datos incluyendo sus categorías, etiquetas...
     * @param $id artículo a editar
     * @param datos del formulario
     * @return redirección a la vista de administracion.articulo
     */
    public function update($id, \Illuminate\Http\Request $request) {
        //Obtener el artículo
        $articulo = Articulo::find($id)->first();

        //Actualizar la información del artículo genérica
        Articulo::find($id)
            ->update(['titulo' => $request->get('titulo'), 'lnombre' => $request->get('lnombre'), 'juego_rel' => $request->get('juego_rel')
                , 'descripcion' => $request->get('descripcion'), 'cont' => $request->get('cont')]);

        //Eliminar las etiquetas del artículo
        DB::table('etiquetas')->where('cod_art', $id)->delete();

        //Asociar las etiquetas al artículo
        $etiquetas = explode( ',', $request->get('etiquetas'));
        foreach ($etiquetas as $etiqueta) {
            DB::table('etiquetas')->insert([
                ['nombre' => $etiqueta, 'cod_art' => $articulo->id]
            ]);
        }

        //Eliminar las categorias
        DB::table('categorias_articulos')->where('cod_art', $id)->delete();

        //Volver a crear las categorias
        foreach ($request->get('categorias') as $categoria) {
            DB::table('categorias_articulos')->insert([
                ['id_cat' => $categoria, 'cod_art' => $articulo->id]
            ]);
        }

        //Si es un vídeo
        if ($articulo->tipo == "vid") {
            Video::where('id_art', $id)
                ->update(['cod_yt' => $request->get('cod_yt'),'dur' => $request->get('dur')]);
        }

        //Si es un análisis
        if ($articulo->tipo == "ana") {
            Analisis::where('juego', $articulo->juego_rel)
                ->update(['jugabilidad' => $request->get('jugabilidad'),'graficos' => $request->get('graficos'),'sonidos' => $request->get('sonidos'),'innovacion' => $request->get('innovacion')]);
        }

        return redirect('/panel/articulos')->with('mensaje', 'Has modificado el artículo '.$id.' correctamente.');
    }

    /**
     * Elimina un artículo determinado de la base de datos
     * @param $id artículo a eliminar
     * @return redirección a la vista de administracion.articulos
     */
    public function destroy($id) {
        Articulo::find($id)->delete();
        return redirect('/panel/articulos')->with('mensaje', 'El artículo ha sido eliminado correctamente de la base de datos.');
    }

    /**
     * Muestra un listado de todos los artículos de tipo "art"
     * @return vista de paginas.noticias
     */
    public static function mostrarNoticias() {
        $cons =  \App\Articulo::whereRaw('tipo = "art"')->orderBy('id','desc')->paginate(9);
        return view('layouts.paginas.noticias', ['cons' => $cons]);
    }

    /**
     * Muestra un listado de todos los artículos de tipo "art" ordenados de ascendentemente por el título
     * @return vista de paginas.noticias
     */
    public static function mostrarNoticiasAZ() {
        $cons =  \App\Articulo::whereRaw('tipo = "art"')->orderBy('titulo','asc')->paginate(9);
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
        $articulo = Articulo::where('lnombre', $titulo)->where('id', $id)->first();
        if (!$articulo) {
            throw new ArticuloNoEncontradoException;
        } else {
            if ($articulo->tipo == 'ana') { //Comprobar si es un análisis y mostrarlo
                $juego = $articulo->getJuego;
                return redirect("/juego/$juego->id/$juego->lnombre/analisis");
            } else {
                switch ($articulo->tipo) {
                    case "vid":
                        return view('layouts.paginas.articulo', ['id' => Articulo::findOrFail($articulo->id), 'vid' => $articulo->getVideo]);
                        break;
                    case "art":
                        return view('layouts.paginas.articulo', ['id' => Articulo::findOrFail($articulo->id)]);
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
        $articulo = Articulo::where('id', $id)->first();
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
        $cantidad['articulos'] = Articulo::where('titulo','LIKE',"%$tag%")->where('tipo','art')->get()->count();
        $cantidad['juegos'] = Juego::where('titulo','LIKE',"%$tag%")->get()->count();
        $cantidad['analisis'] = Articulo::where('titulo','LIKE',"%$tag%")->where('tipo','ana')->get()->count();
        $cantidad['videos'] = Articulo::where('titulo','LIKE',"%$tag%")->where('tipo','vid')->get()->count();
        $cantidad['etiquetas'] = Etiqueta::where('nombre','LIKE',"$tag")->get()->count();
        return $cantidad;
    }

    function mostrarBusqueda($tipo,$tag) {
        if ($tipo == 'articulos') {
            //Seleccionar todos los artículos que se asemejen a la búsqueda
            $busqueda_a = Articulo::where('titulo','LIKE',"%$tag%")->where('tipo','art')->orderBy('id','desc')->paginate(10);
            return view('layouts.paginas.busqueda', ['busq_a' => $busqueda_a, 'tag' => $tag, 'tipo' => $tipo]);
        }

        if ($tipo == 'videos') {
            $busqueda_v = Articulo::where('titulo','LIKE',"%$tag%")->where('tipo','vid')->orderBy('id','desc')->paginate(10);
            return view('layouts.paginas.busqueda', ['busq_a' => $busqueda_v, 'tag' => $tag, 'tipo' => $tipo]);
        }

        if ($tipo == 'analisis') {
            $busqueda_an = Articulo::where('titulo','LIKE',"%$tag%")->where('tipo','ana')->orderBy('id','desc')->paginate(10);
            return view('layouts.paginas.busqueda', ['busq_a' => $busqueda_an, 'tag' => $tag, 'tipo' => $tipo]);
        }

        if ($tipo == 'juegos') {
            $busqueda_j = Juego::where('titulo','LIKE',"%$tag%")->orderBy('id','desc')->paginate(9);
            return view('layouts.paginas.busqueda_juegos', ['busq_j' => $busqueda_j, 'tag' => $tag, 'tipo' => $tipo]);
        }

        if ($tipo == 'etiquetas') {
            $art_etiq = EtiquetasController::devolverArticulosEtiqueta($tag);
            $busqueda_a = Articulo::whereIn('id',$art_etiq)->orderBy('id','desc')->paginate(10);
            return view('layouts.paginas.busqueda', ['busq_a' => $busqueda_a, 'tag' => $tag, 'tipo' => $tipo]);
        }
    }

    /*
     * ADMINISTRACIÓN
     */
    /**
     * Muestra la vista donde se listan todos los artículos existentes en la base de datos
     * @return vista de administracion.noticias
     */
    function mostrarArticulos() {
        $cons =  Articulo::select()->orderBy('id','desc')->paginate(10);
        return view('layouts.paginas.administracion.articulos', ['cons' => $cons]);
    }

    /**
     * Muestra la vista para crear un nuevo artículo rellenando un formulario
     * @return vista de administracion.nuev_art
     */
    public function nuevoArticulo() {
        return view('layouts.paginas.administracion.nuev_art');
    }

    /**
     * Muestra la vista para editar los datos de un artículo concreto
     * @param $id artículo que mostrará la vista de edición
     * @return redirección a la vista de administracion.edit_art
     */
    public static function mostrarEditarArticulo($id) {
        return view('layouts.paginas.administracion.edit_art', ['id' => Articulo::findOrFail($id)]);
    }
}