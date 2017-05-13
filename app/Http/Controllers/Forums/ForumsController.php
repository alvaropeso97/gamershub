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

use App\Exceptions\ForoNoEncontradoException;
use App\Forum;
use App\ForumTopic;

class ForumsController extends Controller
{
    public function mostrarForo($id) {
        //Buscar foro de tipo 0 (normal)
        $foro = Forum::find($id);
        if (!$foro) { //El foro no existe o no es del tipo
            throw new ForoNoEncontradoException;
        } else { //El foro existe y es del tipo
            $temas = ForumTopic::where('foro_id', $id)->where('tipo', 0)->paginate(20);
            switch ($foro->tipo) {
                case 0: //Normal
                    return view('layouts.foros.index', ['foro' => $foro, 'temas' => $temas]);
                    break;
                case 1: //Game
                    //ToDo Añadir redirección al foro de tipo juego
                    break;
                case 2: //Plataforma
                    //ToDo Añadir redirección al foro de tipo plataforma
                    break;
            }
        }
    }
}