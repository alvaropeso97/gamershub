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

namespace App;
use App\Http\Controllers\ArticlesController;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

/**
 * Esta clase es el modelo de la tabla "articulos" de la base de datos
 * Class Article
 * @package App
 */
class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = ['user_id', 'game_id', 'type', 'image', 'title', 'description', 'content', 'seo_optimized_name'];
    public $timestamps = true;

    /**
     * Clave ajena "id_autor", referencia a "id" (users)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Devuelve todas las categorías pertenecientes a un artículo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories() {
        return $this->belongsToMany(Category::class, 'articles_categories', 'article_id',
            'category_id');
    }

    /**
     * Clave ajena "id_articulo", referencia a "id" (articulos)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany comentarios pertenecientes a este artículo
     */
    public function comments() {
        return $this->hasMany(Comment::class, 'article_id');
    }

    /**
     * Clave ajena "articulo", referencia a "id" (articulos)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne Review perteneciente a este artículo
     */
    public function review() {
        return $this->hasOne(Review::class, 'article_id');
    }

    /**
     * Clave ajena "id_art", referencia a "id" (articulos)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne vídeo perteneciente a este artículo
     */

    public function video() {
        return $this->hasOne(Video::class, 'article_id');
    }

    /**
     * Clave ajena "juego_rel", referencia a "id" (juegos)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo juego relacionado a este artículo
     */
    public function game() {
        return $this->belongsTo(Game::class, 'game_id');
    }

    /**
     * Clave ajena "cod_art", referencia a "id" (articulos)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany etiquetas relacionadas con el artículo
     */
    public function tags() {
        return $this->hasMany(Tag::class, 'article_id');
    }

    /**
     * Establecer la imágen destacada para el artículo
     * @param $img
     */
    public function setImgAttribute($img) {
        $nombre_img = ArticlesController::sanear_string($img->getClientOriginalName());
        $this->attributes['img'] = Carbon::now()->timestamp.$nombre_img;
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
     * @return string fecha formateada al español
     */
    public function getFechaLocal() {
        $fecha = $this->fecha;
        $fecha_n = new \DateTime($fecha);
        return $fecha_n->format('d \d\e F \d\e Y');
    }

    /**
     * Devuelve en una cadena de caracteres el tiempo que hace en horas, dias o meses desde que
     * un artículo fue publicado
     * @return string cadena indicando el tiempo que ha pasado desde que el artículo fué publicado
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

    public function getType() {
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