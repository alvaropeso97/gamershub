<?php
/**
 *  ____  _             _     _ _
 * |  _ \| | __ _ _   _| |__ (_) |_   ___  ___
 * | |_) | |/ _` | | | | '_ \| | __| / _ \/ __|
 * |  __/| | (_| | |_| | |_) | | |_ |  __/\__ \
 * |_|   |_|\__,_|\__, |_.__/|_|\__(_)___||___/
 *                |___/
 *
 * TODOS LOS DERECHOS RESERVADOS ÁLVARO PESO GARCÍA
 * WWW.PLAYBIT.ES
 * CONTACTO@PLAYBIT.ES
 * ALVARO.PESO@PLAYBIT.ES
 * @PlaybitES
 * 2017
 *
 */

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Model;

/**
 * Esta clase es el modelo de la tabla "comentarios" de la base de datos
 * Class Comment
 * @package App
 */
class Comment extends Model
{
    protected $table = 'articles_comments';
    protected $fillable = ['article_id','user_id','comment'];
    public $timestamps = true;

    /**
     * Clave ajena "id_usuario", referencia a "id" (users)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo autor del comentario
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Clave ajena "id_articulo", referencia a "id" (articulos)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo artículo perteneciente a este comentario
     */
    public function article() {
        return $this->belongsTo(Article::class, 'article_id');
    }

    /**
     * Devuelve en una cadena de caracteres el tiempo que hace en horas, dias o meses desde que
     * un comentario fue publicado
     * @return string cadena indicando el tiempo que ha pasado desde que el comentario fué publicado
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