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
 * Esta clase es el modelo de la tabla "roles" de la base de datos
 * Class Rol
 * @package App
 */
class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = ['id','nombre','descripcion'];
    public $timestamps = false;

    /**
     * Devuelve los usuarios que pertenecen a este rol
     * @return User
     */
    public function getUsuarios() {
        return $this->hasOne('App\User', 'acceso', 'id');
    }

    /**
     * Devuelve los permisos que tiene este rol
     * @return Permiso
     */
    public function getPermisos() {
        return $this->belongsToMany('App\Permiso', 'roles_permisos', 'rol_id', 'permiso_id');
    }

}
