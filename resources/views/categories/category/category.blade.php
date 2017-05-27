@extends('master')
@section('titulo', $categoria->name)

@section('contenido')
    <!-- HEADER -->
    <section class="hero" style="border-top: 3px solid {{$categoria->color}}">
        <div class="hero-bg-primary" style="background: {{$categoria->color}};"></div>
        <div class="container">
            <div class="page-header">
                <div class="page-title">{{$categoria->name}}</div>
                <ol class="breadcrumb">
                    <li><a href="/">Inicio</a></li>
                    <li><a href="#">@if($categoria->its_platform)Plataforma @else Categoría @endif</a></li>
                    <li class="active">{{$categoria->name}}</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- BÚSQUEDA CATEGORÍA -->
    <section class="padding-top-25 no-padding-bottom border-bottom-1 border-grey-300">
        @include('searchs.categories_search')
    </section>

    <!-- ARTÍCULOS -->
    <section class="bg-grey-50">
        @include('categories.widgets.articles')
    </section>
@endsection