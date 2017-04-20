<?php

namespace App\Http\Controllers;

use App\Articulo;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class FeedController extends Controller
{
    public function show() {
        $feed = App::make("feed");
        $feed->setCache(0);

        if (!$feed->isCached())
        {
            $articulos = Articulo::all()->sortByDesc('id')->take(20);

            $feed->title = 'GamersHUB';
            $feed->description = 'Actualidad y novedades de videojuegos, comunidad gamer, servicios para jugadores';
            $feed->logo = 'http://www.gamershub.es/img/logo_dark.png';
            $feed->link = url('feed/rss');
            $feed->setDateFormat('datetime');
            $feed->pubdate = Articulo::all()->sortByDesc('id')->first()->fecha;
            $feed->lang = 'es';
            $feed->setShortening(true);
            $feed->setTextLimit(100);

            foreach ($articulos as $articulo)
            {
                $imagen = Config::get('constants.S1_URL').'/noticias_rsz/500x281_'.$articulo->img;
                $link = 'http://www.gamershub.es/articulo/'.$articulo->id;
                $contenido = "<img src=\"$imagen\" alt=\"$articulo->titulo\"/><p>".substr($articulo->descripcion, 0, 500)."...</p><p><a href='$link'>Leer más</a></p>";
                $feed->add($articulo->titulo,$articulo->getAutor->name,$link,$articulo->fecha,$articulo->titulo,$contenido);
            }

        }
        return $feed->render('atom');
    }
}
