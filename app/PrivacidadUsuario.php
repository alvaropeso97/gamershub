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
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Esta clase es el modelo de la tabla "privacidad_usuarios" de la base de datos
 * Class PrivacidadUsuario
 * @package App
 */
class PrivacidadUsuario extends Model
{
    protected $table = 'privacidad_usuarios';
    protected $fillable = ['id_usuario','mostrar_perfil','mostrar_ciudad','mostrar_edad','mostrar_sexo',
                            'mostrar_cuentas_jue','mostrar_cuentas_con'];
    public $timestamps = false;

}