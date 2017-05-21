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

use App\Models\Articles\Category;
use App\Models\Games\Game;
use Illuminate\Database\Eloquent\Model;

/**
 * Esta clase es el modelo de la tabla "foros" de la base de datos
 * Class Forum
 * @package App
 */
//ToDo Crear migraciones y modificar modelos
class Forum extends Model
{
    protected $table = 'forums';
    protected $fillable = ['title', 'forum_section_id', 'type', 'game_id', 'category_id', 'seo_optimized_title'];
    public $timestamps = true;

    const TYPE_GENERAL = 0;
    const TYPE_CATEGORY = 1;
    const TYPE_GAME = 2;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topics() {
        return $this->hasMany(ForumTopic::class, 'forum_id');
    }

    /**
     * @return int
     */
    //ToDo fallo
    public function countTopics() {
        $topics = $this->topics;
        $counter = 0;
        foreach ($topics as $topic) {
            if ($topic->type == ForumTopic::TYPE_TOPIC) {
                $counter++;
            }
        }

        return $counter;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forumSection() {
        return $this->belongsTo(ForumSection::class, 'forum_section_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game() {
        return $this->belongsTo(Game::class, 'game_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}