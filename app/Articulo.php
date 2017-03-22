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
use Carbon\Carbon;

/**
 * Esta clase es el modelo de la tabla "articulos" de la base de datos
 * Class Articulo
 * @package App
 */
class Articulo extends Model
{
    protected $table = 'articulos'; // Obtener la tabla artículos de la base de datos
    protected $fillable = ['id','titulo','descripcion','cont','img','tipo','fecha','juego_rel','id_autor','lnombre'];
    public $timestamps = false;

    /**
     * Clave ajena "id_autor", referencia a "id" (users)
     */
    public function getAutor() {
        return $this->belongsTo('App\User', 'id_autor');
    }

    /**
     * Devuelve todas las categorías pertenecientes a un artículo
     * @return categorias pertenecientes al artículo
     */
    public function getCategorias() {
        return $this->belongsToMany('App\Categoria', 'categorias_articulos', 'cod_art', 'id_cat');
    }

    /**
     * Establecer la imágen destacada para el artículo
     * @param $img Imagen destacada del artículo
     */
    public function setImgAttribute($img) {
        $this->attributes['img'] = Carbon::now()->timestamp.$img->getClientOriginalName();
        $name = $this->attributes['img'] = Carbon::now()->timestamp.$img->getClientOriginalName();
        \Storage::disk('s3')->put("/noticias/$name", \File::get($img));

    }

    /**
     * Esta funcion recibe una fecha y la devuelve modificada para mostrar al usuario.
     * @param $fecha
     * @return false|string
     */
    public static function devolverFecha($fecha) {
        Carbon::setLocale('es');
        $fecha_n = new \DateTime($fecha);
        return $fecha_n->format('d \d\e F \d\e Y');
    }
}