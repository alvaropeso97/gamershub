@extends('backend.master')
@section('titulo', 'Modificar usuario ('.$usuario->name.')')
@section('usuarios', 'class="active"')
@section('contenido')
    <div class="main">
        <div class="main-inner">
            <div class="container">
                        <div class="widget ">
                            <div class="widget-header">
                                <i class="icon-user"></i>
                                <h3>[{{$usuario->name}}] Modificar</h3>
                            </div>
                            <div class="widget-content">
                                <form action="/backend/usuarios/{{$usuario->id}}/update" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="span2">
                                            <div class="form-group">
                                                <label class="control-label" for="name">Nickname</label>
                                                <input type="text" class="span2" id="name" name="name" value="{{$usuario->name}}">
                                            </div>
                                        </div>
                                        <div class="span2">
                                            <div class="form-group">
                                                <label class="control-label" for="nombre">Nombre</label>
                                                <input type="text" class="span2" id="nombre" name="nombre" value="{{$usuario->nombre}}">
                                            </div>
                                        </div>
                                        <div class="span4">
                                            <div class="form-group">
                                                <label class="control-label" for="apellidos">Apellidos</label>
                                                <input type="text" class="span4" id="apellidos" name="apellidos" value="{{$usuario->apellidos}}">
                                            </div>
                                        </div>
                                        <div class="span3">
                                            <div class="form-group">
                                                <label class="control-label" for="email">Email</label>
                                                <input type="text" id="email" class="span3" name="email" value="{{$usuario->email}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="span3">
                                            <div class="form-group">
                                                <label class="control-label" for="fecha_nacimiento">Fecha de nacimiento</label>
                                                <input type="text" class="span3" id="fecha_nacimiento" name="fecha_nacimiento" value="{{$usuario->fecha_nacimiento}}">
                                            </div>
                                        </div>
                                        <div class="span2">
                                            <div class="form-group">
                                                <label class="control-label" for="pais">Pais</label>
                                                <input type="text" class="span2" id="pais" name="pais" value="{{$usuario->pais}}">
                                            </div>
                                        </div>
                                        <div class="span2">
                                            <div class="form-group">
                                                <label class="control-label" for="ciudad">Ciudad</label>
                                                <input type="text" class="span2" id="ciudad" name="ciudad" value="{{$usuario->ciudad}}">
                                            </div>
                                        </div>
                                        <div class="span2">
                                            <div class="form-group">
                                                <label class="control-label" for="sexo">Sexo</label>
                                                <input type="text" id="email" class="span2" id="sexo" name="sexo" value="{{$usuario->sexo}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="span12">
                                            <label for="firma_personal">Firma personal</label>
                                            <textarea name="firma_personal" class="span11" id="firma_personal" rows="5">{{$usuario->firma_personal}}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="span3">
                                            <div class="form-group">
                                                <label class="control-label" for="password">Contraseña</label>
                                                <input type="password" class="span3" id="password" name="passsword" value="12345678910111213">
                                            </div>
                                        </div>
                                        <div class="span2">
                                            <div class="form-group">
                                                <label class="control-label" for="verificada">Verificada</label>
                                                <select name="verificada" class="span2" id="verificada">
                                                    <option value="0" @if($usuario->verificada == 0) selected @endif>No</option>
                                                    <option value="1" @if($usuario->verificada == 1) selected @endif>Sí</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="span3">
                                            <div class="form-group">
                                                <label class="control-label" for="rol">Rol</label>
                                                <select name="rol" class="span3" id="rol">
                                                    @foreach($roles as $rol)
                                                        <option value="{{$rol->id}}">{{$rol->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary"><i class="icon-save icon-white"></i> Guardar</button>
                                        <a class="btn" href="/backend/usuarios">Volver</a>
                                    </div>
                                </form>
                            </div>
                        </div>
            </div>
        </div>
    </div>
@endsection