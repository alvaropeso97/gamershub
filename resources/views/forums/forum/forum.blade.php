@extends('master')
@section('titulo', $foro->title)

@section('contenido')
    <!-- BREADCRUMBS -->
    <section class="border-bottom-1 border-grey-300 padding-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="/">Inicio</a></li>
                        <li><a href="#">Foros</a></li>
                        <li class="active">{{$foro->title}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- FOROS -->
    <section class="bg-grey-50 padding-bottom-60">
        <div class="container">
            <div class="headline">
                <h4 class="no-padding-top">{{$foro->title}}</h4>
                <div class="pull-right">
                    <a href="#" class="btn btn-primary btn-icon-left"><i class="fa fa-comments"></i> nuevo tema</a>
                    <div class="dropdown">
                        <a href="forum-new.html" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="#"><i class="fa fa-bar-chart-o"></i> Todos los foros</a></li>
                            <li><a href="#"><i class="fa fa-sort-alpha-asc"></i> Ordenar</a></li>
                            <li class="divider"></li>
                            <li><a href="forum-new.html"><i class="fa fa-plus"></i> Nuevo tema</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="forum forum-thread">
                @foreach($temas as $tema)
                    <div class="forum-group">
                        <div class="forum-icon"><i class="fa fa-comments"></i></div>
                        <div class="forum-title">
                            <h4><a href="#">{{$tema->title}}</a></h4>
                            <p>por {{$tema->user->nickname}}, {{$tema->created_at}}</p>
                        </div>
                        @php $ultimaRespuesta = $tema->getRespuestas(1); @endphp
                        @if(!$ultimaRespuesta)
                            <div class="forum-activity">
                                <div>
                                    <h4>Sin respuestas</h4>
                                    <span>Este tema todavía no ha recibido respuestas</span>
                                </div>
                            </div>
                            <div class="forum-meta">0 respuestas</div>
                            <div class="forum-meta">0 visitas</div>
                        @else
                            <div class="forum-activity">
                                <a href="#" data-toggle="tooltip" title="{{$tema->user->nickname}}"><img src="{{$ultimaRespuesta->user->avatar}}" alt=""></a>
                                <div>
                                    <h4><a href="#">{{$ultimaRespuesta->title}}</a></h4>
                                    <span><a href="#">{{$ultimaRespuesta->user->nickname}}</a>, {{$ultimaRespuesta->created_at}}</span>
                                </div>
                            </div>
                            <div class="forum-meta">{{count($tema->getRespuestas(0))}} respuestas</div>
                            <div class="forum-meta">0 visitas</div>
                        @endif
                    </div>
                @endforeach
            </div>
            {{$temas->render()}}
        </div>
    </section>
@endsection