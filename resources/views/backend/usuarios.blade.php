@extends('backend.master')
@section('titulo', 'Usuarios')
@section('usuarios', 'class="active"')
@section('contenido')
    <div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="widget ">
                            <div class="widget-header">
                                <i class="icon-user"></i>
                                <h3>Usuarios</h3>
                            </div>
                            <div class="widget-content">
                                @if(Session::has('mensaje')) <div class="alert alert-success"> {{Session::get('mensaje')}} </div> @endif
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>País</th>
                                        <th>Fecha registro</th>
                                        <th width="77px">Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($usuarios as $usuario)
                                        <tr>
                                            <td>{{$usuario->id}}</td>
                                            <td>{{$usuario->name}}</td>
                                            <td>{{$usuario->email}}</td>
                                            <td>{{$usuario->pais}}</td>
                                            <td>{{$usuario->created_at}}</td>
                                            <td>
                                                <a href="usuarios/{{$usuario->id}}" class="btn btn-small btn-success"><i class="btn-icon-only icon-edit"></i></a>
                                                <a href="usuarios/{{$usuario->id}}/eliminar" class="btn btn-small btn-success"><i class="btn-icon-only icon-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection