@extends('layouts.master')
@section('titulo', 'GamersHUB - Articulos')

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
                    <li class="active">Artículos</li>
                </ol>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title">
                        <h4><i class="fa fa-newspaper-o"></i> Artículos</h4>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="headline">
                    <div class="pull-right">
                        <a href="/panel/articulos/nuevo-articulo" class="btn btn-primary btn-icon-left"><i class="fa fa-plus"></i> nuevo artículo</a>
                    </div>
                </div>

                @if(Session::has('mensaje')) <div class="alert alert-success"> {{Session::get('mensaje')}} </div> @endif
                @if(Session::has('error')) <div class="alert alert-danger"> {{Session::get('error')}} </div> @endif

                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="hidden-xs">Título</th>
                                <th class="hidden-xs">Tipo</th>
                                <th>Autor</th>
                                <th>Juego relacionado</th>
                                <th>Fecha de publicación</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cons as $articulo)
                            <tr>
                                <td>{{$articulo->id}}</td>
                                <td width="50%"><a href="/articulo/{{$articulo->id}}/{{$articulo->lnombre}}">{{$articulo->titulo}}</a></td>
                                <td>{{$articulo->tipo}}</td>
                                @php $autor = $articulo->getAutor @endphp
                                <td><a href="/usuario/{{$autor->name}}">{{$autor->name}}</a></td>
                                @php $juego = $articulo->getJuego @endphp
                                <td>@if($articulo->juego_rel == 0) Ninguno @else <a href="/juego/{{$juego->id}}/{{$juego->lnombre}}">{{$juego->titulo}}</a> @endif</td>
                                <td>{{$articulo->fecha}}</td>
                                <td>
                                    <button class="btn btn-primary btn-circle btn-sm" onclick="window.location.href='/panel/articulos/editar-articulo/{{$articulo->id}}'" data-toggle="tooltip" title="" data-original-title="editar"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-inverse btn-circle btn-sm" data-toggle="modal" data-target=".{{$articulo->lnombre}}-{{$articulo->id}}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <!-- AVISO MODAL / ELIMINAR -->
                            <div class="modal fade {{$articulo->lnombre}}-{{$articulo->id}}" tabindex="-1" role="dialog" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Confirmación para eliminar el artículo</h4>
                                        </div>
                                        <div class="modal-body">
                                            ¿Está seguro que desea eliminar el artículo? <br> <i>{{$articulo->titulo}}</i>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                                            <button type="button" onclick="window.location.href='/panel/articulos/eliminar/{{$articulo->id}}'" class="btn btn-primary">Eliminar</button>
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

                <div class="text-center margin-top-15"> {{$cons->render()}} </div>

            </div>
        </div>
    </section>
    @endsection