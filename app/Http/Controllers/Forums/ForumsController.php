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
use App\Models\Forums\Forum;
use App\Models\Forums\ForumTopic;
use App\Http\Controllers\Controller;

class ForumsController extends Controller
{
    public function show($id) {
        //Buscar foro de tipo 0 (normal)
        $foro = Forum::find($id);
        if (!$foro) { //El foro no existe o no es del tipo
            throw new ForoNoEncontradoException;
        } else { //El foro existe y es del tipo
            $temas = ForumTopic::where('forum_id', $id)->where('type', ForumTopic::TYPE_TOPIC)->paginate(20);
            return view('forums.forum.forum', ['foro' => $foro, 'temas' => $temas]);
        }
    }
}