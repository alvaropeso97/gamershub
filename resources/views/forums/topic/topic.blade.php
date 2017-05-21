@extends('master')
@section('titulo', $tema->title)
@section('css')
    <link href="/plugins/animate/animate.min.css" rel="stylesheet">
    <link href="/plugins/summernote/summernote.css" rel="stylesheet">
@endsection

@section('contenido')
    <!-- BREADCRUMBS -->
    <section class="border-bottom-1 border-grey-300 padding-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="/">Inicio</a></li>
                        <li><a href="#">Foros</a></li>
                        <li><a href="/foro/{{$foro->id}}"></a>{{$foro->title}}</li>
                        <li class="active">{{$tema->title}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-grey-50 padding-bottom-60">
        <div class="container">
            <!-- CABECERA -->
            <div class="headline">
                <h4><i class="fa fa-comments"></i> {{$tema->title}}</h4>
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

        @php $counter = 1; @endphp

        <!-- TEMA -->
            <div class="forum-post">
                <div class="forum-panel">
                    <div class="forum-user">
                        @php $autor = $tema->user; @endphp
                        <a href="/usuario/{{$autor->nickname}}" class="avatar"><img src="{{$autor->avatar}}" alt=""><span class="@if($autor->estaConectado()) label label-success @else label label-danger @endif"></span></a>
                        <div>
                            <a href="/usuario/{{$autor->nickname}}">{{$autor->nickname}}</a>
                            <span>Miembro desde</span>
                            <span class="date">{{$autor->created_at}}</span>
                        </div>
                    </div>
                    <div class="forum-body">
                        {!! $tema->content !!}
                    </div>
                </div>
                <div class="forum-footer">
                    <ul class="post-action">
                        <li><a href="#"><i class="fa fa-heart"></i> me gusta (0)</a></li>
                        <li><a href="#"><i class="fa fa-reply"></i> responder</a></li>
                        <li><a href="#"><i class="fa fa-flag"></i> Reportar</a></li>
                    </ul>
                    <ul class="post-meta">
                        <li><i class="fa fa-calendar-o"></i> {{$tema->created_at}}</li>
                        <li>#{{$counter}}</li>
                    </ul>
                </div>
            </div>

            @foreach($temasRespuestas as $respuesta)
                @php $counter++ @endphp
                <div class="forum-post">
                    <div class="forum-panel">
                        <div class="forum-user">
                            @php $autor = $respuesta->user; @endphp
                            <a href="/usuario/{{$autor->nickname}}" class="avatar"><img src="{{$autor->avatar}}" alt=""><span class="@if($autor->estaConectado()) label label-success @else label label-danger @endif"></span></a>
                            <div>
                                <a href="/usuario/{{$autor->nickname}}">{{$autor->nickname}}</a>
                                <span>Miembro desde</span>
                                <span class="date">{{$autor->created_at}}</span>
                            </div>
                        </div>
                        <div class="forum-body">
                            {!! $respuesta->content !!}
                        </div>
                    </div>
                    <div class="forum-footer">
                        <ul class="post-action">
                            <li><a href="#"><i class="fa fa-heart"></i> me gusta (0)</a></li>
                            <li><a href="#"><i class="fa fa-reply"></i> responder</a></li>
                            <li><a href="#"><i class="fa fa-flag"></i> Reportar</a></li>
                        </ul>
                        <ul class="post-meta">
                            <li><i class="fa fa-calendar-o"></i> {{$respuesta->created_at}}</li>
                            <li>#{{$counter}}</li>
                        </ul>
                    </div>
                </div>
            @endforeach

            <div class="headline">
                <h4><i class="fa fa-comment"></i> Escribe una respuesta</h4>
            </div>
            <form action="" method="POST">
                {{ csrf_field() }}
                <div class="margin-top-15">
                    @if ($errors->has('content'))
                        <div class="alert alert-danger margin-bottom-15">
                            Error
                        </div>
                    @endif
                    <div class="forum-post">
                        <textarea name="content"></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-rounded btn-lg btn-shadow pull-right">Enviar respuesta</button>
            </form>
        </div>
    </section>
@endsection

@section('script')
    <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/plugins/summernote/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('textarea').summernote({
                height: 250,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['picture', ['picture', 'video']],
                ]
            });
        });
    </script>
@endsection