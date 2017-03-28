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

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Esta clase es el modelo de la tabla "users" de la base de datos
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $fillable = ['id',
        'name', 'email', 'password','fecha_nacimiento','genero_preferido','pais','ciudad','sexo','fecha_nac',
        'firma_personal','xbox_gamertag','ps_id','nintendo_network','codigo_amigo_wii','codigo_amigo_3ds',
        'codigo_amigo_ds','microsoft_gamertag','steam_id','twitter','facebook','google','web_blog','verificada'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Clave ajena "id_autor", referencia a "id" (users)
     * @return artículos pertenecientes a este usuario
     */
    public function getArticulos() {
        return $this->hasMany('App\Articulo', 'id_autor', 'id');
    }

    /**
     * Clave ajena "id_usuario", referencia a "id" (users)
     * @return comentarios pertenecientes a este usuario
     */
    public function getComentarios() {
        return $this->hasMany('App\Comentario', 'id_usuario', 'id');
    }

    /**
     * Clave ajena "pais", referencia a "cod_pais" (paises)
     * @return pais del usuario
     */
    public function getPais() {
        return $this->belongsTo('App\Pais', 'cod_pais');
    }

    /**
     * Transforma el rango del usuario en una cadena para posteriormente mostrarla
     * @return cadena indicando el rango del usuario
     */
    public function getRango() {
        switch ($this->acceso) {
            case 0:
                return "Usuario";
                break;
            case 1:
                return "Redactor";
                break;
            case 2:
                return "Moderador";
                break;
            case 3:
                return "Administrador";
                break;
        }
    }

    public function getConfirmEmail() {
        return $this->hasOne('App\ConfirmEmail', 'user_id', 'id');
    }
}