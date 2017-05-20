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

use App\Models\Roles\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;

/**
 * Esta clase es el modelo de la tabla "users" de la base de datos
 * Class User
 * @package App
 */
//ToDo Documentar funciones
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $fillable = ['nickname', 'email', 'password', 'role_id', 'name', 'surname', 'birthdate', 'country_id', 'city', 'gender',
        'avarar', 'favourite_genre', 'signature', 'xbox_gamertag', 'ps_id', 'nintendo_network', 'friend_code_wii',
        'friend_code_3ds', 'friend_code_ds', 'microsoft_gamertag', 'steam_id', 'twitter', 'facebook', 'google',
        'web_blog', 'verified'];
    public $timestamps = true;

    protected $hidden = [
        'password'
    ];

    /**
     * Clave ajena "id_autor", referencia a "id" (users)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany artículos pertenecientes a este usuario
     */
    public function articles() {
        return $this->hasMany(Article::class, 'user_id');
    }

    /**
     * Clave ajena "id_usuario", referencia a "id" (users)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany comentarios pertenecientes a este usuario
     */
    public function comments() {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * Clave ajena "user_id", referencia a "id" (users)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany temas pertenecientes a este usuario
     */
    public function topics() {
        return $this->hasMany(ForumTopic::class, 'user_id');
    }

    /**
     * Clave ajena "pais", referencia a "cod_pais" (paises)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Country del usuario
     */
    public function country() {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userEmailToken() {
        return $this->hasOne(UserEmailToken::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public function estaConectado()
    {
        return Cache::has('usuario-esta-conectado-' . $this->id);
    }
}