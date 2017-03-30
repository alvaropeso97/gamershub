<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = ['id','nombre','descripcion'];
    public $timestamps = false;

    public function getUsuarios() {
        return $this->hasOne('App\User', 'acceso', 'id');
    }

    public function getPermisos() {
        return $this->belongsToMany('App\Permiso', 'roles_permisos', 'rol_id', 'permiso_id');
    }

}
