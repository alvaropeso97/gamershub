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

namespace App\Models\Games;
use Illuminate\Database\Eloquent\Model;

/**
 * Esta clase es el modelo de la tabla "generos" de la base de datos
 * Class Genre
 * @package App
 */
class Genre extends Model
{
    //ToDo documentar funciones
    protected $table = 'genres';
    protected $fillable = ['name'];
    public $timestamps = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function games() {
        return $this->belongsToMany(Game::class, 'games_genres', 'game_id',
            'genre_id');
    }
}