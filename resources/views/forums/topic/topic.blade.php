@extends('layouts.master')
@section('titulo', $tema->titulo)

@section('contenido')
    <!-- BREADCRUMBS -->
    <section class="border-bottom-1 border-grey-300 padding-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="/">Inicio</a></li>
                        <li><a href="#">Foros</a></li>
                        <li><a href="/foro/{{$foro->id}}"></a>{{$foro->nombre}}</li>
                        <li class="active">{{$tema->titulo}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-grey-50 padding-bottom-60">
        <div class="container">
            <!-- CABECERA -->
            <div class="headline">
                <h4><i class="fa fa-comments"></i> {{$tema->titulo}}</h4>
                <div class="pull-right">
                    <a href="#" class="btn btn-primary btn-icon-left"><i class="fa fa-comments"></i> nuevo tema</a>
                    <a href="#" class="btn btn-default btn-icon-left"><i class="fa fa-edit"></i> editar tema</a>
                    <a href="#" class="btn btn-default btn-icon-left"><i class="fa fa-lock"></i> cerrar tema</a>
                    <div class="dropdown">
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="#"><i class="fa fa-edit"></i> Editar tema</a></li>
                            <li><a href="#"><i class="fa fa-lock"></i> Cerrar tema</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="fa fa-plus"></i> Nuevo tema</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        @php $contador = 1; @endphp

        <!-- TEMA -->
            <div class="forum-post">
                <div class="forum-panel">
                    <div class="forum-user">
                        @php $autor = $tema->getUsuario; @endphp
                        <a href="/usuario/{{$autor->name}}" class="avatar"><img src="{{$autor->avatar}}" alt=""><span class="@if($autor->estaConectado()) label label-success @else label label-danger @endif"></span></a>
                        <div>
                            <a href="/usuario/{{$autor->name}}">{{$autor->name}}</a>
                            <span>Miembro desde</span>
                            <span class="date">{{$autor->created_at}}</span>
                        </div>
                    </div>
                    <div class="forum-body">
                        {{$tema->contenido}}
                    </div>
                </div>
                <div class="forum-footer">
                    <ul class="post-action">
                        <li><a href="#"><i class="fa fa-heart"></i> me gusta (0)</a></li>
                        <li><a href="#"><i class="fa fa-reply"></i> responder</a></li>
                        <li><a href="#"><i class="fa fa-flag"></i> Reportar</a></li>
                    </ul>
                    <ul class="post-meta">
                        <li><i class="fa fa-calendar-o"></i> {{$tema->getFecha()}}</li>
                        <li>#{{$contador}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection