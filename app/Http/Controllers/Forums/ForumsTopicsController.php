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

namespace App\Http\Controllers\Forums;

use App\Exceptions\ForoNoEncontradoException;
use App\Exceptions\TemaNoEncontradoException;
use App\Forum;
use App\ForumTopic;
use Illuminate\Http\Request;

class ForumsTopicsController extends Controller
{
    public function mostrarTema($foro_id, $tema_id) {
        //Buscar foro
        $foro = Forum::find($foro_id);
        if (!$foro) {
            throw new ForoNoEncontradoException;
        } else {
            //Buscar tema
            $tema = ForumTopic::find($tema_id);
            if (!$tema || $tema->foro_id != $foro_id || $tema->tipo == 1) { //No se ha encontrado el tema relacionado con el foro
                throw new TemaNoEncontradoException;
            } else {
                $temasRespuestas = ForumTopic::where('tema_id', $tema_id)->where('tipo', 1)->get();
                return view('layouts.foros.tema', ['foro' => $foro,'tema' => $tema ,'temasRespuestas' => $temasRespuestas]);
            }
        }
    }

    public function mostrarTemaJuego($foro, $juego, $tema) {

    }

    public function mostrarTemaCategoria($foro, $categoria, $tema) {

    }
}