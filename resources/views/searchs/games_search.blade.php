@extends('layouts.master')
@section('titulo', "Buscar juego - ".$tag)

@section('contenido')
    <section class="hero">
        <div class="hero-bg-primary" style="background: #a3112e; opacity: 0.9;"></div>
        <div class="container">
            <div class="page-header">
                <div class="page-title">Búsqueda</div>
                <ol class="breadcrumb">
                    <li><a href="/" class="no-padding-left">Inicio</a></li>
                    <li><a href="/busqueda/{{$tag}}">Búsqueda</a></li>
                    <li><a href="#">Juegos</a></li>
                    <li class="active">{{$tag}}</li>
                </ol>
            </div>
        </div>
    </section>

    @php $cant = \App\Http\Controllers\ArticlesController::devolverCantidadBusqueda($tag); @endphp
    <section class="bg-white no-padding hidden-xs border-bottom-1 border-grey-300" style="height: 54px">
        <div class="tab-select text-center sticky">
            <div class="container">
                <ul class="nav nav-tabs">
                    <li @if($tipo == 'articulos') class="active" @endif><a href="/busqueda/articulos/{{$tag}}">Noticias ({{$cant['articulos']}})</a></li>
                    <li @if($tipo == 'analisis') class="active" @endif><a href="/busqueda/analisis/{{$tag}}">Análisis ({{$cant['analisis']}})</a></li>
                    <li @if($tipo == 'videos') class="active" @endif><a href="/busqueda/videos/{{$tag}}">Vídeos ({{$cant['videos']}})</a></li>
                    <li @if($tipo == 'juegos') class="active" @endif><a href="/busqueda/juegos/{{$tag}}">Juegos ({{$cant['juegos']}})</a></li>
                    <li @if($tipo == 'etiquetas') class="active" @endif><a href="/busqueda/etiquetas/{{$tag}}">Etiquetas ({{$cant['etiquetas']}})</a></li>
                </ul>
            </div>
        </div>
    </section>

    <section @if($cant[$tipo] == 0) class="error-404" @else class="bg-grey-50 padding-top-30" @endif>
        <div class="container">
            @if($cant[$tipo] == 0)
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <div class="title">
                            <h4><i class="fa fa-bug"></i> Sin resultados...</h4>
                        </div>
                        <p>No se ha encontrado ningún elemento relacionado con '{{$tag}}' en {{$tipo}}.</p>
                        <form>
                            <div class="col-lg-8 pull-none display-inline-block">
                                <div class="btn-inline">
                                    <input type="text" class="form-control input-lg padding-right-40" placeholder="Buscar de nuevo...">
                                    <button type="submit" class="btn btn-link color-grey-700 padding-top-10"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <a href="/" class="btn btn-primary btn-lg margin-top-20 btn-shadow btn-rounded">Página principal</a>
                    </div>
                    <div class="col-lg-5 height-300">
                        <img src="/img/content/error_busq.png" class="image-right" alt="">
                    </div>
                </div>
            @else
        @php($contador = 0)
        @foreach($busq_j as $juego)
            @php($contador++)
            @if($contador == 1 || $contador == 4 || $contador == 7)
            <div class="row">
            @endif
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="card card-game card-primary">
                        <div class="card-header">@foreach(\App\Http\Controllers\GamesController::devolverPlataformas($juego->id) as $plataforma){{$plataforma->nombre}}@endforeach</div>
                        <div class="card-img">
                            <a href="/juego/{{$juego->id}}/{{$juego->lnombre}}"><img src="{{Config::get('constants.S1_URL')}}/juegos/img/{{$juego->img_box}}" alt=""></a>
                            <div class="category"><span class="label label-success">En venta</span>
                            </div>
                            <div class="meta"><a href="/juego/{{$juego->id}}/{{$juego->lnombre}}">
                            </div>
                        </div>
                        <div class="caption">
                            <h3 class="card-title"><a href="/juego/{{$juego->id}}/{{$juego->lnombre}}">{{$juego->titulo}}</a></h3>
                        </div>
                    </div>
                </div>
                @if($contador == 3 || $contador == 6 || $contador == 9)
            </div>
                @endif
            @endforeach
            <div class="row">
                <div class="col-lg-12 text-center">
                    {{$busq_j->render()}}
                </div>
            </div>
            @endif
        </div>
    </section>
@endsection