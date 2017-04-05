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
 * Esta clase es el modelo de la tabla "imagenes" de la base de datos
 * Class Imagen
 * @package App
 */
class Imagen extends Model
{
    protected $table = 'imagenes';
    protected $fillable = ['id','nombre','carpeta','ancho','alto','juego_id','fecha_subida'];
    public $timestamps = false;
}
