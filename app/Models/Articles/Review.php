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
use Illuminate\Database\Eloquent\Model;

/**
 * Esta clase es el modelo de la tabla "analisis" de la base de datos
 * Class Review
 * @package App
 */
class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = ['article_id','game_id','gameplay_score','graphics_score','sounds_score','innovation_score'];
    public $timestamps = true;

    /**
     * Clave ajena "articulo", referencia a "id" (articulos)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo artículo perteneciente a este análisis
     */
    public function article() {
        return $this->belongsTo(Article::class, 'article_id');
    }

    /**
     * Calcula la nota sobre 100
     * @return float|int nota del análisis sobre 100
     */
    public function getNota() {
        return ($this->jugabilidad + $this->graficos + $this->sonidos + $this->innovacion)/4;
    }

    /**
     * Calcula la nota sobre 10
     * @return float nota del análisis sobre 10
     */
    public function getNotaMostrar() {
        return round((($this->jugabilidad + $this->graficos + $this->sonidos + $this->innovacion)/4)/10,1);
    }

    /**
     * Muestra una clase (color) de bootstrap dependiendo la nota que tenga el análisis
     * Menor que 5: rojo
     * Entre 5 y 8: naranja
     * Mayor o igual que 8: verde
     */
    public function getColor() {
        $notaMostrar = $this->getNotaMostrar();
        if ($notaMostrar < 5) {
            echo "label-danger";
        } else if ($notaMostrar < 8) {
            echo "label-warning";
        } else if ($notaMostrar >= 8) {
            echo "label-success";
        }
    }
}