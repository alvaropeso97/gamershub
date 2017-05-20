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

namespace App\Http\Controllers\Articles;


use App\Http\Controllers\BaseController;
use App\Models\Articles\Review;
use App\Models\Articles\Article;
use App\Models\Articles\Tag;
use App\Exceptions\ArticuloNoEncontradoException;
use App\Models\Games\Game;
use App\Models\Articles\Video;
use DB;
use App\Http\Requests;
use Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Articles\StoreArticle;
use App\Http\Requests\Articles\UpdateArticle;
use Carbon\Carbon;

class ArticlesController extends BaseController
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id) {
        $article = Article::find($id);
        return view('admin.articles.addEdit', ['article' => $article]);
    }

    /**
     * @param StoreArticle $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreArticle $request) {
        $article = new Article();
        $article->user_id =  Auth::id();

        $gameId = $request->input('game_id');
        $game = null;
        if ($gameId != 0) {
            $game = Game::find($gameId);
            $article->game()->associate($game);
        }

        $article->type = $request->input('type');
        $article->title = $request->input('title');
        $article->description = $request->input('description');
        $article->content = $request->input('content');
        $article->seo_optimized_title = $request->input('seo_optimized_title');

        $nombre_img = self::sanear_string($request->file('image')->getClientOriginalName());
        $article->image = Carbon::now()->timestamp.$nombre_img;

        $article->save();

        $big = Image::make($request->file('image'))->resize(1600,900);
        Storage::disk('s3')->put("/articulos/".date("dmy")."/1600x900_$article->image", (string) $big->encode('jpg'));
        $med = Image::make($request->file('image'))->resize(950,534);
        Storage::disk('s3')->put("/noticias_rsz/950x534_$article->image", (string) $med->encode('jpg'));
        $smll = Image::make($request->file('image'))->resize(500,281);
        Storage::disk('s3')->put("/noticias_rsz/500x281_$article->image", (string) $smll->encode('jpg'));

        $article->categories()->attach($request->input('categories'));

        $tags = explode(',', $request->input('tags'));
        foreach ($tags as $tag) {
            $tagObject = new Tag();
            $tagObject->article()->associate($article);
            $tagObject->name = trim($tag);
            $tagObject->save();
        }

        if ($article->type == Article::TYPE_VIDEO) {
            $video = new Video();
            $video->article()->associate($article);
            $video->youtube_code = $request->input('youtube_code');
            $video->duration = $request->input('duration');
            $video->save();
        }

        if ($article->type == Article::TYPE_REVIEW) {
            $review = new Review();
            $review->article()->associate($article);
            $review->game()->associate($game);
            $review->gameplay_score = $request->input('gameplay_score');
            $review->graphics_score = $request->input('graphics_score');
            $review->sounds_score = $request->input('sounds_score');
            $review->innovation_score = $request->input('innovation_score');
            $review->save();
        }

        return redirect()->route('admin.articles.show', [$article]);
    }

    /**
     * @param $id
     * @param UpdateArticle $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateArticle $request) {
        $article = Article::find($id);
        $article->user_id =  Auth::id();

        $gameId = $request->input('game_id');
        $game = null;
        if ($gameId != 0) {
            $game = Game::find($gameId);
            $article->game()->dissociate();
            $article->game()->associate($game);
        }
        $article->type = $request->input('type');
        $article->title = $request->input('title');
        $article->description = $request->input('description');
        $article->content = $request->input('content');
        $article->seo_optimized_title = $request->input('seo_optimized_title');

        if ($request->file('image')) {
            $nombre_img = self::sanear_string($request->file('image')->getClientOriginalName());
            $article->image = Carbon::now()->timestamp.$nombre_img;
            $big = Image::make($request->file('image'))->resize(1600,900);
            Storage::disk('s3')->put("/noticias_rsz/1600x900_$article->image", (string) $big->encode('jpg'));
            $med = Image::make($request->file('image'))->resize(950,534);
            Storage::disk('s3')->put("/noticias_rsz/950x534_$article->image", (string) $med->encode('jpg'));
            $smll = Image::make($request->file('image'))->resize(500,281);
            Storage::disk('s3')->put("/noticias_rsz/500x281_$article->image", (string) $smll->encode('jpg'));
        }

        $article->save();

        $article->categories()->detach();
        $article->categories()->attach($request->input('categories'));

            $tags = $article->tags;
            foreach($tags as $tag) {
                $tag->article()->dissociate();
                $tag->save();
            }
            $tags = explode(',', $request->input('tags'));
            foreach ($tags as $tag) {
            $tagObject = new Tag();
            $tagObject->article()->associate($article);
            $tagObject->name = trim($tag);
            $tagObject->save();
        }

        //ToDo si hay un vídeo creado modifcarlo, si no crearlo
        if ($article->type == 2) {
            $video = new Video();
            $video->article()->dissociate();
            $video->article()->associate($article);
            $video->youtube_code = $request->input('youtube_code');
            $video->duration = $request->input('duration');
            $video->save();
        }

        //ToDo si hay un análisis creado modifcarlo, si no análisis
        if ($article->type == 3) {
            $review = new Review();
            $review->article()->dissociate();
            $review->game()->dissociate();
            $review->article()->associate($article);
            $review->game()->associate($game);
            $review->gameplay_score = $request->input('gameplay_score');
            $review->graphics_score = $request->input('graphics_score');
            $review->sounds_score = $request->input('sounds_score');
            $review->innovation_score = $request->input('innovation_score');
            $review->save();
        }
        return redirect()->route('admin.articles.show', [$article]);
    }

    /**
     * Muestra un listado de todos los artículos de tipo "art"
     * @return vista de paginas.noticias
     */
    public static function mostrarNoticias() {
        $cons =  Article::whereRaw('tipo = "art"')->orderBy('id','desc')->paginate(9);
        return view('layouts.paginas.noticias', ['cons' => $cons]);
    }

    /**
     * Muestra un listado de todos los artículos de tipo "art" ordenados de ascendentemente por el título
     * @return vista de paginas.noticias
     */
    public static function mostrarNoticiasAZ() {
        $cons =  Article::whereRaw('tipo = "art"')->orderBy('titulo','asc')->paginate(9);
        return view('layouts.paginas.noticias', ['cons' => $cons]);
    }

    /**
     * Muestra un artículo a través de su id y título, comprueba si es un análisis y si lo es lo muestra.
     * Si es un vídeo, envía a la vista los datos del vídeo
     * @param $id artículo a mostrar
     * @param $titulo título del artículo formateado
     * @return vista paginas.articulo
     * @throws ArticuloNoEncontradoException si no encuentra el artículo asociado con el id y el título
     */
    public static function mostrarArticulo($id, $titulo) {
        $articulo = Article::where('seo_optimized_title', $titulo)->where('id', $id)->first();
        if (!$articulo) {
            throw new ArticuloNoEncontradoException;
        } else {
            if ($articulo->tipo == 3) { //Comprobar si es un análisis y mostrarlo
                $juego = $articulo->game;
                return redirect("/juego/$juego->id/$juego->seo_optimized_title/analisis");
            } else {
                switch ($articulo->type) {
                    case 2:
                        return view('articles.article.article', ['id' => Article::findOrFail($articulo->id), 'vid' => $articulo->video]);
                        break;
                    case 0:
                        return view('articles.article.article', ['id' => Article::findOrFail($articulo->id)]);
                        break;
                }
            }
        }
    }

    /**
     * Muestra un artículo únicamente a través de su id, comprueba si es un análisis y si lo es lo muestra.
     * Redirige a la vista de la noticia con el id y el enlace formateado al igual que en mostrarArticulo()
     * @param $id artículo a mostrar
     * @return redirección a /articulo/id-articulo/titulo-formateado
     * @throws ArticuloNoEncontradoException si no encuentra el artículo asociado con el id
     */
    public static function mostrarArticuloDos ($id) {
        $articulo = Article::where('id', $id)->first();
        if (!$articulo) {
            throw new ArticuloNoEncontradoException;
        } else {
            if ($articulo->tipo == 3) { //Comprobar si es un análisis y mostrarlo
                $juego = DB::table('juegos')->where('id', $articulo->game)->first();
                return redirect("/juego/$juego->id/$juego->seo_optimized_title/analisis");
            } else {
                return redirect("/articulo/$id/$articulo->seo_optimized_title");
            }
        }
    }

    public static function devolverCantidadBusqueda($tag) {
        $cantidad['articulos'] = Article::where('titulo','LIKE',"%$tag%")->where('tipo','art')->get()->count();
        $cantidad['juegos'] = Game::where('titulo','LIKE',"%$tag%")->get()->count();
        $cantidad['analisis'] = Article::where('titulo','LIKE',"%$tag%")->where('tipo','ana')->get()->count();
        $cantidad['videos'] = Article::where('titulo','LIKE',"%$tag%")->where('tipo','vid')->get()->count();
        $cantidad['etiquetas'] = Tag::where('nombre','LIKE',"$tag")->get()->count();
        return $cantidad;
    }

    function mostrarBusqueda($tipo,$tag) {
        if ($tipo == 'articulos') {
            //Seleccionar todos los artículos que se asemejen a la búsqueda
            $busqueda_a = Article::where('titulo','LIKE',"%$tag%")->where('tipo','art')->orderBy('id','desc')->paginate(10);
            return view('layouts.paginas.busqueda', ['busq_a' => $busqueda_a, 'tag' => $tag, 'tipo' => $tipo]);
        }

        if ($tipo == 'videos') {
            $busqueda_v = Article::where('titulo','LIKE',"%$tag%")->where('tipo','vid')->orderBy('id','desc')->paginate(10);
            return view('layouts.paginas.busqueda', ['busq_a' => $busqueda_v, 'tag' => $tag, 'tipo' => $tipo]);
        }

        if ($tipo == 'analisis') {
            $busqueda_an = Article::where('titulo','LIKE',"%$tag%")->where('tipo','ana')->orderBy('id','desc')->paginate(10);
            return view('layouts.paginas.busqueda', ['busq_a' => $busqueda_an, 'tag' => $tag, 'tipo' => $tipo]);
        }

        if ($tipo == 'juegos') {
            $busqueda_j = Game::where('titulo','LIKE',"%$tag%")->orderBy('id','desc')->paginate(9);
            return view('layouts.paginas.busqueda_juegos', ['busq_j' => $busqueda_j, 'tag' => $tag, 'tipo' => $tipo]);
        }

        if ($tipo == 'etiquetas') {
            $art_etiq = TagsController::devolverArticulosEtiqueta($tag);
            $busqueda_a = Article::whereIn('id',$art_etiq)->orderBy('id','desc')->paginate(10);
            return view('layouts.paginas.busqueda', ['busq_a' => $busqueda_a, 'tag' => $tag, 'tipo' => $tipo]);
        }
    }
}