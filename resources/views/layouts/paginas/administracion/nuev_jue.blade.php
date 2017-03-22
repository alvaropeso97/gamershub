@extends('layouts.master')
@section('titulo', 'GamersHUB - Nuevo Juego')

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
                    <li class="active">Nuevo juego</li>
                </ol>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title">
                        <h4><i class="fa fa-gamepad"></i> Nuevo juego</h4>
                    </div>
                    <form method="post" action="/panel/juegos/nuevo-juego/add-juego" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            <h3>Información general</h3>
                            <p>Completa los campos de información del juego.</p>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Título del juego</label>
                                <input type="text" name="titulo" class="form-control" placeholder="Título del juego"><br>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Plataformas</label>
                                <select id="categorias" name="plataformas[]" multiple class="form-control" style="height: 45px; padding: 0px;">
                                    @foreach(\App\Http\Controllers\CategoriasController::allPlataformas() as $plataforma)
                                        <option name="plataformas[]" value="{{$plataforma->id}}" style="color: {{$plataforma->color}};">{{$plataforma->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <label>Descripción</label>
                                <textarea class="form-control bg-white" name="descripcion"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row margin-top-30">
                            <h3>Información adicional</h3>
                            <p>Completa los campos de información del juego.</p>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Desarrollador</label>
                                <input type="text" name="desarrollador" placeholder="Desarrollador" class="form-control">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Distribuidor</label>
                                <input type="text" name="distribuidor" placeholder="Distribuidor" class="form-control">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Jugadores</label>
                                <input type="text" name="jugadores" placeholder="Jugadores" class="form-control">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <label>Duración</label>
                                <input type="text" name="duracion" placeholder="Duración" class="form-control">
                            </div>
                        </div>

                        <div class="row margin-top-30">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Disponible en</label>
                                <input type="text" name="dispo_en" placeholder="Disponible en" class="form-control">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Idioma/s</label>
                                <input type="text" name="idioma" placeholder="Idioma" class="form-control">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Fecha de lanzamiento</label>
                                <input type="text" name="fecha_lanzamiento" placeholder="aaaa-mm-dd" class="form-control">
                            </div>
                        </div>

                        <hr>

                        <div class="row margin-top-30">
                            <h3>Imágenes</h3>
                            <p>Selecciona las imágenes para las carátulas del juego.</p>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Carátula</label>
                                <input name="caratula" type="file" class="form-control">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Imagen para la cabecera</label>
                                <input name="img_header" type="file" class="form-control">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Imagen para la descripción</label>
                                <input name="img_box" type="file" class="form-control">
                            </div>
                        </div>

                        <div style="text-align: right;" class="row margin-top-30">
                            <button onclick="location.href='/panel/juegos'" type="button" class="btn btn-danger btn-icon-right">Volver <i class="fa fa-ban"></i></button>
                            <button type="submit" class="btn btn-success btn-icon-right">Crear juego <i class="fa fa-check-square-o"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endsection