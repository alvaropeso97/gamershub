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

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = ['title', 'description', 'type', 'twitter_hashtag', 'related_tag', 'start_date', 'end_date',
        'seo_optimized_title'];
    public $timestamps = true;

    const TYPE_GENERAL = 0;
    const TYPE_STREAMING = 1;

    public function event() {
        return $this->belongsTo(Event::class, 'parent_event_id');
    }

    public function events() {
        return $this->hasMany(Event::class, 'parent_event_id');
    }

    public function getType() {
        switch ($this->type) {
            case self::TYPE_GENERAL:
                echo "Evento";
                break;
            case self::TYPE_STREAMING:
                echo "Emisión en directo";
                break;
        }
    }
}