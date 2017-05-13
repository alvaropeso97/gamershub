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

//ToDo Crear migración y modificar modelo
/**
 * Esta clase es el modelo de la tabla "videos" de la base de datos
 * Class Video
 * @package App
 */
class Video extends Model
{
    protected $table = 'videos';
    protected $fillable = ['article_id','youtube_code','duration','views_count'];
    public $timestamps = true;

    /**
     * Devuelve el artículo perteneciente a este video
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo artículo relacionado con el vídeo
     */
    public function article() {
        return $this->belongsTo(Article::class, 'article_id');
    }
}