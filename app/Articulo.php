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
use Carbon\Carbon;

/**
 * Esta clase es el modelo de la tabla "articulos" de la base de datos
 * Class Articulo
 * @package App
 */
class Articulo extends Model
{
    protected $table = 'articulos';
    protected $fillable = ['id','titulo','descripcion','cont','img','tipo','fecha','juego_rel','id_autor','lnombre'];
    public $timestamps = false;

    /**
     * Clave ajena "id_autor", referencia a "id" (users)
     * @return autor del artículo
     */
    public function getAutor() {
        return $this->belongsTo('App\User', 'id_autor');
    }

    /**
     * Devuelve todas las categorías pertenecientes a un artículo
     * @return categorias pertenecientes al artículo
     */
    public function getCategorias() {
        return $this->belongsToMany('App\Categoria', 'categorias_articulos', 'cod_art', 'id_cat');
    }

    /**
     * Clave ajena "id_articulo", referencia a "id" (articulos)
     * @return comentarios pertenecientes a este artículo
     */
    public function getComentarios() {
        return $this->hasMany('App\Comentario', 'id_articulo', 'id');
    }

    /**
     * Clave ajena "articulo", referencia a "id" (articulos)
     * @return analisis perteneciente a este artículo
     */
    public function getAnalisis() {
        return $this->hasOne('App\Analisis', 'articulo', 'id');
    }

    /**
     * Clave ajena "id_art", referencia a "id" (articulos)
     * @return vídeo perteneciente a este artículo
     */
    public function getVideo() {
        return $this->hasOne('App\Video', 'id_art', 'id');
    }

    /**
     * Clave ajena "juego_rel", referencia a "id" (juegos)
     * @return juego relacionado a este artículo
     */
    public function getJuego() {
        return $this->belongsTo('App\Juego', 'juego_rel');
    }

    /**
     * Clave ajena "cod_art", referencia a "id" (articulos)
     * @return etiquetas relacionadas con el artículo
     */
    public function getEtiquetas() {
        return $this->hasMany('App\Etiqueta', 'cod_art', 'id');
    }

    /**
     * Establecer la imágen destacada para el artículo
     * @param $img Imagen destacada del artículo
     */
    public function setImgAttribute($img) {
        $this->attributes['img'] = Carbon::now()->timestamp.$img->getClientOriginalName();
        $name = $this->attributes['img'] = Carbon::now()->timestamp.$img->getClientOriginalName();
        \Storage::disk('s3')->put("/noticias/$name", \File::get($img));

    }

    /**
     * Esta funcion recibe una fecha y la devuelve modificada para mostrar al usuario.
     * @param $fecha
     * @return false|string
     */
    public static function devolverFecha($fecha) {
        Carbon::setLocale('es');
        $fecha_n = new \DateTime($fecha);
        return $fecha_n->format('d \d\e F \d\e Y');
    }

    /**
     * Transforma la fecha obtenida de la base de datos al formato español de fechas (ES_es)
     * @return fecha formateada al español
     */
    public function getFechaLocal() {
        $fecha = $this->fecha;
        $fecha_n = new \DateTime($fecha);
        return $fecha_n->format('d \d\e F \d\e Y');
    }

    /**
     * Devuelve en una cadena de caracteres el tiempo que hace en horas, dias o meses desde que
     * un artículo fue publicado
     * @return cadena indicando el tiempo que ha pasado desde que el artículo fué publicado
     */
    public function getFecha() {
        $fecha = $this->fecha;
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
                $return = "hace un a&ntilde;o";
            }else{
                $return = "hace $anio a&ntildeo;s";
            }
        }
        return $return;
    }

    public function getTipo() {
        $tipo = $this->tipo;
        switch ($tipo) {
            case "art":
                return "Noticia";
                break;
            case "vid":
                return "Vídeo";
                break;
            case "ana":
                return "Análisis";
                break;
        }
    }
}