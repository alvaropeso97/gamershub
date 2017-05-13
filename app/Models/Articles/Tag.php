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

/**
 * Esta clase es el modelo de la tabla "etiquetas" de la base de datos
 * Class Tag
 * @package App
 */
class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['article_id','name'];
    public $timestamps = true;

    /**
     * Clave ajena "cod_art", referencia a "id" (articulos)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo artículo relacionado con la etiqueta
     */
    public function article() {
        return $this->belongsTo(Article::class, 'article_id');
    }
}