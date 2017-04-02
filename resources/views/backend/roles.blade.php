@extends('backend.master')
@section('titulo', 'Configuración')
@section('configuracion', 'active')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('contenido')
    <div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="widget ">

                            <div class="widget-header">
                                <i class="icon-tasks"></i>
                                <h3>Configuración de roles y permisos</h3>
                            </div>

                            <div class="widget-content">
                                <div class="tabbable">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#roles" data-toggle="tab">Roles</a></li>
                                        <li><a href="#permisos" data-toggle="tab">Permisos</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="roles">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th>Descripción</th>
                                                    <th width="77px">Opciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($roles as $rol)
                                                <tr id="roles_{{$rol->id}}">
                                                    <td>{{$rol->id}}</td>
                                                    <td>{{$rol->nombre}}</td>
                                                    <td>{{$rol->descripcion}}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-small btn-success"><i class="btn-icon-only icon-edit"></i></a>
                                                        <a onclick="eliminarRol({{$rol->id}})" class="btn btn-small btn-success"><i class="btn-icon-only icon-trash"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                            <div class="form-actions">
                                                <a class="btn btn-primary" href="#crearrol" data-toggle="modal"><i class="icon-plus icon-white"></i> Crear rol</a>
                                                <a class="btn">Volver</a>
                                            </div>
                                            <!-- Crear permiso -->
                                            <div id="crearrol" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="crearrol" aria-hidden="true">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h3 id="myModalLabel">Crear un nuevo rol</h3>
                                                </div>

                                                    <div class="modal-body">
                                                        <div class="alert" id="alerta-rol-creado" hidden>
                                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                            Has creado un nuevo rol correctamente
                                                        </div>
                                                        <fieldset>
                                                            <div class="control-group">
                                                                <label class="control-label" for="nombre_r">Nombre</label>
                                                                <div class="controls">
                                                                    <input type="text" class="span5" id="nombre_r" name="nombre">
                                                                    <p class="help-block">Nombre del rol</p>
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label" for="descripcion_r">Descripción</label>
                                                                <div class="controls">
                                                                    <input type="text" class="span5" id="descripcion_r" name="descripcion">
                                                                    <p class="help-block">Descripción del rol (opcional)</p>
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label">Permisos</label>
                                                                <div class="controls">
                                                                    @foreach($permisos as $permiso)
                                                                    <label class="checkbox inline">
                                                                        <input type="checkbox" name="permisos[]" value="{{$permiso->id}}"> {{$permiso->nombre}}
                                                                    </label>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                        <button class="btn btn-primary" onclick="crearRol()">Crear</button>
                                                    </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="permisos">

                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th>Descripción</th>
                                                    <th width="77px">Opciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($permisos as $permiso)
                                                    <tr id="permisos_{{$permiso->id}}">
                                                        <td>{{$permiso->id}}</td>
                                                        <td>{{$permiso->nombre}}</td>
                                                        <td>{{$permiso->descripcion}}</td>
                                                        <td>
                                                            <a href="#" class="btn btn-small btn-success"><i class="btn-icon-only icon-edit"></i></a>
                                                            <a onclick="eliminarPermiso({{$permiso->id}})" class="btn btn-small btn-success"><i class="btn-icon-only icon-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                            <div class="form-actions">
                                                <a class="btn btn-primary" href="#crearpermiso" data-toggle="modal"><i class="icon-plus icon-white"></i> Crear permiso</a>
                                                <a class="btn">Volver</a>
                                            </div>
                                            <!-- Crear permiso -->
                                            <div id="crearpermiso" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="crearpermiso" aria-hidden="true">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h3 id="myModalLabel">Crear un nuevo permiso</h3>
                                                </div>
                                                    <div class="modal-body">
                                                        <div class="alert" id="alerta-permiso-creado" hidden>
                                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                            Has creado un nuevo permiso correctamente
                                                        </div>
                                                            <fieldset>
                                                                <div class="control-group">
                                                                    <label class="control-label" for="nombre_p">Nombre</label>
                                                                    <div class="controls">
                                                                        <input type="text" class="span5" id="nombre_p" name="nombre">
                                                                        <p class="help-block">Nombre del permiso</p>
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label class="control-label" for="descripcion_p">Descripción</label>
                                                                    <div class="controls">
                                                                        <input type="text" class="span5" id="descripcion_p" name="descripcion">
                                                                        <p class="help-block">Descripción del permiso (opcional)</p>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                                                        <button class="btn btn-primary" onclick="crearPermiso()">Crear</button>
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
        </div>
    </div>
@endsection