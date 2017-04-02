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
    protected $fillable = ['id','id_articulo','id_usuario','comentario','created_at'];
    public $timestamps = false;

    /**
     * Clave ajena "id_usuario", referencia a "id" (users)
     * @return autor del comentario
     */
    public function getAutor() {
        return $this->belongsTo('App\User', 'id_usuario');
    }

    /**
     * Clave ajena "id_articulo", referencia a "id" (articulos)
     * @return artículo perteneciente a este comentario
     */
    public function getArticulo() {
        return $this->belongsTo('App\Articulo', 'id_articulo');
    }

    /**
     * Devuelve en una cadena de caracteres el tiempo que hace en horas, dias o meses desde que
     * un comentario fue publicado
     * @return cadena indicando el tiempo que ha pasado desde que el comentario fué publicado
     */
    public function getFecha() {
        $fecha = $this->created_at;
        $diferencia = time() - strtotime($fecha) ;
        $segundos = $diferencia ;
        $minutos = round($diferencia / 60 );
        $horas = round($diferencia / 3600 );
        $dias = round($diferencia / 86400 );
        $semanas = round($diferencia / 604800 );
        $mes = round($diferencia / 2419200 );
        $anio = round($diferencia / 29030400 );
        $return = "N/A";

        if($segundos <= 60){
            $return = "hace segundos";

        }else if($minutos <=60){
            if($minutos==1){
                $return = "hace un minuto";
            }else{
                $return = "hace $minutos minutos";
            }
        }else if($horas <=24){
            if($horas==1){
                $return = "hace una hora";
            }else{
                $return = "hace $horas horas";
            }
        }else if($dias <= 7){
            if($dias==1){
                $return = "hace un dia";
            }else{
                $return = "hace $dias dias";
            }
        }else if($semanas <= 4){
            if($semanas==1){
                $return = "hace una semana";
            }else{
                $return = "hace $semanas semanas";
            }
        }else if($mes <=12){
            if($mes==1){
                $return = "hace un mes";
            }else{
                $return = "hace $mes meses";
            }
        }else{
            if($anio==1){
                $return = "hace un año";
            }else{
                $return = "hace $anio años";
            }
        }
        return $return;
    }
}