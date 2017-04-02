@extends('layouts.master')
@section('titulo', 'Acceso de usuarios de '.\App\ConfigGeneral::first()->nombre_aplicacion)

@section('contenido')
    <section class="hero hero-panel" style="background-image: url(/img/bg/bgreg.jpg);">
        <div class="hero-bg"></div>
        <div class="container relative">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 pull-none margin-auto">
                    <div class="panel panel-default panel-login">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-user"></i> Accede a GamersHUB</h3>
                        </div>
                        <div class="panel-body">
                            <a class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook"></i> Contectar con Facebook</a>
                            <div class="separator"></div>
                            <form role="form" method="POST" action="{{ url('/autenticar') }}">
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
                                    <input id="email" type="email" class="form-control" name="email" placeholder="E-mail" required autofocus>
                                </div>
                                <div class="form-group input-icon-left">
                                    <i class="fa fa-lock"></i>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Constraseña" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Entrar</button>

                                <div class="form-actions">
                                    <div class="checkbox checkbox-primary">
                                        <input name="remember" type="checkbox" id="checkbox">
                                        <label for="checkbox">Recordarme la próxima vez que inicie sesión</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer">
                            ¿Todavía no tienes una cuenta en GamersHUB? <a href="/register">Crea una nueva ahora</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection