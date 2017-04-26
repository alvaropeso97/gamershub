@extends('layouts.master')
@section('titulo', $foro->nombre)

@section('contenido')
    <!-- HEADER -->
    <section class="hero" style="border-top: 3px solid {{$foro->color}}">
        <div class="hero-bg-primary" style="background: {{$foro->color}};"></div>
        <div class="container">
            <div class="page-header">
                <div class="page-title">{{$foro->nombre}}</div>
                <ol class="breadcrumb">
                    <li><a href="/">Inicio</a></li>
                    <li><a href="#">Foros</a></li>
                    <li class="active">{{$foro->nombre}}</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- FOROS -->
    <section class="bg-grey-50">
        asdsad
    </section>
@endsection