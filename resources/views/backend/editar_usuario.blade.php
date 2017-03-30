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
                                @if(Session::has('mensaje')) <div class="alert alert-success"> {{Session::get('mensaje')}} </div> @endif
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
                                    <hr>
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
                                                <select name="pais" class="span2" id="pais">
                                                    @foreach($paises as $pais)
                                                    <option value="{{$pais->cod_pais}}" @if($usuario->pais == $pais->cod_pais) selected @endif>{{$pais->pais}}</option>
                                                    @endforeach
                                                </select>
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
                                                <select name="sexo" class="span2" id="sexo">
                                                    <option value="H" @if($usuario->sexo == "H") selected @endif>Hombre</option>
                                                    <option value="M" @if($usuario->sexo == "M") selected @endif>Mujer</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="span11">
                                            <label for="firma_personal">Firma personal</label>
                                            <textarea name="firma_personal" class="span11" id="firma_personal" rows="5">{{$usuario->firma_personal}}</textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="span3">
                                            <div class="form-group">
                                                <label class="control-label" for="password">Contraseña</label>
                                                <input type="password" class="span3" id="password" name="password">
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
                                                        <option value="{{$rol->id}}" @if($usuario->acceso == $rol->id) selected @endif>{{$rol->nombre}}</option>
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
@section('script')
    <script>
        $('#fecha_nacimiento').datepicker({
            format: "yyyy/mm/dd",
            autoclose: true,
            language: "es"
        });
        tinymce.init({
            selector:'textarea'
        });
    </script>
@endsection