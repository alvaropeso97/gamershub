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

    public function getArticulo() {
        return $this->belongsTo('App\Articulo', 'articulo');
    }

    public function getNota() {
        return ($this->jugabilidad + $this->graficos + $this->sonidos + $this->innovacion)/4;
    }

    public function getNotaMostrar() {
        return round((($this->jugabilidad + $this->graficos + $this->sonidos + $this->innovacion)/4)/10,1);
    }

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