@extends('master')
@section('titulo', 'GamersHUB - Actualidad y novedades de videojuegos, comunidad gamer, servicios para jugadores')
@section('css')
    <link href="{{ URL::asset('plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
@endsection
@section('contenido')
    <section class="bg-primary">
        <div class="container">
            <h3 class="color-white font-weight-300">@lang('general.articles.title')</h3>
        </div>
    </section>
    <section class="border-bottom-1 border-grey-300 padding-top-10 padding-bottom-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="/">@lang('general.index.title')</a></li>
                        <li class="active">@lang('general.articles.title')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="container margin-bottom-30">
        <div class="row margin-top-30">
            <div class="col-lg-12">
                <div class="pull-right">
                    <a href="" class="btn btn-primary btn-icon-left"><i class="fa fa-plus"></i> @lang('admin.articles.new.button')</a>
                </div>
            </div>
        </div>
        <div class="row margin-top-30">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="hidden-xs">@lang('admin.articles.title.text')</th>
                                <th class="hidden-xs">@lang('admin.articles.user.text')</th>
                                <th>@lang('admin.articles.game_id.text')</th>
                                <th>@lang('admin.articles.created_at.text')</th>
                                <th>@lang('admin.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>cell.content</td>
                                    <td>cell.content</td>
                                    <td>cell.content</td>
                                    <td>cell.content</td>
                                    <td>cell.content</td>
                                    <td>
                                        <button class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" title="" data-original-title="edit"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-inverse btn-circle btn-sm" data-toggle="tooltip" title="" data-original-title="delete"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>cell.content</td>
                                    <td>cell.content</td>
                                    <td>cell.content</td>
                                    <td>cell.content</td>
                                    <td>cell.content</td>
                                    <td>
                                        <button class="btn btn-primary btn-circle btn-sm" data-toggle="tooltip" title="" data-original-title="edit"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-inverse btn-circle btn-sm" data-toggle="tooltip" title="" data-original-title="delete"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
@endsection