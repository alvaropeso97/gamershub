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

use App\Exceptions\ForoNoEncontradoException;
use App\Foro;

class ForosController extends Controller
{
    public function mostrarForo($id) {
        //Buscar foro de tipo 0 (normal)
        $foro = Foro::find($id);
        if (!$foro) { //El foro no existe o no es del tipo
            throw new ForoNoEncontradoException;
        } else { //El foro existe y es del tipo
            switch ($foro->tipo) {
                case 0: //Normal
                    return view('layouts.foros.index', ['foro' => $foro]);
                    break;
                case 1: //Juego
                    //ToDo Añadir redirección al foro de tipo juego
                    break;
                case 2: //Plataforma
                    //ToDo Añadir redirección al foro de tipo plataforma
                    break;
            }
        }
    }
}