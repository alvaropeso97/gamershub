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

/**
 * Esta clase es el modelo de la tabla "foros_temas" de la base de datos
 * Class ForoTema
 * @package App
 */
use Illuminate\Database\Eloquent\Model;

class ForoTema extends Model
{
    protected $table = 'foros_temas';
    protected $fillable = ['id','foro_id','tema_id','titulo','user_id','estado','tipo','contenido', 'created_at',
        'updated_at'];
    public $timestamps = true;

    /**
     * Clave ajena "user_id", referencia a "id" (users)
     * @return autor del tema
     */
    public function getUsuario() {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Devuelve las respuestas de un tema determinado especificando el número de respuestas a obtener.
     * 0. Devuelve todas las respuestas de un tema determinado
     * 1. Devuelve la última respuesta de un tema determinado
     * DEFAULT. Devuelve $limite respuesta/s de un tema determinado
     * @param $limite limite de respuestas a racibir
     * @return mixed respuestas del tema
     */
    public function getRespuestas($limite) {
        switch ($limite) {
            case 0: //TODAS
                return ForoTema::where('tema_id', $this->id)->where('tipo', 1)->get();
                break;
            case 1: //ULTIMA
                return ForoTema::where('tema_id', $this->id)->where('tipo', 1)->first();
                break;
            default: //LIMITE PERSONALIZADO
                return ForoTema::where('tema_id', $this->id)->where('tipo', $limite)->get();
                break;
        }
    }

    /**
     * Devuelve en una cadena de caracteres el tiempo que hace en horas, dias o meses desde que
     * un tema fue publicado
     * @return cadena indicando el tiempo que ha pasado desde que el tema fué publicado
     */
    public function getFecha() {
        $fecha = $this->created_at;
        $diferencia = time() - strtotime($fecha);
        $segundos = $diferencia ;
        $minutos = round($diferencia / 60 );
        $horas = round($diferencia / 3600 );
        $dias = round($diferencia / 86400 );
        $semanas = round($diferencia / 604800 );
        $mes = round($diferencia / 2419200 );
        $anio = round($diferencia / 29030400 );
        $return = "N/A";

        if($segundos <= 60){
            $return = "hace pocos segundos";

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
                $return = "hace un a&ntilde;o";
            }else{
                $return = "hace $anio a&ntildeo;s";
            }
        }
        return $return;
    }
}