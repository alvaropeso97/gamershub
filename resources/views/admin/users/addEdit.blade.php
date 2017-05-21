@extends('master')
@section('titulo', 'GamersHUB - Actualidad y novedades de videojuegos, comunidad gamer, servicios para jugadores')
@section('css')
    <link href="{{ URL::asset('plugins/tags-input/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('plugins/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <style>
        .upload_file_label {
            position: relative;
        }
        .upload_file_label input {
            position: absolute;
            z-index: 2;
            opacity: 0;
            width: 100%;
            height: 100%;
        }

        #image_preview{
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
@endsection
@section('contenido')
    <section class="bg-primary">
        <div class="container">
            <h3 class="color-white font-weight-300">@lang('admin.addUser.title') | @lang('admin.editUser.title')</h3>
        </div>
    </section>
    <section class="border-bottom-1 border-grey-300 padding-top-10 padding-bottom-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="/">@lang('general.index.title')</a></li>
                        <li><a href="#">@lang('general.users.title')</a></li>
                        <li class="active">@lang('general.add') | @lang('general.edit')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="container margin-bottom-30">
        <div class="row margin-top-30">
            <div class="col-lg-8">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading" id="headingOne">
                            <h4 class="panel-title">
                                <a href="#personal_info" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" class="">
                                    @lang('general.personal_info.title')
                                </a>
                            </h4>
                        </div>
                        <div id="personal_info" class="panel-collapse collapse in" aria-expanded="true">
                            <div class="panel-body">
                                <div class="row margin-bottom-20">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email">@lang('admin.addEditUser.email.label')</label>
                                            <input type="email" class="form-control" placeholder="@lang('admin.addEditUser.email.input')" name="email" id="email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nickname">@lang('admin.addEditUser.nickname.label')</label>
                                            <input type="text" class="form-control" placeholder="@lang('admin.addEditUser.nickname.input')" name="nickname" id="nickname">
                                        </div>
                                    </div>
                                </div>
                                <div class="row margin-bottom-20">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="name">@lang('admin.addEditUser.name.label')</label>
                                            <input type="text" class="form-control" placeholder="@lang('admin.addEditUser.name.input')" name="name" id="name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="surname">@lang('admin.addEditUser.surname.label')</label>
                                            <input type="text" class="form-control" placeholder="@lang('admin.addEditUser.surname.input')" name="surname" id="surname">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="gender">@lang('admin.addEditUser.gender.label')</label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="H">@lang('general.gender.men')</option>
                                            <option value="">@lang('general.gender.women')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row margin-bottom-20">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="birthdate">@lang('admin.addEditUser.birthdate.label')</label>
                                            <input type="text" class="form-control" placeholder="@lang('admin.addEditUser.birthdate.input')" name="birthdate" id="birthdate">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="country_id">@lang('admin.addEditUser.country_id.label')</label>
                                            <select name="country_id" id="country_id" class="form-control selectpicker" data-live-search="true">
                                                @foreach(\App\Models\Users\Country::all() as $country)
                                                    <option name="country" value="{{$country->id}}">{{$country->country}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="city">@lang('admin.addEditUser.city.label')</label>
                                            <input type="text" class="form-control" placeholder="@lang('admin.addEditUser.city.input')" name="city" id="city">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="signature">@lang('admin.addEditUser.signature.label')</label>
                                            <textarea name="signature" id="signature"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="password_pane_header">
                            <h4 class="panel-title">
                                <a href="#password_pane" class="collapsed" data-toggle="collapse" data-parent="#accordion" aria-expanded="false">
                                    @lang('general.password.title')
                                </a>
                            </h4>
                        </div>
                        <div id="password_pane" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="password">@lang('admin.addEditUser.password.label')</label>
                                            <input type="password" class="form-control" placeholder="@lang('admin.addEditUser.password.input')" name="password" id="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="password_repeat">@lang('admin.addEditUser.password_repeat.label')</label>
                                            <input type="password" class="form-control" placeholder="@lang('admin.addEditUser.password_repeat.input')" name="password_repeat" id="password_repeat">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" id="headingTwo">
                            <h4 class="panel-title">
                                <a href="#privacy" class="collapsed" data-toggle="collapse" data-parent="#accordion" aria-expanded="false">
                                    @lang('general.privacy_config.title')
                                </a>
                            </h4>
                        </div>
                        <div id="privacy" class="panel-collapse collapse" role="tabpanel" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-icon checkbox-inline checkbox-success">
                                                <input type="checkbox" id="public_profile">
                                                <label for="public_profile">@lang('admin.addEditUser.public_profile.label')</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox checkbox-icon checkbox-inline checkbox-success">
                                                <input type="checkbox" id="public_city">
                                                <label for="public_city">@lang('admin.addEditUser.public_city.label')</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox checkbox-icon checkbox-inline checkbox-success">
                                                <input type="checkbox" id="public_age">
                                                <label for="public_age">@lang('admin.addEditUser.public_age.label')</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox checkbox-icon checkbox-inline checkbox-success">
                                                <input type="checkbox" id="public_accounts">
                                                <label for="public_accounts">@lang('admin.addEditUser.public_accounts.label')</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox checkbox-icon checkbox-inline checkbox-success">
                                                <input type="checkbox" id="public_con_accounts">
                                                <label for="public_con_accounts">@lang('admin.addEditUser.public_con_accounts.label')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a href="#accounts" class="collapsed" data-toggle="collapse" data-parent="#accordion" aria-expanded="false">
                                    @lang('general.associated_accounts.title')
                                </a>
                            </h4>
                        </div>
                        <div id="accounts" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="xbox_gamertag">@lang('admin.addEditUser.xbox_gamertag.label')</label>
                                            <input type="text" class="form-control" placeholder="@lang('admin.addEditUser.xbox_gamertag.input')" name="xbox_gamertag" id="xbox_gamertag">
                                        </div>
                                        <div class="form-group">
                                            <label for="ps_id">@lang('admin.addEditUser.ps_id.label')</label>
                                            <input type="text" class="form-control" placeholder="@lang('admin.addEditUser.ps_id.input')" name="ps_id" id="ps_id">
                                        </div>
                                        <div class="form-group">
                                            <label for="nintendo_network">@lang('admin.addEditUser.nintendo_network.label')</label>
                                            <input type="text" class="form-control" placeholder="@lang('admin.addEditUser.nintendo_network.input')" name="nintendo_network" id="nintendo_network">
                                        </div>
                                        <div class="form-group">
                                            <label for="friend_code_wii">@lang('admin.addEditUser.friend_code_wii.label')</label>
                                            <input type="text" class="form-control" placeholder="@lang('admin.addEditUser.friend_code_wii.input')" name="friend_code_wii" id="friend_code_wii">
                                        </div>
                                        <div class="form-group">
                                            <label for="friend_code_3ds">@lang('admin.addEditUser.friend_code_3ds.label')</label>
                                            <input type="text" class="form-control" placeholder="@lang('admin.addEditUser.friend_code_3ds.input')" name="friend_code_3ds" id="friend_code_3ds">
                                        </div>
                                        <div class="form-group">
                                            <label for="microsoft_gamertag">@lang('admin.addEditUser.microsoft_gamertag.label')</label>
                                            <input type="text" class="form-control" placeholder="@lang('admin.addEditUser.microsoft_gamertag.input')" name="microsoft_gamertag" id="microsoft_gamertag">
                                        </div>
                                        <div class="form-group">
                                            <label for="steam_id">@lang('admin.addEditUser.steam_id.label')</label>
                                            <input type="text" class="form-control" placeholder="@lang('admin.addEditUser.steam_id.input')" name="steam_id" id="steam_id">
                                        </div>
                                        <div class="form-group">
                                            <label for="twitter">@lang('admin.addEditUser.twitter.label')</label>
                                            <input type="text" class="form-control" placeholder="@lang('admin.addEditUser.twitter.input')" name="twitter" id="twitter">
                                        </div>
                                        <div class="form-group">
                                            <label for="facebook">@lang('admin.addEditUser.facebook.label')</label>
                                            <input type="text" class="form-control" placeholder="@lang('admin.addEditUser.facebook.input')" name="facebook" id="facebook">
                                        </div>
                                        <div class="form-group">
                                            <label for="google">@lang('admin.addEditUser.google.label')</label>
                                            <input type="text" class="form-control" placeholder="@lang('admin.addEditUser.google.input')" name="google" id="google">
                                        </div>
                                        <div class="form-group">
                                            <label for="web_blog">@lang('admin.addEditUser.web_blog.label')</label>
                                            <input type="text" class="form-control" placeholder="@lang('admin.addEditUser.web_blog.input')" name="web_blog" id="web_blog">
                                        </div>
                                    </div>
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
                <div class="card card-hover margin-top-30" id="game_id_box" style="display: none;">
                    <div class="card-img">
                        <img src="http://placehold.it/370x250/ECECEC" alt="">
                    </div>
                    <div class="caption">
                        <h3 class="card-title"><a href="#">Titulo del juego relacionado</a></h3>
                        <p>Descripción del juego relacionado</p>
                        <a href="#" class="btn btn-block btn-primary">general.view_game</a>
                    </div>
                </div>
                <div class="panel panel-default margin-top-30">
                    <div class="panel-heading">
                        <h3 class="panel-title">admin.articleUser.title</h3>
                    </div>
                    <div class="panel-body text-center">
                        <img src="http://placehold.it/150x150/ECECEC" width="150px" height="150px" class="img-thumbnail" id="avatar_preview" alt="" style="margin-bottom: 25px;">
                        <h3>user.nickname <small>dd/mm/aa hh:mm</small></h3>
                        <div class="upload_file_label btn btn-lg btn-block btn-shadow btn-success margin-top-20">
                            <input type="file" name="image" id="avatar">
                            <span>@lang('general.upload_file.button')</span>
                        </div>
                        <div class="form-group margin-top-20">
                            <div class="checkbox checkbox-icon checkbox-inline checkbox-success">
                                <input type="checkbox" id="verified">
                                <label for="verified">@lang('admin.addEditUser.verified.label')</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <script src="{{ URL::asset('plugins/tags-input/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ URL::asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ URL::asset('plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js') }}"></script>
    <script>
        //Preview avatar
        function readURLBoxed(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#avatar_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#avatar").change(function(){
            $( "#avatar_preview" ).show();
            readURLBoxed(this);
        });

        //Editor de textos
        CKEDITOR.replace( 'signature' );

        //Datepicker
        $('#birthdate').datepicker({
            language: 'es'
        });
        //Confirmar eliminación del usuario
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