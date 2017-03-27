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
 * Esta clase es el modelo de la tabla "paises" de la base de datos
 * Class Pais
 * @package App
 */
class Pais extends Model
{
    protected $table = 'paises';
    protected $fillable = ['cod_pais','pais'];
    public $timestamps = false;

    /**
     * Clave ajena "pais", referencia a "cod_pais" (paises)
     * @return pais del usuario
     */
    public function getUsuarios() {
        return $this->hasMany('App\User', 'pais', 'cod_pais');
    }
}