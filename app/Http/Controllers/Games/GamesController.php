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

namespace App\Http\Controllers\Games;


use App\Http\Controllers\BaseController;
use App\Review;
use App\Exceptions\JuegoNoEncontradoException;
use App\Models\Games\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Games\StoreGame;
use App\Http\Requests\Games\UpdateGame;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Auth;
use App\Http\Requests;

class GamesController extends BaseController
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id) {
        $game = Game::find($id);
        return view('admin.games.addEdit', ['game' => $game]);
    }

    /**
     * @param StoreGame $request
     */
    public function store(StoreGame $request) {
        $game = new Game();
        $game->title = $request->input('title');
        $game->seo_optimized_title = $request->input('seo_optimized_title');
        $game->description = $request->input('desc');
        $game->available_on = $request->input('available_on');
        $game->players_quantity = $request->input('players_quantity');
        $game->duration = $request->input('duration');
        $game->language = $request->input('language');
        $game->release_date = self::fechaMysql($request->input('release_date'));

        $header_image_name = self::sanear_string($request->file('header_image')->getClientOriginalName());
        $game->header_image = Carbon::now()->timestamp.$header_image_name;
        $boxed_image_name = self::sanear_string($request->file('boxed_image')->getClientOriginalName());
        $game->boxed_image = Carbon::now()->timestamp.$boxed_image_name;
        $game->save();

        $game->categories()->attach($request->input('categories'));
        $game->developers()->attach($request->input('developers'));
        $game->distributors()->attach($request->input('distributors'));
        $game->genres()->attach($request->input('genres'));

        //HEADER IMAGE
        $big = Image::make($request->file('header_image'))->resize(1600,900);
        Storage::disk('s3')->put("/juegos/".$game->id."/cabeceras/1600x900_$game->header_image", (string) $big->encode('jpg'));
        $med = Image::make($request->file('header_image'))->resize(950,534);
        Storage::disk('s3')->put("/juegos/".$game->id."/cabeceras/950x534_$game->header_image", (string) $med->encode('jpg'));
        $smll = Image::make($request->file('header_image'))->resize(500,281);
        Storage::disk('s3')->put("/juegos/".$game->id."/cabeceras/500x281_$game->header_image", (string) $smll->encode('jpg'));

        //BOXED IMAGE
        $big = Image::make($request->file('boxed_image'))->resize(1600,900);
        Storage::disk('s3')->put("/juegos/".$game->id."/caratulas/1600x900_$game->boxed_image", (string) $big->encode('jpg'));
        $med = Image::make($request->file('boxed_image'))->resize(950,534);
        Storage::disk('s3')->put("/juegos/".$game->id."/caratulas/950x534_$game->boxed_image", (string) $med->encode('jpg'));
        $smll = Image::make($request->file('boxed_image'))->resize(500,281);
        Storage::disk('s3')->put("/juegos/".$game->id."/caratulas/500x281_$game->boxed_image", (string) $smll->encode('jpg'));

        echo "Correcto";
    }

    /**
     * @param $id
     * @param UpdateGame $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateGame $request) {
        $game = Game::find($id);
        $game->title = $request->input('title');
        $game->seo_optimized_title = $request->input('seo_optimized_title');
        $game->description = $request->input('desc');

        $game->genres()->detach();
        $game->genres()->attach($request->input('genres'));

        $game->developers()->detach();
        $game->developers()->attach($request->input('developers'));

        $game->distributors()->detach();
        $game->distributors()->attach($request->input('distributors'));

        $game->categories()->detach();
        $game->categories()->attach($request->input('categories'));

        $game->available_on = $request->input('available_on');
        $game->players_quantity = $request->input('players_quantity');
        $game->duration = $request->input('duration');
        $game->language = $request->input('language');
        $game->release_date = self::fechaMysql($request->input('release_date'));

        if ($request->file('header_image')) {
            $header_image_name = self::sanear_string($request->file('header_image')->getClientOriginalName());
            $game->header_image = Carbon::now()->timestamp.$header_image_name;

            //HEADER IMAGE
            $big = Image::make($request->file('header_image'))->resize(1600,900);
            Storage::disk('s3')->put("/juegos/".$game->id."/cabeceras/1600x900_$game->header_image", (string) $big->encode('jpg'));
            $med = Image::make($request->file('header_image'))->resize(950,534);
            Storage::disk('s3')->put("/juegos/".$game->id."/cabeceras/950x534_$game->header_image", (string) $med->encode('jpg'));
            $smll = Image::make($request->file('header_image'))->resize(500,281);
            Storage::disk('s3')->put("/juegos/".$game->id."/cabeceras/500x281_$game->header_image", (string) $smll->encode('jpg'));
        }

        if ($request->file('boxed_image')) {
            $boxed_image_name = self::sanear_string($request->file('boxed_image')->getClientOriginalName());
            $game->boxed_image = Carbon::now()->timestamp.$boxed_image_name;

            //BOXED IMAGE
            $big = Image::make($request->file('boxed_image'))->resize(1600,900);
            Storage::disk('s3')->put("/juegos/".$game->id."/caratulas/1600x900_$game->boxed_image", (string) $big->encode('jpg'));
            $med = Image::make($request->file('boxed_image'))->resize(950,534);
            Storage::disk('s3')->put("/juegos/".$game->id."/caratulas/950x534_$game->boxed_image", (string) $med->encode('jpg'));
            $smll = Image::make($request->file('boxed_image'))->resize(500,281);
            Storage::disk('s3')->put("/juegos/".$game->id."/caratulas/500x281_$game->boxed_image", (string) $smll->encode('jpg'));
        }

        $game->save();
        return redirect()->route('admin.games.show', [$game]);
    }

    /**
     * @param Request $request
     */
    public function destroy(Request $request) {
        $response = array(
            'status' => 'success',
            'id' => $request->id,
        );
        $game = Game::find($response['id']);
        $game->delete();
    }

    public function getGameAjax(\Illuminate\Http\Request $request) {
        $id = $request->input( 'id' );
        $game = Game::find($id);
        return $game;
    }

    /**
     * Muestra un juego a través de su id y su título
     * @param $id del juego
     * @param $titulo del juego
     * @return vista paginas.juego
     * @throws JuegoNoEncontradoException si no encuentra el juego asociado con el id y el título
     */
    public function mostrarJuego($id, $titulo) {
        $juego = Game::where('lnombre', $titulo)->where('id', $id)->first();
        if (!$juego) {
            throw new JuegoNoEncontradoException;
        } else {
            return view('layouts.paginas.juego', ['id' => Game::findOrFail($juego->id)]);
        }
    }

    /**
     * Muestra un juego a través de su id redirigiendo a la página /juego/id/lnombre
     * @param $id del juego
     * @return vista paginas.juego
     * @throws JuegoNoEncontradoException si no encuentra el juego asociado con el id y el título
     */
    public function mostrarJuegoDos ($id) {
        $juego = Game::where('id', $id)->first();
        if (!$juego) {
            throw new JuegoNoEncontradoException;
        } else {
            return redirect("/juego/$id/$juego->lnombre");
        }
    }

    public function mostrarAnalisis($id, $titulo) {
        $analisis = Review::where('juego', $id)->first();
        $juego = DB::table('juegos')->where('lnombre', $titulo)->where('id', $id)->first();
        if (count($analisis) == 1) { //El juego tiene análisis
            $articulo = DB::table('articulos')->where('tipo', 'ana')->where('juego_rel', $id)->first();
            return view('layouts.paginas.juego_analisis', ['id' => Game::findOrFail($id), 'analisis' => $analisis, 'articulo' => $articulo]);
        } else {
            return redirect("/juego/$id/$juego->lnombre")->with('mensaje', 'Este juego todavía no ha sido analizado.');
        }
    }

    public function mostrarNoticias($id, $titulo) {
        $juego = DB::table('juegos')->where('lnombre', $titulo)->where('id', $id)->first();
        $noticias = DB::table('articulos')->where('juego_rel', $id)->where('tipo', 'art')->paginate(9);
        return view('layouts.paginas.juego_noticias', ['noticias' => $noticias, 'juego' => $juego]);
    }

    public static function getNextReleases() {
        return Game::whereDate('release_date', '>', Carbon::today()->toDateString())->get();
    }
}