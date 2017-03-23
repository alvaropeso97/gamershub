@extends('layouts.master')
@section('titulo', 'GamersHUB - Todas las noticias')

@section('contenido')
    @php $cons =  \App\Articulo::whereRaw('tipo = "ana"')->orderBy('id','desc')->paginate(3); @endphp
    <section class="hero hero-games height-300">
        <div class="hero-bg bg-primary" style="background-color: #fff;"></div>
        <div class="container">
            <div class="page-header">
                <div class="page-title bold"><a href="games-single.html">Archivo de análisis</a></div>
                <p>Trabajamos diariamente para traerte las últimas noticias y no te pierdas nada.</p>
            </div>
        </div>
    </section>

    <!-- BÚSQUEDA CATEGORÍA -->
    <section class="padding-top-25 no-padding-bottom border-bottom-1 border-grey-300">
        <div class="container">
            <div class="headline">
                <h4>Buscar en noticias</h4>
                <div class="btn-group pull-right">
                    <a href="#" class="btn btn-default"><i class="fa fa-th-large no-margin"></i></a>
                    <a href="#" class="btn btn-default"><i class="fa fa-bars no-margin"></i></a>
                </div>

                <input type="text" class="form-control hidden-xs" placeholder="Buscar artículo...">

                <div class="dropdown">
                    <a href="#" class="btn btn-default btn-icon-left btn-icon-right dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sort-amount-desc"></i> Ordenar por <i class="ion-android-arrow-dropdown"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Fecha</a></li>
                        <li><a href="#">Valoraciones</a></li>
                        <li><a href="#">A-Z</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ARTÍCULOS -->
    <section class="bg-grey-50">
        <div class="container">
            <div class="row">
                @foreach($cons as $articulo)
                    @php $categorias = DB::select("select * from categorias where id in (select id_cat from categorias_articulos where cod_art=".$articulo->id.")"); @endphp
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="card-img">
                                <a href="/articulo/{{$articulo->id}}/{{$articulo->lnombre}}"><img style="border-radius: 10px 10px 0px 0px;-webkit-border-radius: 10px 10px 0px 0px;" src="/archivos_subidos/noticias/{{$articulo->img}}" alt=""></a>
                                <div class="category">@foreach($categorias as $categoria) <a href="/categoria/{{$categoria->alias}}"><span  class="label" style="background:{{$categoria->color}};">{{$categoria->nombre}}</span></a> @endforeach</div>

                                <div class="meta"><a href="/articulo/{{$articulo->id}}/{{$articulo->lnombre}}"><i class="fa fa-heart-o"></i> <span>15</span></a></div>
                            </div>
                            <div class="caption" style="border-radius: 0px 0px 10px 10px;-webkit-border-radius: 0px 0px 10px 10px;">
                                @if($articulo->tipo == "ana")
                                    @php $nota = \App\Http\Controllers\AnalisisController::devolverNota($articulo->id) @endphp
                                    <span class="nota_analisis {{\App\Http\Controllers\AnalisisController::devolverColor($nota)}}">{{$nota}}</span>
                                @endif
                                <div class="tipo">{{$articulo->getTipo()}}</div>
                                <h3 class="card-title"><a href="/articulo/{{$articulo->id}}/{{$articulo->lnombre}}">{{$articulo->titulo}}</a></h3>
                                <ul><li>{{$articulo->fecha}}</li></ul>
                                <p>{{$articulo->descripcion}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center"> {{$cons->render()}} </div>
        </div>
    </section>

@endsection