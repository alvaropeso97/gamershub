@extends('layouts.master')
@section('titulo', $id->titulo)

@section('contenido')
<section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="/">Portal</a></li>
            <li><a href="/">{{$id->getTipo()}}@if($id->tipo != "ana")s @endif </a></li>
            <li class="active">{{$id->titulo}}</li>
        </ol>
    </div>
</section>

<!-- Cabecera -->
@include('articles.article.widgets.header')

<section class="padding-top-50 padding-bottom-50 padding-top-sm-30">
    <div class="container">
        <div class="row sidebar">
            <div class="col-md-8 leftside">
                <!-- Artículo -->
                @include('articles.article.widgets.article_content')

                <!-- Comentarios -->
                @include('articles.article.widgets.comments')

            </div>

            <!-- Sidebar -->
            <div class="col-md-4 rightside">
                <!-- Búsqueda -->
                <div class="widget margin-bottom-35">
                    <div class="btn-inline">
                        <input type="text" class="form-control padding-right-40"  placeholder="Buscar...">
                        <button type="submit" class="btn btn-link color-grey-700 padding-top-10"><i class="fa fa-search"></i></button>
                    </div>
                </div>

                @if($id->tipo == "ana")
                    <!-- Análisis -->
                    @include('articles.article.widgets.review_sidebar')
                @else
                    @if($id->juego_rel != 0)
                        <!-- Juego relacionado -->
                        @include('articles.article.widgets.related_game')
                    @endif
                @endif

                <!-- Artículos recientes -->
                @include('articles.article.widgets.recent_comments')

            </div>
        </div>
    </div>
</section>

    @endsection