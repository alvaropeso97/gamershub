@extends('backend.master')
@section('titulo', 'Eliminar usuario ('.$usuario->name.')')
@section('usuarios', 'class="active"')
@section('contenido')
    <div class="main">
        <div class="main-inner">
            <div class="container">
                        <div class="widget ">
                            <div class="widget-header">
                                <i class="icon-user"></i>
                                <h3>[{{$usuario->name}}] Eliminar</h3>
                            </div>
                            <div class="widget-content">
                                <form action="/backend/usuarios/{{$usuario->id}}/destroy" method="POST">
                                    {{ csrf_field() }}
                                    <input type="text" name="id" value="{{$usuario->id}}" class="hidden">
                                    <p>
                                        ¿Deseas eliminar al usuario {{$usuario->name}} de la base de datos?
                                    </p>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-danger"><i class="icon-save icon-white"></i> Eliminar</button>
                                        <a class="btn" href="/backend/usuarios">Volver</a>
                                    </div>
                                </form>
                            </div>
                        </div>
            </div>
        </div>
    </div>
@endsection