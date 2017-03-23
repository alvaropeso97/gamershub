@extends('layouts.master')
@section('titulo', 'GamersHUB - Usuarios')

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
                    <li class="active">Usuarios</li>
                </ol>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title">
                        <h4><i class="fa fa-users"></i> Usuarios</h4>
                    </div>
                </div>
            </div>

            <div class="row">

                @if(Session::has('mensaje')) <div class="alert alert-success"> {{Session::get('mensaje')}} </div> @endif
                @if(Session::has('error')) <div class="alert alert-danger"> {{Session::get('error')}} </div> @endif

                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="hidden-xs">Nombre de usuario</th>
                                <th class="hidden-xs">Tipo de acceso</th>
                                <th>Creado el</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{$usuario->id}}</td>
                                <td class="hidden-xs"><a href="/usuario/{{$usuario->name}}">{{$usuario->name}}</a></td>
                                <td class="hidden-xs">{{$usuario->getRango()}}</td>
                                <td>{{$usuario->created_at}}</td>
                                <td>
                                    <button class="btn btn-primary btn-circle btn-sm" onclick="window.location.href='/panel/usuarios/editar-usuario/{{$usuario->id}}'" data-toggle="tooltip" title="" data-original-title="editar"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-inverse btn-circle btn-sm" data-toggle="modal" data-target=".{{$usuario->name}}-{{$usuario->id}}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <!-- AVISO MODAL / ELIMINAR -->
                            <div class="modal fade {{$usuario->name}}-{{$usuario->id}}" tabindex="-1" role="dialog" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Confirmación para eliminar el usuario</h4>
                                        </div>
                                        <div class="modal-body">
                                            ¿Está seguro que desea eliminar el usuario? <br> <i>{{$usuario->name}}</i>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                                            <button type="button" onclick="window.location.href='/panel/usuarios/eliminar/{{$usuario->id}}'" class="btn btn-primary">Eliminar</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                            <!-- FIN AVISO MODAL / ELIMINAR-->
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @endsection