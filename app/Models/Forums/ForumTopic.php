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
namespace App\Models\Forums;

/**
 * Esta clase es el modelo de la tabla "foros_temas" de la base de datos
 * Class ForumTopic
 * @package App
 */
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class ForumTopic extends Model
{
    protected $table = 'forums_topics';
    protected $fillable = ['title', 'content', 'type', 'forum_id', 'user_id', 'forum_topic_id'];
    public $timestamps = true;

    const TYPE_TOPIC = 0;
    const TYPE_REPLY = 1;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forum() {
        return $this->belongsTo(Forum::class, 'forum_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic() {
        return $this->belongsTo(ForumTopic::class, 'forum_topic_id');
    }

    /**
     * Devuelve las respuestas de un tema determinado especificando el número de respuestas a obtener.
     * 0. Devuelve todas las respuestas de un tema determinado
     * 1. Devuelve la última respuesta de un tema determinado
     * DEFAULT. Devuelve $limite respuesta/s de un tema determinado
     * @param $limite limite de respuestas a racibir
     * @return mixed respuestas del tema
     */
    public function getRespuestas($limite) {
        switch ($limite) {
            case 0: //TODAS
                return ForumTopic::where('forum_topic_id', $this->id)->where('type', ForumTopic::TYPE_REPLY)->get();
                break;
            case 1: //ULTIMA
                return ForumTopic::where('forum_topic_id', $this->id)->where('type', ForumTopic::TYPE_REPLY)
                    ->orderBy('created_at', 'desc')->first();
                break;
        }
    }
}