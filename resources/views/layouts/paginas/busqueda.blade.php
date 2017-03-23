@extends('layouts.master')
@section('titulo', "Buscar ".$tipo." - ".$tag)

@section('contenido')
    <section class="hero">
        <div class="hero-bg-primary" style="background: #a3112e; opacity: 0.9;"></div>
        <div class="container">
            <div class="page-header">
                <div class="page-title">Búsqueda</div>
                <ol class="breadcrumb">
                    <li><a href="/" class="no-padding-left">Inicio</a></li>
                    <li><a href="#">Búsqueda</a></li>
                    <li><a href="#">{{$tipo}}</a></li>
                    <li class="active">{{$tag}}</li>
                </ol>
            </div>
        </div>
    </section>

    @php $cant = \App\Http\Controllers\ArticulosController::devolverCantidadBusqueda($tag); @endphp
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
        @foreach($busq_a as $noticia)
            @php $autor = DB::table('users')->where('id', $noticia->id_autor)->first(); @endphp
            <!-- Artículo -->
                <div class="post post-md">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="post-thumbnail">
                                <a href="/articulo/{{$noticia->id}}/{{$noticia->lnombre}}"><img src="{{Config::get('constants.S1_URL')}}/noticias/{{$noticia->img}}" alt=""></a>
                                <div class="meta"><a href="/articulo/{{$noticia->id}}/{{$noticia->lnombre}}"><i class="fa fa-comments"></i> <span></span></a></div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="post-header">
                                @if($noticia->tipo == "ana")
                                    @php $nota = \App\Http\Controllers\AnalisisController::devolverNota($noticia->id) @endphp
                                    <span class="nota_analisis {{\App\Http\Controllers\AnalisisController::devolverColor($nota)}}">{{$nota}}</span>
                                @endif
                                <div class="post-title">
                                    <div class="tipo">{{\App\Http\Controllers\ArticulosController::devolverTipo($noticia->tipo)}}</div>
                                    <h4><a href="/articulo/{{$noticia->id}}/{{$noticia->lnombre}}">{{$noticia->titulo}}</a></h4>
                                    <ul class="post-meta">
                                        <li><a href="/usuario/{{$autor->name}}"><i class="fa fa-user"></i> {{$autor->nombre}} {{$autor->apellidos}}</a></li>
                                        <li><i class="fa fa-clock-o"></i>{{$noticia->getFecha}}</li>
                                        <li>@foreach($noticia->getCategorias as $categoria) <a href="/categoria/{{$categoria->alias}}"><span  class="label" style="color:{{$categoria->color}};">{{$categoria->nombre}}</span></a> @endforeach</li>
                                    </ul>
                                </div>
                            </div>
                            <p>{{$noticia->descripcion}}</p>
                        </div>
                    </div>
                </div>
                <!-- Fin Artículo -->
            @endforeach
            <div class="row">
                <div class="col-lg-12 text-center">
                    {{$busq_a->render()}}
                </div>
            </div>
            @endif
        </div>
    </section>
@endsection