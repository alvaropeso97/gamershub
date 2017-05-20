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

namespace App\Models\Forums;

use Illuminate\Database\Eloquent\Model;

/**
 * Esta clase es el modelo de la tabla "foros" de la base de datos
 * Class Forum
 * @package App
 */
//ToDo Crear migraciones y modificar modelos
class Forum extends Model
{
    protected $table = 'foros';
    protected $fillable = ['id','nombre','tipo','juego_id','plataforma_id','acceso'];
    public $timestamps = true;
}