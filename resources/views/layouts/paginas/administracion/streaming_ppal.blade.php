@extends('layouts.master')
@section('titulo', 'GamersHUB - Streaming Principal')

@section('contenido')

    <section class="hero">
        <div class="hero-bg-primary" style="background: #a3112e; opacity: 0.9;"></div>
        <div class="container">
            <div class="page-header">
                <div class="page-title">ADMINISTRACIÓN</div>
                <ol class="breadcrumb">
                    <li><a href="/">Inicio</a></li>
                    <li><a href="/">GAMERSHUB</a></li>
                    <li><a href="/">Administración</a></li>
                    <li class="active">Streaming Principal</li>
                </ol>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title">
                        <h4><i class="fa fa-twitch"></i> Streaming principal</h4>
                    </div>
                    @if(Session::has('mensaje')) <div class="alert alert-success"> {{Session::get('mensaje')}} </div> @endif
                    <form method="post" action="/panel/streaming-principal/actualizar" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @php $streaming_ppal = \App\Http\Controllers\StreamingPpalController::devolverDatos() @endphp
                        <div class="row">
                            <div class="col-xs-12">
                                <label>Titulo</label>
                                <input type="text" name="titulo" class="form-control" value="{{$streaming_ppal->titulo}}"><br>
                                <label>Imagen de fondo</label>
                                <input type="text" name="bg_streaming" class="form-control" value="{{$streaming_ppal->bg_streaming}}"><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Usuario de Twitch</label>
                                <input type="text" name="usuario_twitch" class="form-control" value="{{$streaming_ppal->usuario_twitch}}"><br>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Emisor</label>
                                <input type="text" name="emisor" class="form-control" value="{{$streaming_ppal->emisor}}"><br>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Emitiendo</label>
                                <select name="emitiendo" class="form-control" style="height: 45px;">
                                        <option @if($streaming_ppal->emitiendo == 0) selected="selected" @endif name="emitiendo" value="0">No</option>
                                        <option @if($streaming_ppal->emitiendo == 1) selected="selected" @endif name="emitiendo" value="1">Sí</option>
                                </select>
                            </div>
                        </div>

                        <div style="text-align: right;" class="row margin-top-30">
                            <div class="col-xs-12">
                                <button onclick="location.href='/'" type="button" class="btn btn-danger btn-icon-right">Volver <i class="fa fa-ban"></i></button>
                                <button type="submit" class="btn btn-success btn-icon-right">Actualizar información <i class="fa fa-check-square-o"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endsection