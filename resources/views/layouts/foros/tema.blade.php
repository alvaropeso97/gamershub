@extends('layouts.master')
@section('titulo', $tema->nombre)

@section('contenido')
    <!-- HEADER -->
    <section class="hero" style="border-top: 3px solid {{$foro->color}}">
        <div class="hero-bg-primary" style="background: {{$foro->color}};"></div>
        <div class="container">
            <div class="page-header">
                <div class="page-title">{{$tema->nombre}}</div>
                <ol class="breadcrumb">
                    <li><a href="/">Inicio</a></li>
                    <li><a href="#">Foros</a></li>
                    <li><a href="#">{{$foro->nombre}}</a></li>
                    <li class="active">{{$tema->titulo}}</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- FOROS -->
    <section class="bg-grey-50">
        {{$tema->contenido}}
        @php dd($temasRespuestas) @endphp
    </section>
@endsection