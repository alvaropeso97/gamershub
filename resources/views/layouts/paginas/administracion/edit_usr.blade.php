@extends('layouts.master')
@section('titulo', 'GamersHUB - Editar usuario')

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
                    <li><a href="/panel/usuarios">Usuarios</a></li>
                    <li class="active">{{$id->name}}</li>
                </ol>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title">
                        <h4><i class="fa fa-users"></i> Editar usuario</h4>
                    </div>

                    <form method="post" action="/panel/usuarios/editar-usuario/{{$id->id}}/modificar" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row margin-top-30">
                            <div class="col-lg-2 col-sm-2">
                                <label>ID</label>
                                <input type="text" name="id" class="form-control" value="{{$id->id}}" disabled>
                            </div>
                            <div class="col-lg-5 col-sm-5">
                                <label>Nombre de usuario</label>
                                <input type="text" name="name" class="form-control" value="{{$id->name}}">
                            </div>
                            <div class="col-lg-5 col-sm-5">
                                <label>Fecha de registro</label>
                                <input type="text" name="created_at" class="form-control" value="{{$id->created_at}}" disabled>
                            </div>
                        </div>
                        <div class="row margin-top-30">
                            <div class="col-lg-7 col-sm-7">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{$id->email}}">
                            </div>
                            <div class="col-lg-5 col-sm-5">
                                <label>Fecha de nacimiento</label>
                                <input type="text" name="fecha_nacimiento" class="form-control" value="{{$id->fecha_nacimiento}}">
                            </div>
                        </div>
                        <div class="row margin-top-30">
                            <div class="col-lg-6 col-sm-6">
                                <label>Nueva contraseña</label>
                                <input type="password" name="password" class="form-control" value="">
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <label>Repetir nueva contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control" value="">
                            </div>
                        </div>
                        <div style="text-align: right;" class="row margin-top-30">
                            <div class="col-xs-12">
                                <button onclick="location.href='/panel/usuarios'" type="button" class="btn btn-danger btn-icon-right">Volver <i class="fa fa-ban"></i></button>
                                <button type="submit" class="btn btn-success btn-icon-right">Editar usuario <i class="fa fa-check-square-o"></i></button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    @endsection