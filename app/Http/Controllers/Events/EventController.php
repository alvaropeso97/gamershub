<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\BaseController;
use App\Models\Articles\Tag;
use App\Models\Events\Event;
use \Illuminate\Http\Request;

class EventController extends BaseController
{
    public function show($id, $seo_optimized_title) {
        //Obtener el evento a mostrar
        $event = Event::where('id', $id)->where('seo_optimized_title', $seo_optimized_title)->first();

        //Obtener noticias relacionadas con el evento
        $tags = Tag::where('name', '=', $event->related_tag)->get();
        $news = array();
        foreach ($tags as $tag) {
            array_push($news, $tag->article);
        }

        //Obtener comentarios relacionados con las noticias relacionadas con el evento
        $comments = array();
        $counter = 10;
        foreach ($news as $new) {
            foreach ($new->comments as $comment) {
                if ($counter >= 0) { //Solo cogemos 10 comentarios
                    array_push($comments, $comment);
                    $counter--;
                }
            }
        }

        return view('events.event.home', ['event' => $event, 'news' => $news, 'comments' => array_reverse($comments)]);
    }

    public function showRedirect($id) {
        $event = Event::find($id);
        return redirect()->route('events.show', ['id' => $event->id, 'seo_optimized_title' => $event->seo_optimized_title]);
    }

    public function getEventAjax(Request $request) {
        $id = $request->input( 'id' );
        $event = Event::find($id);
        return $event;
    }
}
