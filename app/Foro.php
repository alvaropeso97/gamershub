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
 * Esta clase es el modelo de la tabla "foros" de la base de datos
 * Class Foro
 * @package App
 */
class Foro extends Model
{
    protected $table = 'foros';
    protected $fillable = ['id','nombre','tipo','juego_id','plataforma_id','acceso'];
    public $timestamps = true;
}