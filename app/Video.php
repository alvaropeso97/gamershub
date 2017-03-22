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
 * Esta clase es el modelo de la tabla "videos" de la base de datos
 * Class Video
 * @package App
 */
class Video extends Model
{
    protected $table = 'videos'; // Obtener la tabla artículos de la base de datos
    protected $fillable = ['id','id_art','cod_yt','dur','visitas'];
    public $timestamps = false;

}