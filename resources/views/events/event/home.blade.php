@extends('master')
@section('titulo', $event->title)
@section('contenido')
    <section class="hero" style="background-image: url(https://www.e3expo.com/2017/img/e3-header-background.jpg);" id="event_header">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="page-header">
                <div class="page-title" id="cuenta_atras">{{$event->title}}</div>
                <ol class="breadcrumb">
                    <li><a href="index.html" class="no-padding-left">Inicio</a></li>
                    <li><a href="#">Eventos</a></li>
                    @if(isset($event->parent_event_id))<li><a href="#">{{$event->event->title}}</a></li>@endif
                    <li class="active">{{$event->title}}</li>
                </ol>
            </div>
        </div>
    </section>

    <div id="event_streaming">

    </div>

    <div class="elements">
        <div class="container">
            <div class="headline">
                <h4>Información {{$event->title}}</h4>
            </div>
            <div class="well">{!! $event->description !!}</div>
        </div>
    </div>

    @if(count($event->events) > 0)
    <div class="container margin-top-30 margin-bottom-30">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h4><i class="fa fa-video-camera"></i>Emisiones en directo</h4>
                </div>
                @foreach($event->events as $childEvent)
                <div class="post post-md">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="post-thumbnail">
                                <a href="#"><img src="http://www.xboxoneuk.com/wp-content/uploads/2016/07/Xbox-One-E3-2016.jpg" alt=""></a>
                                <div class="post-caption">{{$childEvent->getType()}}</div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="post-header">
                                <div class="post-title">
                                    <h4><a href="/evento/{{$childEvent->id}}/{{$childEvent->seo_optimized_title}}">{{$childEvent->title}}</a></h4>
                                    <ul class="post-meta">
                                        <i class="fa fa-calendar-o"></i>{{\App\Http\Controllers\Events\EventController::fechaHora($childEvent->start_date)}}
                                    </ul>
                                </div>
                            </div>
                            {!! $childEvent->description !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <section>
        <div class="container">
            <div class="row sidebar">
                <div class="col-md-8 leftside">
                    @foreach($news as $article)
                        <div class="post post-md">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="post-thumbnail">
                                        <a href="/articulo/{{$article->id}}/{{$article->seo_optimized_name}}"><img src="{{$article->getImageUrl('md')}}" alt=""></a>
                                        <div class="meta"><a href="/articulo/{{$article->id}}/{{$article->seo_optimized_name}}"><i class="fa fa-comments"></i> <span>{{count($article->comments)}}</span></a></div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="post-header">
                                        <div class="post-title">
                                            <div class="tipo">{{$article->getType()}}</div>
                                            <h4><a href="/articulo/{{$article->id}}/{{$article->seo_optimized_name}}">{{$article->title}}</a></h4>
                                            <ul class="post-meta">
                                                <li><a href="/usuario/{{$article->user->nickname}}"><i class="fa fa-user"></i> {{$article->user->name}} {{$article->user->surname}}</a></li>
                                                <li><i class="fa fa-clock-o"></i>{{$article->getFecha()}}</li>
                                                <li>@foreach($article->categories as $category) <a href="/categoria/{{$category->alias}}"><span  class="label" style="color:{{$category->color}};">{{$category->name}}</span></a> @endforeach</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p>{{$article->description}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-4 rightside">
                    <div class="widget margin-bottom-35">
                        <div class="btn-inline">
                            <input type="text" class="form-control padding-right-40" placeholder="Buscar...">
                            <button type="submit" class="btn btn-link color-grey-700 padding-top-10"><i class="fa fa-search"></i></button>
                        </div>
                    </div>

                    <div class="widget widget-list">
                        <div class="title">Comentarios recientes</div>
                        <ul>
                            @foreach($comments as $comment)
                            <li>
                                <a href="#" class="thumb"><img src="{{$comment->user->avatar}}" alt=""></a>
                                <div class="widget-list-meta">
                                    <h4 class="widget-list-title"><a href="#">{{$comment->article->title}}</a></h4>
                                    <p><i class="fa fa-clock-o"></i> {{$comment->getFecha()}}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="widget">
                        <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/hashtag/{{$event->twitter_hashtag}}" data-widget-id="{{$event->twitter_widget_id}}">Tweets sobre #E32017</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
            $('#event_streaming').hide();
            @if($event->type == \App\Models\Events\Event::TYPE_STREAMING)
                @if(strtotime($event->start_date) > time())
                    countDownEvent({{strtotime($event->start_date)}}, {{$event->id}});
                @else
                    @if(strtotime($event->end_date) > time())
                        countDownEvent({{strtotime($event->start_date)}}, {{$event->id}});
                    @else
                        $("#cuenta_atras").html("La emisión en directo ha finalizado");
                    @endif
                @endif
            @endif
    </script>
@endsection