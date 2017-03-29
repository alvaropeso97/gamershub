<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigGeneral extends Model
{
    protected $table = 'config_general';
    protected $fillable = ['nombre_aplicacion','titulo_inicio','imagen_fondo','noticias_dest','num_articulos_inicio','copyright'];
    public $timestamps = false;
}