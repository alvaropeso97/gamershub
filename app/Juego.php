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
use App\Http\Controllers\TS3Server;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Esta clase es el modelo de la tabla "juegos" de la base de datos
 * Class Juego
 * @package App
 */
class Juego extends Model
{
    protected $table = 'juegos';
    protected $fillable = ['id','titulo','caratula','descripcion','dispo_en','desarrollador','distribuidor','jugadores','duracion','idioma','fecha_lanzamiento','img_header','img_box','lnombre'];
    public $timestamps = false;

    /**
     * Clave ajena "juego_rel", referencia a "id" (juegos)
     * @return articulos pertenecientes a este juego
     */
    public function getArticulos() {
        return $this->hasMany('App\Articulo', 'juego_rel', 'id');
    }

    public function setImgheaderAttribute($img_header) {
        $this->attributes['img_header'] = Carbon::now()->second.$img_header->getClientOriginalName();
        $name = $this->attributes['img_header'] = Carbon::now()->second.$img_header->getClientOriginalName();
        \Storage::disk('s3')->put("/juegos/cabeceras/$name", \File::get($img_header));
    }

    public function setCaratulaAttribute($caratula) {
        $this->attributes['caratula'] = Carbon::now()->second.$caratula->getClientOriginalName();
        $name = $this->attributes['caratula'] = Carbon::now()->second.$caratula->getClientOriginalName();
        \Storage::disk('s3')->put("/juegos/caratulas/$name", \File::get($caratula));
    }

    public function setImgboxAttribute($img_box) {
        $this->attributes['img_box'] = Carbon::now()->second.$img_box->getClientOriginalName();
        $name = $this->attributes['img_box'] = Carbon::now()->second.$img_box->getClientOriginalName();
        \Storage::disk('s3')->put("/juegos/img/$name", \File::get($img_box));
    }

}