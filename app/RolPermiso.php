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
 * Esta clase es el modelo de la tabla "roles_permisos" de la base de datos
 * Class RolPermiso
 * @package App
 */
class RolPermiso extends Model
{
    protected $table = 'roles_permisos';
    protected $fillable = ['rol_id', 'permiso_id'];
    public $timestamps = false;
}
