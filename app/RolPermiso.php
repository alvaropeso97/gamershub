<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolPermiso extends Model
{
    protected $table = 'roles_permisos';
    protected $fillable = ['rol_id', 'permiso_id'];
    public $timestamps = false;
}
