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

use App\Http\Controllers\ArticulosController;
use App\Articulo;
use DB;
use Request;

class ComentariosController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    /**
     * Crea un comentario y devuelve al usuario a la página al
     * que pertenece.
     * @param Request $request Nada
     * @param $id Noticia donde se almacena el comentario
     * @return el artículo al que pertenece el comentario
     */
    public function store(\Illuminate\Http\Request $request, $id)
    {
        //Validar el comentario
        $this->validate($request, [
            'comentario' => 'required|min:25'
        ]);

        //Almacenar el comentario en la base de datos
        \App\Comentario::create(Request::all());

        //Devolver al usuario al artículo
        return view('layouts.paginas.articulo', ['id' => Articulo::findOrFail($id)]);
    }

    /**
     * Recibe la id de un artículo y recibe un int con la cantidad
     * de comentarios que posee ese artículo.
     * @param $id artículo
     * @return int cantidad de comentarios publicados
     */
    public static function devolverNum($id) {
        $comentarios = DB::select("select * from comentarios where id_articulo=".$id." ORDER BY id desc");
        return count($comentarios);
    }

    /**
     * Recibe la id de una noticia y devuelve los comentarios de la misma.
     * @param $id artículo
     * @return array de comentarios ordenados de forma descendente
     */
    public static function devolverComentarios ($id) {
        return $comentarios = DB::select("select * from comentarios where id_articulo=".$id." ORDER BY id desc");
    }

    public static function devolverComentariosJuego ($id) {
        return $comentarios = DB::select("select * from comentarios where id_articulo in (select id from articulos where juego_rel = ".$id.") limit 5");
    }
    /**
     * Recibe la id de un comentario y devuelve la iformacion del
     * usuario que lo ha escrito.
     * @param $id_autor autor del comentario
     * @return usuario
     */
    public static function devolverUsuario ($id_autor) {
        return $usuario = DB::table('users')->where('id', $id_autor)->first();
    }

    /**
     * Devuelve en una cadena de caracteres el tiempo que hace en horas,dias o meses desde que
     * un comentario fue publicado.
     * @param $fecha Fecha en la cual el comentario fué creado.
     */
    public static function obtenerFecha($fecha) {

        $diferencia = time() - strtotime($fecha) ;
        $segundos = $diferencia ;
        $minutos = round($diferencia / 60 );
        $horas = round($diferencia / 3600 );
        $dias = round($diferencia / 86400 );
        $semanas = round($diferencia / 604800 );
        $mes = round($diferencia / 2419200 );
        $anio = round($diferencia / 29030400 );

        if($segundos <= 60){
            echo "hace segundos";

        }else if($minutos <=60){
            if($minutos==1){
                echo "hace un minuto";
            }else{
                echo "hace $minutos minutos";
            }
        }else if($horas <=24){
            if($horas==1){
                echo "hace una hora";
            }else{
                echo "hace $horas horas";
            }
        }else if($dias <= 7){
            if($dias==1){
                echo "hace un dia";
            }else{
                echo "hace $dias dias";
            }
        }else if($semanas <= 4){
            if($semanas==1){
                echo "hace una semana";
            }else{
                echo "hace $semanas semanas";
            }
        }else if($mes <=12){
            if($mes==1){
                echo "hace un mes";
            }else{
                echo "hace $mes meses";
            }
        }else{
            if($anio==1){
                echo "hace un a&ntilde;o";
            }else{
                echo "hace $anio a&ntildeo;s";
            }
        }
    }


    /**
     * Elimina un comentario concreto y devuelve al usuario a la página del
     * artículo al que pertenecía.
     * @param $id
     * @param $comentario
     * @return mixed
     */
    public function eliminarComentario($id, $comentario) {
        DB::table('comentarios')->where('id', $comentario)->delete();
        return redirect('/articulo/'.$id);
    }
}
