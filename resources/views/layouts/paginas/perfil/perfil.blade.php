@extends('layouts.master')
@section('titulo', 'GamersHUB - '. $id->name)

@section('contenido')
    <section class="hero cover hidden-xs" style="background-image: url({{$id->img_header}});">
        <div class="hero-bg"></div>
        <div class="container relative">
            <div class="page-header">
                <div class="profile-avatar">
                    <div class="thumbnail" data-toggle="tooltip" title="{{$id->name}}">
                        <a href="#">
                            <img src="{{$id->img_perfil}}">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="profile-nav height-50 border-bottom-1 border-grey-300  hidden-xs">
        <div class="tab-select sticky">
            <div class="container">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#">Timeline</a></li>
                    <li><a href="#">Acerca de mí</a></li>
                    <li><a href="#">Amigos <span>(0)</span></a></li>
                    <li><a href="#">Imagenes <span>(0)</span></a></li>
                    <li><a href="#">Vídeos <span>(0)</span></a></li>
                    <li><a href="#">Grupos</a></li>
                    @if(Auth::check() && Auth::user()->id == $id->id)
                    <li><a href="/usuario/{{$id->name}}/editar">Editar mi perfil</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </section>

    <section class="bg-grey-50 padding-top-60 padding-top-sm-30">
        <div class="container">
            <div class="row">

                <!-- Barra lateral -->
                <div class="col-md-3 col-sm-4 hidden-xs">

                </div>

                <!-- Contenido principal -->
                <div class="col-md-9 col-sm-8">
                    <div class="panel panel-default margin-bottom-40">
                        <div class="panel-body">
                            <div class="form-group">
                                <textarea class="form-control" rows="4" placeholder="Actualiza tu estado..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-icon-left pull-right"><i class="fa fa-edit"></i> Actualizar</button>
                        </div>
                    </div>
            </div>
        </div>
            </div>
    </section>

@endsection