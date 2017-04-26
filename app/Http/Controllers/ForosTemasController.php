<?php

namespace App\Http\Controllers;

use App\Exceptions\ForoNoEncontradoException;
use App\Exceptions\TemaNoEncontradoException;
use App\Foro;
use App\ForoTema;
use Illuminate\Http\Request;

class ForosTemasController extends Controller
{
    public function mostrarTema($foro_id, $tema_id) {
        //Buscar foro
        $foro = Foro::find($foro_id);
        if (!$foro) {
            throw new ForoNoEncontradoException;
        } else {
            //Buscar tema
            $tema = ForoTema::find($tema_id);
            if (!$tema || $tema->foro_id != $foro_id || $tema->tipo == 1) { //No se ha encontrado el tema relacionado con el foro
                throw new TemaNoEncontradoException;
            } else {
                $temasRespuestas = ForoTema::where('tema_id', $tema_id)->where('tipo', 1)->get();
                return view('layouts.foros.tema', ['foro' => $foro,'tema' => $tema ,'temasRespuestas' => $temasRespuestas]);
            }
        }
    }

    public function mostrarTemaJuego($foro, $juego, $tema) {

    }

    public function mostrarTemaCategoria($foro, $categoria, $tema) {

    }
}