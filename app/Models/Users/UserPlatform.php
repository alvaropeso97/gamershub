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

namespace App\Models\Users;
use Illuminate\Database\Eloquent\Model;

/**
 * Esta clase es el modelo de la tabla "usuarios_plataformas" de la base de datos
 * Class UserPlatform
 * @package App
 */
//ToDo ¿Dejarla o quitarla? ¿Es necesaria?
class UserPlatform extends Model
{
    protected $table = 'usuarios_plataformas';
    protected $fillable = ['id_usuario','id_plataforma'];
    public $timestamps = false;
}