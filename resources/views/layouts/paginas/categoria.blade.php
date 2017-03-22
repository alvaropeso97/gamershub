@extends('layouts.master')
@section('titulo', $id->nombre)

@section('contenido')
    <!-- HEADER -->
    <section class="hero" style="background-image: url({{$id->img_header}}); border-top: 3px solid {{$id->color}}">
        <div class="hero-bg-primary" style="background: {{$id->color}};"></div>
        <div class="container">
            <div class="page-header">
                <div class="page-title">{{$id->nombre}}</div>
                <ol class="breadcrumb">
                    <li><a href="/">Inicio</a></li>
                    <li><a href="#">@if($id->esplataforma)Plataforma @else Categoría @endif</a></li>
                    <li class="active">{{$id->nombre}}</li>
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