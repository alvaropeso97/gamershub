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
