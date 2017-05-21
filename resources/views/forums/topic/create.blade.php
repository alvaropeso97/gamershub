@extends('master')
@section('titulo', 'Nuevo tema')

@section('css')
    <link href="/plugins/animate/animate.min.css" rel="stylesheet">
    <link href="/plugins/summernote/summernote.css" rel="stylesheet">
@endsection

@section('contenido')
    <section class="border-bottom-1 border-grey-300 padding-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="/">Inicio</a></li>
                        <li><a href="#">Foros</a></li>
                        <li><a href="#">{{$forum->title}}</a></li>
                        <li class="active">Nuevo tema</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-grey-50 padding-bottom-60">
        <div class="container">
            <div class="headline">
                <h4 class="no-padding-top">Nuevo tema
                    <small>en {{$forum->title}}</small>
                </h4>
            </div>

            <form action="" method="POST">
                {{ csrf_field() }}
                <div class="panel panel-default margin-bottom-30">
                    <div class="panel-body">
                        <div class="form-label">
                            @if ($errors->has('title'))
                                <div class="alert alert-danger">
                                    Error
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="thread" class="col-md-2">Título</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="title" placeholder="Título del tema">
                                </div>
                            </div>
                            <div class="form-group row">
                                @if ($errors->has('content'))
                                    <div class="alert alert-danger margin-bottom-15">
                                        Error
                                    </div>
                                @endif
                                <label class="col-md-2">Contenido</label>
                                <div class="col-md-10">
                                    <div class="forum-post no-margin no-shadow">
                                        <textarea name="content"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg btn-rounded btn-shadow">Crear tema</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('script')
    <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/plugins/summernote/summernote.min.js"></script>
    <script>
        $(document).ready(function () {
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