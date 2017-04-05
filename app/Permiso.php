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
 * Esta clase es el modelo de la tabla "permisos" de la base de datos
 * Class Permiso
 * @package App
 */
class Permiso extends Model
{
    protected $table = 'permisos';
    protected $fillable = ['id','nombre','descripcion'];
    public $timestamps = false;

    /**
     * Devuelve todos los roles que contienen este permiso
     * @return roles que contienen este permiso
     */
    public function getRoles() {
        return $this->belongsToMany('App\Rol', 'roles_permisos', 'rol_id', 'permiso_id');
    }
}
