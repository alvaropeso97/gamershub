@extends('layouts.master')
@section('titulo', 'GamersHUB - Nuevo Foro')

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
                    <li class="active">Nuevo Foro</li>
                </ol>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title">
                        <h4><i class="fa fa-folder-open"></i> Nuevo Foro</h4>
                    </div>
                    <form method="post" action="/panel/foros/nuevo-foro/add-foro" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Titulo</label>
                                <input type="text" name="nombre" class="form-control" placeholder="Título del foro"><br>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Juego relacionado</label>
                                <input type="text" name="esjuego" class="form-control" placeholder="Juego relacionado"><br>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Plataforma</label>
                                <select name="plataforma" class="form-control" style="height: 45px;">
                                    @foreach(\App\Categoria::all() as $categoria)
                                        <option name="plataforma" value="{{$categoria->id}}" style="color: {{$categoria->color}};">{{$categoria->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <label>Enlace</label>
                                <input type="text" name="lnombre" class="form-control" placeholder="Enlace del foro"><br>
                                <label>Imagen de cabecera</label>
                                <input name="img_header" type="file" class="form-control">
                            </div>
                        </div>
                        <div style="text-align: right;" class="row margin-top-30">
                            <div class="col-xs-12">
                                <button onclick="location.href='/panel/foros'" type="button" class="btn btn-danger btn-icon-right">Volver <i class="fa fa-ban"></i></button>
                                <button type="submit" class="btn btn-success btn-icon-right">Crear foro <i class="fa fa-check-square-o"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endsection