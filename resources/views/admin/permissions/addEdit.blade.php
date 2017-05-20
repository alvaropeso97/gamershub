@extends('master')
@section('titulo', 'GamersHUB - Actualidad y novedades de videojuegos, comunidad gamer, servicios para jugadores')
@section('css')
    <link href="{{ URL::asset('plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
@endsection
@section('contenido')
    <section class="bg-primary">
        <div class="container">
            <h3 class="color-white font-weight-300">@lang('admin.addPermission.title') | @lang('admin.editPermission.title')</h3>
        </div>
    </section>
    <section class="border-bottom-1 border-grey-300 padding-top-10 padding-bottom-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="/">@lang('general.index.title')</a></li>
                        <li><a href="#">@lang('general.permissions.title')</a></li>
                        <li class="active">@lang('general.add') | @lang('general.edit')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="container margin-bottom-30">
        <div class="row margin-top-30">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">@lang('admin.addEditPermission.name.label')</label>
                                    <input type="text" class="form-control" placeholder="@lang('admin.addEditPermission.name.input')" name="name" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="name">@lang('admin.addEditPermission.description.label')</label>
                                    <input type="text" class="form-control" placeholder="@lang('admin.addEditPermission.description.input')" name="description" id="description">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <button type="button" class="btn btn-lg btn-block btn-rounded btn-shadow btn-success ">@lang('general.save.button')</button>
                <button type="button" class="btn btn-lg btn-block btn-rounded btn-shadow btn-danger " id="delete_btn">@lang('general.delete.button')</button>
                <button type="button" class="btn btn-sm btn-block btn-rounded btn-shadow btn-secondary ">@lang('general.cancel.button')</button>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        //Confirmar eliminación del permiso
        $("#delete_btn").click(function () {
            swal({
                    title: "@lang('general.confirm_delete.title')",
                    text: "@lang('general.confirm_delete.description')",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "@lang('general.yes')",
                    cancelButtonText: "@lang('general.no')",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        swal("@lang('general.delete_confirmed.title')", "@lang('general.delete_confirmed.description')", "success");
                    } else {
                        swal("@lang('general.cancel_confirmed.title')", "@lang('general.cancel_confirmed.description')", "error");
                    }
                });
        });
    </script>
@endsection