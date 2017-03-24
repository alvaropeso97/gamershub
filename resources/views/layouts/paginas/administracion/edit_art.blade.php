@extends('layouts.master')
@section('titulo', 'GamersHUB - Editar: '.$id->titulo)

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
                    <li class="active">{{$id->titulo}}</li>
                </ol>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title">
                        <h4><i class="fa fa-plus"></i> Editar artículo</h4>
                    </div>
                    <form method="post" action="/panel/articulos/editar-articulo/{{$id->id}}/modificar" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row margin-top-30">
                                <h3>Información general</h3>
                                <p>Completa los campos de información del artículo.</p>
                                <div class="col-lg-6">
                                    <label>Título del artículo</label>
                                    <input type="text" name="titulo" class="form-control" value="{{$id->titulo}}"><br>
                                </div>
                            <div class="col-lg-6">
                                <label>Tipo</label>
                                <select name="tipo" class="form-control" style="height: 45px;" disabled>
                                    <option name="tipo" value="art" @if($id->tipo == "art") selected @endif>Artículo</option>
                                    <option name="tipo" value="vid" @if($id->tipo == "vid") selected @endif>Vídeo</option>
                                    <option name="tipo" value="ana" @if($id->tipo == "ana") selected @endif>Análisis</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <label>Enlace al artículo</label>
                                <input type="text" id="lnombre" name="lnombre" class="form-control" value="{{$id->lnombre}}">
                            </div>
                        </div>

                        <div class="row margin-top-30">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label>Autor</label>
                                    <input type="text" id="autor" name="autor" class="form-control" value="{{$id->getAutor->name}}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label>Fecha de publicación</label>
                                    <input type="text" value="{{$id->fecha}}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Categorías/Plataformas</label>
                                @php $categorias_articulo = $id->getCategorias->toArray(); @endphp

                                <select id="categorias" name="categorias[]" multiple class="form-control" style="height: 45px; padding: 0px;">
                                    @foreach(\App\Categoria::all() as $categoria)
                                    <option name="categorias[]" value="{{$categoria->id}}" style="color: {{$categoria->color}};" @if(in_array($categoria->id, array_column($categorias_articulo, "id"))) selected @endif >{{$categoria->nombre}}</option>

                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row margin-top-30">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Juego Relacionado</label>
                                    <input type="text" list="juegos" name="juego_rel" class="form-control" style="height: 45px;" value="{{$id->juego_rel}}"/>
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
                                <textarea id="descripcion" name="descripcion" class="form-control bg-white" rows="3">{{$id->descripcion}}</textarea></br>
                                <textarea id="editor" name="cont">{{$id->cont}}</textarea>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label style="margin-top: 15px;">Imagen destacada</label>
                                        <input name="img" type="file" class="form-control">
                                    </div>
                                    <div class="col-lg-6">
                                        <label style="margin-top: 15px;" >Etiquetas (<span class="bold">INTRO</span> para añadir nueva)</label>
                                        <input type="text" data-role="tagsinput" name="etiquetas" class="form-control" value="{{$id->getEtiquetasCadena()}}"><br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($id->tipo == "vid")
                            @php $video = $id->getVideo @endphp
                            <hr>

                            <div class="row margin-top-30">
                                <h3>Vídeo relacionado</h3>
                                <p>Si el artículo contiene un video relacionado a Youtube.</p>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="cod_yt" class="form-control" value="{{$video->cod_yt}}"><br>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="dur" class="form-control" value="{{$video->dur}}"><br>
                                </div>
                            </div>
                        @endif

                        @if($id->tipo == "ana")
                            <hr>
                            @php $analisis = $id->getAnalisis; @endphp
                        <div class="row margin-top-30">
                            <h3>Análisis</h3>
                            <p>Solo si es un análisis de un título y tiene un juego asociado.</p>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <input type="text" name="jugabilidad" class="form-control" value="{{$analisis->jugabilidad}}"><br>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <input type="text" name="graficos" class="form-control" value="{{$analisis->graficos}}"><br>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <input type="text" name="sonidos" class="form-control" value="{{$analisis->sonidos}}"><br>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <input type="text" name="innovacion" class="form-control" value="{{$analisis->innovacion}}"><br>
                            </div>
                        </div>
                        @endif

                        <div style="text-align: right;" class="row margin-top-30">
                            <button onclick="location.href='/panel/articulos'" type="button" class="btn btn-danger btn-icon-right">Volver <i class="fa fa-ban"></i></button>
                            <button type="submit" class="btn btn-success btn-icon-right">Editar artículo <i class="fa fa-check-square-o"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endsection