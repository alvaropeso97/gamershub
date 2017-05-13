@extends('layouts.master')
@section('titulo', 'Todas las noticias - GamersHUB')

@section('contenido')
    <section class="hero hero-games height-300">
        <div class="hero-bg bg-primary" style="background-color: #fff;"></div>
        <div class="container">
            <div class="page-header">
                <div class="page-title bold"><a href="games-single.html">Archivo de noticias</a></div>
                <p>Trabajamos diariamente para traerte las últimas noticias y no te pierdas nada.</p>
            </div>
        </div>
    </section>

    <!-- BÚSQUEDA CATEGORÍA -->
    @include('layouts.widgets.categoria.busqueda_noticias')

    <!-- ARTÍCULOS -->
    <section class="bg-grey-50">
        @include('categories.widgets.articles')
    </section>

@endsection