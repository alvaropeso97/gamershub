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
 * Esta clase es el modelo de la tabla "config_general" de la base de datos
 * Class ConfigGeneral
 * @package App
 */
class ConfigGeneral extends Model
{
    protected $table = 'config_general';
    protected $fillable = ['nombre_aplicacion','titulo_inicio','imagen_fondo','noticias_dest','num_articulos_inicio','copyright'];
    public $timestamps = false;
}