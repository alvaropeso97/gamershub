<?php
/**
 *           ___                       _  _ _   _ ___
 *          / __|__ _ _ __  ___ _ _ __| || | | | | _ )
 *         | (_ / _` | '  \/ -_) '_(_-< __ | |_| | _ \
 *          \___\__,_|_|_|_\___|_| /__/_||_|\___/|___/
 *
 * TODOS LOS DERECHOS RESERVADOS, ÁLVARO PESO GARCÍA y GAMERSHUB
 *
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

/**
 * Esta clase es el modelo de la tabla "categorias" de la base de datos
 * Class Categorias
 * @package App
 */
class Categoria extends Model
{
    protected $table = 'categorias';
    protected $fillable = ['id','nombre','color','alias','esplataforma','img_header'];
    public $timestamps = false;

    /**
     * Devuelve todas los artículos pertenecientes a una categoría
     * @return artículos pertenecientes a una categoría
     */
    public function getArticulos() {
        return $this->belongsToMany('App\Articulo', 'categorias_articulos', 'id_cat', 'cod_art');
    }
}