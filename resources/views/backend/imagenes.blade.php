@extends('backend.master')
@section('titulo', 'Imágenes')
@section('imagenes', 'class="active"')
@section('contenido')
    <div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="widget ">
                            <div class="widget-header">
                                <i class="icon-camera"></i>
                                <h3>Imágenes</h3>
                            </div>
                            <div class="widget-content">
                                @if(Session::has('mensaje')) <div class="alert alert-success"> {{Session::get('mensaje')}} </div> @endif
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Carpeta</th>
                                        <th>Tamaño</th>
                                        <th>Juego relacionado</th>
                                        <th>Fecha subida</th>
                                        <th width="77px">Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($imagenes as $imagen)
                                        <tr>
                                            <td>{{$imagen->id}}</td>
                                            <td>{{$imagen->nombre}}</td>
                                            <td>{{$imagen->ancho}}x{{$imagen->alto}}</td>
                                            <td>{{$imagen->juego_id}}</td>
                                            <td>{{$imagen->fecha_subida}}</td>
                                            <td>
                                                <a href="#" class="btn btn-small btn-success"><i class="btn-icon-only icon-edit"></i></a>
                                                <a href="#" class="btn btn-small btn-success"><i class="btn-icon-only icon-trash"></i></a>
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