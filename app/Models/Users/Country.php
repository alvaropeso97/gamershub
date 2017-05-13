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

namespace App;
use Illuminate\Database\Eloquent\Model;

/**
 * Esta clase es el modelo de la tabla "paises" de la base de datos
 * Class Country
 * @package App
 */
class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = ['code','country'];
    public $timestamps = false;

    /**
     * Clave ajena "pais", referencia a "cod_pais" (paises)
     * @return Country del usuario
     */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany(User::class, 'country_id');
    }
}