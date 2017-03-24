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

/**
 * Esta clase es el modelo de la tabla "analisis" de la base de datos
 * Class Analisis
 * @package App
 */
class Analisis extends Model
{
    protected $table = 'analisis';
    protected $fillable = ['articulo','juego','jugabilidad','graficos','sonidos','innovacion'];
    public $timestamps = false;

    /**
     * Clave ajena "articulo", referencia a "id" (articulos)
     * @return artículo perteneciente a este análisis
     */
    public function getArticulo() {
        return $this->belongsTo('App\Articulo', 'articulo');
    }

    /**
     * Calcula la nota sobre 100
     * @return nota del análisis sobre 100
     */
    public function getNota() {
        return ($this->jugabilidad + $this->graficos + $this->sonidos + $this->innovacion)/4;
    }

    /**
     * Calcula la nota sobre 10
     * @return nota del análisis sobre 10
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