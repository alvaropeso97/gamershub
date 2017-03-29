@extends('backend.master')
@section('titulo', 'Dashboard')
@section('contenido')
<div class="main">
    <div class="main-inner">
        <div class="container">
            <div class="row">
                <div class="span6">
                    @include('backend.widgets.estadisticas')
                    @include('backend.widgets.calendario')
                </div>
                <div class="span6">
                    @include('backend.widgets.noticias_recientes')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection