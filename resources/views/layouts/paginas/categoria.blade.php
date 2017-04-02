@extends('layouts.master')
@section('titulo', $categoria->nombre)

@section('contenido')
    <!-- HEADER -->
    <section class="hero" style="background-image: url({{$categoria->img_header}}); border-top: 3px solid {{$categoria->color}}">
        <div class="hero-bg-primary" style="background: {{$categoria->color}};"></div>
        <div class="container">
            <div class="page-header">
                <div class="page-title">{{$categoria->nombre}}</div>
                <ol class="breadcrumb">
                    <li><a href="/">Inicio</a></li>
                    <li><a href="#">@if($categoria->esplataforma)Plataforma @else Categoría @endif</a></li>
                    <li class="active">{{$categoria->nombre}}</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- BÚSQUEDA CATEGORÍA -->
    <section class="padding-top-25 no-padding-bottom border-bottom-1 border-grey-300">
        @include('layouts.widgets.categoria.busqueda_categoria')
    </section>

    <!-- ARTÍCULOS -->
    <section class="bg-grey-50">
        @include('layouts.widgets.categoria.listar_noticias')
    </section>
@endsection