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
use App\Http\Requests\Forums\StoreForumResponse;
use App\Http\Requests\Forums\StoreForumTopic;
use App\Models\Forums\Forum;
use App\Models\Forums\ForumTopic;
use App\Http\Controllers\Controller;
use App\Models\Users\User;
use Illuminate\Support\Facades\Auth;

class ForumsTopicsController extends Controller
{
    public function show($foro_id, $tema_id) {
        //Buscar foro
        $foro = Forum::find($foro_id);
        if (!$foro) {
            throw new ForoNoEncontradoException;
        } else {
            //Buscar tema
            $tema = ForumTopic::find($tema_id);
            if (!$tema || $tema->forum_id != $foro_id || $tema->type != ForumTopic::TYPE_TOPIC) { //No se ha encontrado el tema relacionado con el foro
                throw new TemaNoEncontradoException;
            } else {
                $temasRespuestas = ForumTopic::where('forum_topic_id', $tema_id)->where('type', ForumTopic::TYPE_REPLY)->get();
                return view('forums.topic.topic', ['foro' => $foro,'tema' => $tema ,'temasRespuestas' => $temasRespuestas]);
            }
        }
    }

    public function create($id) {
        $forum = Forum::find($id);
        if (!$forum) {
            throw new ForoNoEncontradoException;
        } else {
            return view('forums.topic.create', ['forum' => $forum]);
        }
    }

    public function store(StoreForumTopic $request, $id, $type = ForumTopic::TYPE_TOPIC) {
        $forum = Forum::find($id);

        $forumTopic = new ForumTopic();
        $forumTopic->title = $request->input('title');
        $forumTopic->content = $request->input('content');
        $forumTopic->type = $type;
        $forumTopic->forum()->associate($forum);
        $forumTopic->user()->associate(User::find(Auth::id()));
        $forumTopic->save();

        return redirect()->route('forums.showTopic', ['foro_id' => $forum->id, 'tema_id' => $forumTopic->id]);
    }

    public function storeReply(StoreForumResponse $request, $foro_id, $tema_id, $type = ForumTopic::TYPE_REPLY) {
        $forum = Forum::find($foro_id);
        $forumTopic = ForumTopic::find($tema_id);

        $reply = new ForumTopic();
        $reply->title = 'RE: '.$forumTopic->title;
        $reply->content = $request->input('content');
        $reply->type = $type;
        $reply->forum()->associate($forum);
        $reply->topic()->associate($forumTopic);
        $reply->user()->associate(User::find(Auth::id()));
        $reply->save();

        return redirect()->route('forums.showTopic', ['foro_id' => $forum->id, 'tema_id' => $forumTopic->id]);
    }
}