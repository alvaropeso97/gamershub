@extends('layouts.master')
@section('titulo', 'GamersHUB - Nuevo Artículo')

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
                    <li><a href="/panel/articulos">Artículos</a></li>
                    <li class="active">Nuevo artículo</li>
                </ol>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title">
                        <h4><i class="fa fa-plus"></i> Nuevo artículo</h4>
                        @if ($errors->has('titulo'))
                            <div class="alert alert-danger">
                                El contenido del comentario es demasiado corto (Mínimo 25 caracteres)</a>
                            </div>
                        @endif
                    </div>
                    <form method="post" action="/panel/articulos/nuevo-articulo/add-not" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row margin-top-30">
                                <h3>Información general</h3>
                                <p>Completa los campos de información del artículo.</p>
                                <div class="col-lg-6">
                                    <label>Título del artículo</label>
                                    <input type="text" name="titulo" class="form-control" placeholder="Título del artículo"><br>
                                </div>
                            <div class="col-lg-6">
                                <label>Tipo</label>
                                <select name="tipo" class="form-control" style="height: 45px;">
                                    <option name="tipo" value="art">Artículo</option>
                                    <option name="tipo" value="vid">Vídeo</option>
                                    <option name="tipo" value="ana">Análisis</option>
                                </select>
                            </div>
                        </div>

                        <div class="row margin-top-30">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label>Autor</label>
                                    <input type="text" id="autor" name="autor" class="form-control" value="{{Auth::user()->name}}" disabled>
                                    <input type="hidden" id="id_autor" name="id_autor" class="form-control" value="{{Auth::user()->id}}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label>Fecha de publicación</label>
                                    <input type="text" value="{{date('Y-m-d H:i:s')}}" class="form-control" disabled>
                                    <input type="hidden" id="fecha" name="fecha" class="form-control" value="{{date('Y-m-d H:i:s')}}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Categorías/Plataformas</label>
                                <select id="categorias" name="categorias[]" multiple  class="form-control" style="height: 45px; padding: 0px;">
                                    @foreach(\App\Http\Controllers\CategoriasController::allCategorias() as $categoria)
                                        <option name="categorias[]" value="{{$categoria->id}}" style="color: {{$categoria->color}};">{{$categoria->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row margin-top-30">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Juego Relacionado</label>
                                    <input type="text" list="juegos" name="juego_rel" class="form-control" style="height: 45px;"/>
                                    <datalist id="juegos">
                                        @foreach(\App\Http\Controllers\JuegosController::devolverJuegos() as $juego)
                                            <option name="juego_rel" value="{{$juego->id}}">{{$juego->titulo}}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row margin-top-30">
                            <h3>Contenido del artículo</h3>
                            <p>Introduce una descripción y el contenido del artículo.</p>
                            <div class="col-lg-12">
                                <label>Descripción del artículo</label>
                                <textarea id="descripcion" name="descripcion" class="form-control bg-white" rows="3" placeholder="Escribe aquí la descripción del artículo..." required=""></textarea></br>
                                <textarea id="editor" name="cont"></textarea>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label style="margin-top: 15px;">Imagen destacada</label>
                                        <input name="img" type="file" class="form-control">
                                    </div>
                                    <div class="col-lg-6">
                                        <label style="margin-top: 15px;" >Etiquetas (<span class="bold">INTRO</span> para añadir nueva)</label>
                                        <input type="text" data-role="tagsinput" name="etiquetas" class="form-control" placeholder=""><br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row margin-top-30">
                            <h3>Vídeo relacionado</h3>
                            <p>Si el artículo contiene un video relacionado a Youtube.</p>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="cod_yt" class="form-control" placeholder="Codigo de Youtube"><br>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="dur" class="form-control" placeholder="Duración"><br>
                            </div>
                        </div>

                        <hr>

                        <div class="row margin-top-30">
                            <h3>Análisis</h3>
                            <p>Solo si es un análisis de un título y tiene un juego asociado.</p>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <input type="text" name="jugabilidad" class="form-control" placeholder="Jugabilidad (0/100)"><br>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <input type="text" name="graficos" class="form-control" placeholder="Gráficos (0/100)"><br>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <input type="text" name="sonidos" class="form-control" placeholder="Sonidos (0/100)"><br>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <input type="text" name="innovacion" class="form-control" placeholder="Innovación (0/100)"><br>
                            </div>
                        </div>

                        <div style="text-align: right;" class="row margin-top-30">
                            <button onclick="location.href='/panel/articulos'" type="button" class="btn btn-danger btn-icon-right">Volver <i class="fa fa-ban"></i></button>
                            <button type="submit" class="btn btn-success btn-icon-right">Publicar artículo <i class="fa fa-check-square-o"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endsection