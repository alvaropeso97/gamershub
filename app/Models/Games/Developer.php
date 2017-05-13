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

namespace App;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    //ToDo Documentar funciones
    protected $table = 'developers';
    protected $fillable = ['name'];
    public $timestamps = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function games() {
        return $this->belongsToMany(Game::class, 'games_developers', 'game_id', 'developer_id');
    }
}
