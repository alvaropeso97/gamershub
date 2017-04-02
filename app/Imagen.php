<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes';
    protected $fillable = ['id','nombre','carpeta','ancho','alto','juego_id','fecha_subida'];
    public $timestamps = false;
}
