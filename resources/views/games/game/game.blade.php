@extends('layouts.master')
@section('titulo', $id->titulo)

@section('contenido')
    <section class="hero height-350 hero-game" style="background-image: url('{{Config::get('constants.S1_URL')}}/juegos/cabeceras/{{$id->img_header}}');">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="page-header">
                <div class="page-title">{{$id->titulo}}</div>
                <ol class="breadcrumb">
                    <li><a href="/" class="no-padding-left">Inicio</a></li>
                    <li><a href="#">Juegos</a></li>
                    <li class="active">{{$id->titulo}}</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="bg-white no-padding hidden-xs border-bottom-1 border-grey-300" style="height: 54px">
        <div class="tab-select text-center sticky">
            <div class="container">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#">{{$id->titulo}}</a></li>
                    <li><a href="/juego/{{$id->id}}/{{$id->lnombre}}/analisis"><i class="fa fa-star"></i> Análisis</a></li>
                    <li><a href="/juego/{{$id->id}}/{{$id->lnombre}}/noticias"><i class="fa fa-pencil"></i> Noticias</a></li>
                    <li><a href="#"><i class="fa fa-image"></i> Imágenes</a></li>
                    <li><a href="#"><i class="fa fa-video-camera"></i> Vídeos</a></li>
                    <li><a href="#"><i class="fa fa-quote-left"></i> Foro del juego</a></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="bg-grey-50 padding-top-30">
        <div class="container">
            @if(Session::has('mensaje')) <div class="alert alert-danger"> {{Session::get('mensaje')}} </div> @endif
            <div class="row sidebar">
                <div class="col-md-8 padding-right-20 leftside">
                    <!-- Artículos recientes -->
                    @include('games.game.widgets.articulos_recientes')
                </div>
                <div class="col-md-4 padding-left-20 rightside">
                    <!-- Info Juego -->
                    @include('games.game.widgets.info_juego')

                    <!-- Noticias/Comentarios/Foros -->

                    <!-- Vídeos relacionados -->
                    @include('games.game.widgets.videos_relacionados')
                </div>
            </div>
        </div>
    </section>
@endsection