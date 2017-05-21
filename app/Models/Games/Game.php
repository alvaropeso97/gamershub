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

namespace App\Models\Games;
use App\Models\Articles\Article;
use App\Models\Articles\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

/**
 * Esta clase es el modelo de la tabla "juegos" de la base de datos
 * Class Game
 * @package App
 */
class Game extends Model
{
    //ToDo Documentar funciones
    protected $table = 'games';
    protected $fillable = ['title','description','available_on','players_quantity','duration','language',
        'release_date','header_image','boxed_image'];
    public $timestamps = true;

    /**
     * Clave ajena "juego_rel", referencia a "id" (juegos)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany articulos pertenecientes a este juego
     */
    public function articles() {
        return $this->hasMany(Article::class, 'game_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories() {
        return $this->belongsToMany(Category::class, 'games_categories');
    }

    /**
     * @return array
     */
    public function categoriesArray() {
        $categoriesArray = array();
        $categories = $this->categories;
        foreach ($categories as $category) {
            $categoriesArray[] = $category->id;
        }
        return $categoriesArray;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function developers() {
        return $this->belongsToMany(Developer::class, 'games_developers');
    }

    /**
     * @return array
     */
    public function developersArray() {
        $developersArray = array();
        $developers = $this->developers;
        foreach ($developers as $developer) {
            $developersArray[] = $developer->id;
        }
        return $developersArray;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function distributors() {
        return $this->belongsToMany(Distributor::class, 'games_distributors');
    }

    /**
     * @return array
     */
    public function distributorsArray() {
        $distributorsArray = array();
        $distributors = $this->distributors;
        foreach ($distributors as $distributor) {
            $distributorsArray[] = $distributor->id;
        }
        return $distributorsArray;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres() {
        return $this->belongsToMany(Genre::class, 'games_genres');
    }

    /**
     * @return array
     */
    public function genresArray() {
        $genresArray = array();
        $genres = $this->genres;
        foreach ($genres as $genre) {
            $genresArray[] = $genre->id;
        }
        return $genresArray;
    }

    /**
     * @param $size
     * @return string
     */
    public function getHeaderImageUrl($size) {
        switch ($size) {
            case "sm":
                return Config::get('constants.S1_URL')."/juegos/".$this->id."/cabeceras/500x281_".$this->header_image;
                break;
            case "md":
                return Config::get('constants.S1_URL')."/juegos/".$this->id."/cabeceras/950x534_".$this->header_image;
                break;
            case "lg":
                return Config::get('constants.S1_URL')."/juegos/".$this->id."/cabeceras/1600x900_".$this->header_image;
                break;
        }
    }

    /**
     * @param $size
     * @return string
     */
    public function getBoxedImageUrl($size) {
        switch ($size) {
            case "sm":
                return Config::get('constants.S1_URL')."/juegos/".$this->id."/caratulas/500x281_".$this->boxed_image;
                break;
            case "md":
                return Config::get('constants.S1_URL')."/juegos/".$this->id."/caratulas/950x534_".$this->boxed_image;
                break;
            case "lg":
                return Config::get('constants.S1_URL')."/juegos/".$this->id."/caratulas/1600x900_".$this->boxed_image;
                break;
        }
    }
}