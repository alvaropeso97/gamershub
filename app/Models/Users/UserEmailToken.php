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
 * Esta clase es el modelo de la tabla "confirm_email" de la base de datos
 * Class UserEmailToken
 * @package App
 */
class UserEmailToken extends Model
{
    protected $table = 'users_emails_tokens';
    protected $fillable = ['user_id','token'];
    public $timestamps = true;

    /**
     * Devuelve el usuario relacionado con un TOKEN de seguridad
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo usuario relacionado con el token de seguridad
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
