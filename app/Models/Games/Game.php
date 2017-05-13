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
use App\Http\Controllers\TS3Server;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Esta clase es el modelo de la tabla "juegos" de la base de datos
 * Class Game
 * @package App
 */
class Game extends Model
{
    //ToDo Documentar funciones
    protected $table = 'games';
    protected $fillable = ['title','description','available_on','players_quantity','duration','language',
        'release_date','header_image','boxed_image'];
    public $timestamps = true;

    /**
     * Clave ajena "juego_rel", referencia a "id" (juegos)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany articulos pertenecientes a este juego
     */
    public function articles() {
        return $this->hasMany(Article::class, 'game_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function developers() {
        return $this->belongsToMany(Developer::class, 'games_developers');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function distributors() {
        return $this->belongsToMany(Distributor::class, 'games_distributors');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres() {
        return $this->belongsToMany(Genre::class, 'games_genres');
    }

    /**
     * @param $img_header
     */
    public function setImgheaderAttribute($img_header) {
        $this->attributes['header_image'] = Carbon::now()->second.$img_header->getClientOriginalName();
        $name = $this->attributes['header_image'] = Carbon::now()->second.$img_header->getClientOriginalName();
        \Storage::disk('s3')->put("/juegos/cabeceras/$name", \File::get($img_header));
    }

    /**
     * @param $caratula
     */

    /**
     * @param $img_box
     */
    public function setImgboxAttribute($img_box) {
        $this->attributes['boxed_image'] = Carbon::now()->second.$img_box->getClientOriginalName();
        $name = $this->attributes['boxed_image'] = Carbon::now()->second.$img_box->getClientOriginalName();
        \Storage::disk('s3')->put("/juegos/img/$name", \File::get($img_box));
    }

}