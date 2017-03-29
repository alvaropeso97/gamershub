@extends('backend.master')
@section('titulo', 'Configuración')
@section('configuracion', 'class="active"')
@section('contenido')
    <div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="widget ">

                            <div class="widget-header">
                                <i class="icon-cog"></i>
                                <h3>Configuración de la aplicación</h3>
                            </div>

                            <div class="widget-content">
                                <div class="tabbable">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#configuracion_general" data-toggle="tab">Configuración general</a></li>
                                        <li><a href="#jscontrols" data-toggle="tab">Usuarios</a></li>
                                        <li><a href="#jscontrols" data-toggle="tab">Mantenimiento</a></li>
                                        <li><a href="#jscontrols" data-toggle="tab">Publicidad</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="configuracion_general">
                                            <form action="/backend/configuracion/update" method="POST">
                                                {{ csrf_field() }}
                                                <fieldset>
                                                    <div class="control-group">
                                                        <label class="control-label" for="nombre_aplicacion">Nombre de la aplicación</label>
                                                        <div class="controls">
                                                            <input type="text" class="span6" id="nombre_aplicacion" name="nombre_aplicacion" value="{{$configuracion_general->nombre_aplicacion}}">
                                                            <p class="help-block">Nombre que se mostrará en la barra del navegador</p>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="titulo_inicio">Título de la página principal</label>
                                                        <div class="controls">
                                                            <input type="text" class="span6" id="titulo_inicio" name="titulo_inicio" value="{{$configuracion_general->titulo_inicio}}">
                                                            <p class="help-block">Título que se mostrará en la página principal y en los buscadores</p>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="imagen_fondo">Imagen de fondo</label>
                                                        <div class="controls">
                                                            <input type="text" class="span6" id="imagen_fondo" name="imagen_fondo" value="{{$configuracion_general->imagen_fondo}}">
                                                            <p class="help-block">Imagen de fondo de la página de inicio</p>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label">Noticias destacadas en el inicio</label>
                                                        <div class="controls">
                                                            <label class="radio inline">
                                                                <input type="radio"  name="noticias_dest" value="1" @if($configuracion_general->noticias_dest == 1) checked @endif> Mostrar
                                                            </label>
                                                            <label class="radio inline">
                                                                <input type="radio" name="noticias_dest" value="0" @if($configuracion_general->noticias_dest == 0) checked @endif> Ocultar
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="copyrigth">Texto de copyright</label>
                                                        <div class="controls">
                                                            <input type="text" class="span6" id="copyrigth" name="copyright" value="{{$configuracion_general->copyright}}">
                                                            <p class="help-block">Texto que se mostrará en el pie de la página</p>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                    <button class="btn">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection