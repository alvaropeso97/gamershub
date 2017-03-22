<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Esta clase es el modelo de la tabla "comentarios" de la base de datos
 * Class Comentario
 * @package App
 */
class Comentario extends Model
{
    protected $table = 'comentarios';
    protected $fillable = ['id','id_articulo','id_usuario','comentario'];
    public $timestamps = false;

    /**
     * Clave ajena "id_articulo", referencia a "id" (articulos)
     */
    public function id_articulo(){
        $this->hasOne('App\Articulo');
    }

    /**
     * Clave ajena "id_usuario", referencia a "id" (users)
     */
    public function id_usuario() {
        $this->hasOne('App\User');
    }
}