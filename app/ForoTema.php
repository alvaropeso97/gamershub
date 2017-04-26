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

/**
 * Esta clase es el modelo de la tabla "foros_temas" de la base de datos
 * Class ForoTema
 * @package App
 */
use Illuminate\Database\Eloquent\Model;

class ForoTema extends Model
{
    protected $table = 'foros_temas';
    protected $fillable = ['id','foro_id','tema_id','titulo','user_id','estado','tipo','contenido'];
    public $timestamps = true;
}
