@extends('layouts.master')
@section('titulo', $juego->titulo.' - Noticias')

@section('contenido')
    <section class="hero height-350 hero-game" style="background-image: url('{{Config::get('constants.S1_URL')}}/juegos/cabeceras/{{$juego->img_header}}');">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="page-header">
                <div class="page-title">{{$juego->titulo}}</div>
                <ol class="breadcrumb">
                    <li><a href="#" class="no-padding-left">Inicio</a></li>
                    <li><a href="#">Juegos</a></li>
                    <li><a href="/juego/{{$juego->id}}/{{$juego->lnombre}}">{{$juego->titulo}}</a></li>
                    <li class="active">Noticias</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="bg-white no-padding hidden-xs border-bottom-1 border-grey-300" style="height: 54px">
        <div class="tab-select text-center sticky">
            <div class="container">
                <ul class="nav nav-tabs">
                    <li><a href="/juego/{{$juego->id}}/{{$juego->lnombre}}">{{$juego->titulo}}</a></li>
                    <li><a href="/juego/{{$juego->id}}/{{$juego->lnombre}}/analisis" ><i class="fa fa-star"></i> Análisis</a></li>
                    <li class="active"><a><i class="fa fa-pencil"></i> Noticias</a></li>
                    <li><a href="#"><i class="fa fa-image"></i> Imágenes</a></li>
                    <li><a href="#"><i class="fa fa-video-camera"></i> Vídeos</a></li>
                    <li><a href="#"><i class="fa fa-quote-left"></i> Foro del juego</a></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="bg-grey-50">
        <div class="container">
            @if(count($noticias) == 0)
                <div class="alert alert-danger">Este juego todavía no tiene noticias</div>
            @endif
            @php $contador = 1; @endphp
            @foreach($noticias as $articulo)
                @php $categorias = DB::select("select * from categorias where id in (select id_cat from categorias_articulos where cod_art=".$articulo->id.")"); @endphp
                @if($contador == 1 || $contador == 4 || $contador == 7)
                    <div class="row">
                        @endif
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="card">
                                <div class="card-img">
                                    <a href="/articulo/{{$articulo->id}}/{{$articulo->lnombre}}"><img style="border-radius: 10px 10px 0px 0px;-webkit-border-radius: 10px 10px 0px 0px;" src="{{Config::get('constants.S1_URL')}}/noticias/{{$articulo->img}}" alt=""></a>
                                    <div class="category">@foreach($categorias as $categoria) <a href="/categoria/{{$categoria->alias}}"><span  class="label" style="background:{{$categoria->color}};">{{$categoria->nombre}}</span></a> @endforeach</div>

                                    <div class="meta"><a href="/articulo/{{$articulo->id}}/{{$articulo->lnombre}}"></a></div>
                                </div>
                                <div class="caption" style="border-radius: 0px 0px 10px 10px;-webkit-border-radius: 0px 0px 10px 10px;">
                                    @if($articulo->tipo == "ana")
                                        @php $nota = $articulo->getAnalisis->getNotaMostrar() @endphp
                                        <span class="nota_analisis {{\App\Http\Controllers\AnalisisController::devolverColor($nota)}}">{{$nota}}</span>
                                    @endif
                                    <div class="tipo">{{$articulo->getTipo()}}</div>
                                    <h3 class="card-title"><a href="/articulo/{{$articulo->id}}/{{$articulo->lnombre}}">{{$articulo->titulo}}</a></h3>
                                    <ul><li>{{$articulo->fecha}}</li></ul>
                                    <p>{{$articulo->descripcion}}</p>
                                </div>
                            </div>
                        </div>
                        @if($contador == 3 || $contador == 6 || $contador == 9)
                    </div>
                @endif
                @php $contador++; @endphp
            @endforeach
            <div class="text-center"> {{$noticias->render()}} </div>
        </div>
    </section>

@endsection