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
 * Esta clase es el modelo de la tabla "usuarios_plataformas" de la base de datos
 * Class UsuarioPlataforma
 * @package App
 */
class UsuarioPlataforma extends Model
{
    protected $table = 'usuarios_plataformas'; // Obtener la tabla de la base de datos
    protected $fillable = ['id_usuario','id_plataforma'];
    public $timestamps = false;
}