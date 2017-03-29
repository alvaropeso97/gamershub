@extends('layouts.master')
@section('titulo', 'Todos los vídeos - '.\App\ConfigGeneral::first()->nombre_aplicacion)
@php $cons =  \App\Articulo::whereRaw('tipo = "vid"')->orderBy('id','desc')->paginate(16); @endphp
@section('contenido')

    <!-- PRIMER VÍDEO -->
    @php $ultimo_video = \App\Video::orderBy('id', 'DESC')->first(); @endphp
    <div class="background-image" style="background-image: url(http://img.youtube.com/vi/{{$ultimo_video->cod_yt}}/maxresdefault.jpg);">
        <span class="background-overlay"></span>
        <div class="container">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$ultimo_video->cod_yt}}?rel=0&amp;showinfo=0" allowfullscreen=""></iframe>
            </div>
        </div>
    </div>
    <!-- FIN PRIMER VÍDEO -->

    <!-- BARRA DE BÚSQUEDA -->
    <section class="padding-top-20 padding-bottom-20 border-bottom-1 border-grey-300">
        <div class="container">
            <div class="headline no-margin">
                <h4><i class="fa fa-film"></i> Vídeos recientes</h4>
                <div class="btn-group pull-right">
                    <a href="#" class="btn btn-default"><i class="fa fa-th-large no-margin"></i></a>
                    <a href="#" class="btn btn-default"><i class="fa fa-bars no-margin"></i></a>
                </div>

                <input type="text" class="form-control hidden-xs" placeholder="Buscar Video...">

                <div class="dropdown">
                    <a href="#" class="btn btn-default btn-icon-left btn-icon-right dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gamepad"></i> Plataforma <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        @foreach(\App\Categoria::where('esplataforma','1')->get() as $plataforma)
                            <li><a href="#" style="color: {{$plataforma->color}};">{{$plataforma->nombre}}</a></li>
                        @endforeach

                    </ul>
                </div>

                <div class="dropdown">
                    <a href="#" class="btn btn-default btn-icon-left btn-icon-right dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sort-amount-desc"></i> Ordenar por <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Fecha</a></li>
                        <li><a href="#">A-Z</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!-- barra de busqueda -->

    <!-- LISTADO DE VIDEOS -->
    <section class="bg-grey-50">
        <div class="container">
            <div class="card-group">
                <div class="row">
                    @foreach($cons as $video)
                        @php $vid = $video->getVideo @endphp
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="card card-video">
                            <div class="card-img">
                                <a href="/articulo/{{$video->id}}/{{$video->lnombre}}"><img src="{{Config::get('constants.S1_URL')}}/noticias/{{$video->img}}" alt=""></a>
                                <div class="time">{{$vid->dur}}</div>
                            </div>
                            <div class="caption">
                                <h3 class="card-title"><a href="/articulo/{{$video->id}}/{{$video->lnombre}}">{{$video->titulo}}</a></h3>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i> {{\App\Http\Controllers\ArticulosController::traducirFecha($video->fecha)}}</li>
                                    <li><i class="fa fa-eye"></i> {{$vid->visitas}}</li>
                                </ul>
                                <p>{{$video->descripcion}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection