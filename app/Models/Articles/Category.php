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

namespace App\Models\Articles;
use Illuminate\Database\Eloquent\Model;

/**
 * Esta clase es el modelo de la tabla "categorias" de la base de datos
 * Class Category
 * @package App
 */
class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name','color','alias','its_platform'];
    public $timestamps = true;

    /**
     * Devuelve todas los artículos pertenecientes a una categoría
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany artículos pertenecientes a una categoría
     */
    public function articles() {
        return $this->belongsToMany(Article::class, 'articles_categories', 'category_id'
            ,'article_id');
    }
}