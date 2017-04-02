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

use App\Comentario;
use App\Articulo;
use DB;
use Request;

class ComentariosController extends Controller
{
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
        Comentario::create(Request::all());

        //Devolver al usuario al artículo
        return view('layouts.paginas.articulo', ['id' => Articulo::findOrFail($id)]);
    }

    /**
     * Elimina un comentario concreto y devuelve al usuario a la página del
     * artículo al que pertenecía.
     * @param $id
     * @param $comentario
     * @return mixed
     */
    public function destroy($id, $comentario) {
        Comentario::find($comentario)->delete();
        return redirect('/articulo/'.$id);
    }

    public static function devolverComentariosJuego ($id) {
        return $comentarios = DB::select("select * from comentarios where id_articulo in (select id from articulos where juego_rel = ".$id.") limit 5");
    }
}
