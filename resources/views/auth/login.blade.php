@extends('master')
@section('titulo', 'Acceso de usuarios de GamersHUB')

@section('contenido')
    <section class="hero hero-panel" style="background-image: url(https://i.redd.it/tm1uwzlrz1wx.jpg)">
        <div class="hero-bg"></div>
        <div class="container relative">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 pull-none margin-auto">
                    <div class="panel panel-default panel-login">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-user"></i>@lang('auth.login.title')</h3>
                        </div>
                        <div class="panel-body">
                            <a class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook"></i>@lang('auth.facebook_login.button')</a>
                            <div class="separator"></div>
                            <form role="form" method="POST" action="/autenticar">
                                {{ csrf_field() }}
                                @if(Session::has('error'))
                                    <div class="alert alert-danger">
                                        {{Session::get('error')}}
                                    </div>
                                @endif
                                @if(Session::has('mensaje'))
                                    <div class="alert alert-success">
                                        {{Session::get('mensaje')}}
                                    </div>
                                @endif
                                <div class="form-group input-icon-left">
                                    <i class="fa fa-envelope"></i>
                                    <input id="email" type="email" class="form-control" name="email" placeholder="@lang('auth.email.input')" required autofocus>
                                </div>
                                <div class="form-group input-icon-left">
                                    <i class="fa fa-lock"></i>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="@lang('auth.password.input')" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">@lang('auth.enter.button')</button>

                                <div class="form-actions">
                                    <div class="checkbox checkbox-primary">
                                        <input name="remember" type="checkbox" id="checkbox">
                                        <label for="checkbox">@lang('auth.remember_me.checkbox')</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer">
                            @lang('auth.register.text')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection