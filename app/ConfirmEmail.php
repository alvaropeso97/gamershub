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
 * Esta clase es el modelo de la tabla "confirm_email" de la base de datos
 * Class ConfirmEmail
 * @package App
 */
class ConfirmEmail extends Model
{
    protected $table = 'confirm_email';
    protected $fillable = ['user_id','token'];
    public $timestamps = false;

    /**
     * Devuelve el usuario relacionado con un TOKEN de seguridad
     * @return usuario relacionado con el token de seguridad
     */
    public function getUsuario() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
