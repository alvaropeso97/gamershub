@extends('master')
@section('titulo', 'GamersHUB - Actualidad y novedades de videojuegos, comunidad gamer, servicios para jugadores')
@section('css')
    <link href="{{ URL::asset('plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link rel="stylesheet" media="screen" type="text/css" href="{{ URL::asset('plugins/colorpicker/css/colorpicker.css') }}" />
@endsection
@section('contenido')
    <section class="bg-primary">
        <div class="container">
            <h3 class="color-white font-weight-300">@if(isset($category)) @lang('admin.editCategory.title') @else @lang('admin.addCategory.title') @endif</h3>
        </div>
    </section>
    <section class="border-bottom-1 border-grey-300 padding-top-10 padding-bottom-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="/">@lang('general.index.title')</a></li>
                        <li><a href="#">@lang('general.categories.title')</a></li>
                        <li class="active">@if(isset($category)) @lang('general.edit') @else @lang('general.add') @endif</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <form action="" method="POST" id="category_form">
        {{ csrf_field() }}
        <div class="container margin-bottom-30">
        <div class="row margin-top-30">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if ($errors->has('name'))
                            <div class="alert alert-danger">
                                @lang('admin.addEditCategory.name.error')
                            </div>
                        @endif
                            @if ($errors->has('alias'))
                                <div class="alert alert-danger">
                                    @lang('admin.addEditCategory.alias.error')
                                </div>
                            @endif
                            @if ($errors->has('color'))
                                <div class="alert alert-danger">
                                    @lang('admin.addEditCategory.color.error')
                                </div>
                            @endif
                            <div class="row margin-bottom-20">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">@lang('admin.addEditCategory.name.label')</label>
                                    <input type="text" class="form-control" value="@if(isset($category)){{$category->name}}@else{{ old('name') }}@endif" placeholder="@lang('admin.addEditCategory.name.input')" name="name" id="name">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="alias">@lang('admin.addEditCategory.alias.label')</label>
                                    <input type="text" class="form-control" value="@if(isset($category)){{$category->alias}}@else{{ old('alias') }}@endif" placeholder="@lang('admin.addEditCategory.alias.input')" name="alias" id="alias">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="color">@lang('admin.addEditCategory.color.label')</label>
                                    <input type="text" class="form-control" value="@if(isset($category)){{$category->color}}@else{{ old('color') }}@endif" placeholder="@lang('admin.addEditCategory.color.input')" name="color" id="color" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="checkbox checkbox-icon checkbox-inline checkbox-success">
                                        <input type="checkbox" name="its_platform" id="its_platform" @if(isset($category) && $category->its_platform == "1") checked @endif>
                                        <label for="its_platform">@lang('admin.addEditCategory.its_platform.label')</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <button type="button" class="btn btn-lg btn-block btn-rounded btn-shadow btn-success " id="save_btn">@lang('general.save.button')</button>
                @if(isset($category))
                <button type="button" class="btn btn-lg btn-block btn-rounded btn-shadow btn-danger " id="delete_btn">@lang('general.delete.button')</button>
                @endif
                <button onclick='window.location.href="{{route('admin.categories.home')}}"' type="button" class="btn btn-sm btn-block btn-rounded btn-shadow btn-secondary ">@lang('general.cancel.button')</button>
            </div>
        </div>
    </div>
    </form>
@endsection
@section('script')
    <script src="{{ URL::asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/colorpicker/js/colorpicker.js') }}"></script>
    <script>
        //Colorpicker
        $('#color').ColorPicker({
            color: '@if(isset($category)){{$category->color}}@endif',
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                $('#color').val('#' + hex);
            }
        });

        //Confirmar eliminación del artículo
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
                        //Petición ajax para eliminar la categoría

                    } else {
                        swal("@lang('general.cancel_confirmed.title')", "@lang('general.cancel_confirmed.description')", "error");
                    }
                });
        });

        $("#save_btn").click(function () {
            swal({
                    title: "@lang('general.confirm_save.title')",
                    text: "@lang('general.confirm_save.description')",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#27ae60",
                    confirmButtonText: "@lang('general.yes')",
                    cancelButtonText: "@lang('general.no')",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        swal("@lang('general.save_confirmed.title')", "@lang('general.save_confirmed.description')", "success");
                        $('#category_form').submit();
                    } else {
                        swal("@lang('general.save_confirmed.title')", "@lang('general.save_confirmed.description')", "error");
                    }
                });
        });

        function getCleanedString(cadena){
            // Definimos los caracteres que queremos eliminar
            var specialChars = "!¡@#$^&%*()+=-[]\/{}|:<>?¿,.";

            // Los eliminamos todos
            for (var i = 0; i < specialChars.length; i++) {
                cadena= cadena.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
            }

            // Lo queremos devolver limpio en minusculas
            cadena = cadena.toLowerCase();

            // Quitamos espacios y los sustituimos por _ porque nos gusta mas asi
            cadena = cadena.replace(/ /g,"-");

            // Quitamos acentos y "ñ". Fijate en que va sin comillas el primer parametro
            cadena = cadena.replace(/á/gi,"a");
            cadena = cadena.replace(/é/gi,"e");
            cadena = cadena.replace(/í/gi,"i");
            cadena = cadena.replace(/ó/gi,"o");
            cadena = cadena.replace(/ú/gi,"u");
            cadena = cadena.replace(/ñ/gi,"n");
            return cadena;
        }

        $('#name').keyup(function() {
            $('#alias').val(getCleanedString($(this).val())); // set value
        });
    </script>
@endsection