<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permisos';
    protected $fillable = ['id','nombre','descripcion'];
    public $timestamps = false;

    public function getRoles() {
        return $this->belongsToMany('App\Rol', 'roles_permisos', 'rol_id', 'permiso_id');
    }
}
