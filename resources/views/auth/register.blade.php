@extends('layouts.master')
@section('titulo', 'Registrarse en la comunidad de GamersHUB')

@section('contenido')
    <section class="hero hero-panel">
        <div class="hero-bg"></div>
        <div class="container relative">
            <div class="row">
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 pull-none margin-auto">
                    <div class="panel panel-default panel-login">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-users"></i> Regístrate en GamersHUB</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-6" style="text-align: center; padding-left: 20px; padding-right: 20px; padding-top: 100px; padding-bottom: 40px;">

                                <div class="title">
                                    <h4><i class="fa fa-gamepad"></i> Noticias, análisis, avances, vídeos...</h4><br>
                                    Diariamente te traemos las últimas novedades del mundo de los videojuegos de manos de profesionales que comparten tu misma afición, los videojuegos.
                                </div>
                                <div class="title">
                                    <h4><i class="fa fa-users"></i> Comunidad</h4><br>
                                    Comparte tus experiencias con el resto de la comunidad GamersHUB, participa en los foros de tus juegos favoritos, sígue a tus títulos favoritos, edita tu perfil...
                                </div>
                                <div class="title">
                                    <h4><i class="fa fa-server"></i> Servicios para "gamers"</h4><br>
                                    Disfruta de los diferentes servidores que ponemos a tu disposición para que puedas disfrutar de la experiencia al máximo.
                                </div>
                                <h2><i>Y mucho más...</i></h2>
                            </div>
                            <div class="col-lg-6">
                                <form role="form" method="POST" action="{{ secure_url('/register') }}">

                                    {{ csrf_field() }}

                                    @if ($errors->has('condiciones'))
                                        <div class="alert alert-danger">
                                            Debes aceptar las condiciones de uso y política de privacidad
                                        </div>
                                    @endif
                                    <label>Nombre de usuario (Nickname)</label>
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger">
                                            El nombre de usuario es incorrecto o está siendo utilizado por otro usuario, si es usted el propietario de esa cuenta accede desde <a href="/login">aquí</a>
                                        </div>
                                    @endif
                                    <div class="form-group input-icon-left {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <i class="fa fa-user"></i>
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre de usuario" autofocus>
                                    </div>

                                    <label>E-mail</label>
                                    @if ($errors->has('email'))
                                        <div class="alert alert-danger">
                                            Los emails introducidos no coinciden o ya está siendo utilizado, si es usted el propietario de esa cuenta accede desde <a href="/login">aquí</a>
                                        </div>
                                    @endif
                                    <div class="form-group input-icon-left {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <i class="fa fa-envelope"></i>
                                        <input id="email" type="email" class="form-control" name="email" placeholder="Email"  value="{{ old('email') }}">
                                    </div>

                                    <div class="form-group input-icon-left {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <i class="fa fa-envelope"></i>
                                        <input type="email" class="form-control" name="email_confirmation" placeholder="Repite tu email"  value="">
                                    </div>

                                    <label>Fecha de nacimiento</label>
                                    @if ($errors->has('dia'))
                                        <div class="alert alert-danger">
                                            Debes seleccionar el día</a>
                                        </div>
                                    @endif
                                    @if ($errors->has('mes'))
                                        <div class="alert alert-danger">
                                            Debes seleccionar el mes</a>
                                        </div>
                                    @endif
                                    @if ($errors->has('ano'))
                                        <div class="alert alert-danger">
                                            Debes seleccionar el año</a>
                                        </div>
                                    @endif
                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <select name="dia" class="form-control" style="height: 45px;">
                                                    <option name="dia" value="" selected>Dia</option>
                                                    @php $dia = 1; @endphp
                                                    @while($dia <= 31)
                                                        <option name="dia" value="{{$dia}}">{{$dia}}</option>
                                                        @php $dia++ @endphp
                                                        @endwhile
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <select name="mes" class="form-control" style="height: 45px;">
                                                    <option name="mes" value="" selected>Mes</option>
                                                    <option name="mes" value="01">Enero</option>
                                                    <option name="mes" value="02">Febrero</option>
                                                    <option name="mes" value="03">Marzo</option>
                                                    <option name="mes" value="04">Abril</option>
                                                    <option name="mes" value="05">Mayo</option>
                                                    <option name="mes" value="06">Junio</option>
                                                    <option name="mes" value="07">Julio</option>
                                                    <option name="mes" value="08">Agosto</option>
                                                    <option name="mes" value="09">Septiembre</option>
                                                    <option name="mes" value="10">Octubre</option>
                                                    <option name="mes" value="11">Noviembre</option>
                                                    <option name="mes" value="12">Diciembre</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <select name="ano" class="form-control" style="height: 45px;">
                                                    <option name="ano" value="" selected>Año</option>
                                                    @php $ano = 2016; $contador = 0; @endphp
                                                    @while($contador <= 115)
                                                        <option name="ano" value="{{$ano}}">{{$ano}}</option>
                                                        @php $contador++; $ano--; @endphp
                                                    @endwhile
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <label>Contraseña de acceso</label>
                                    @if ($errors->has('password'))
                                        <div class="alert alert-danger">
                                            Las claves introducidas no coinciden o no contienen más de <b>6</b> caracteres
                                        </div>
                                    @endif
                                    <div class="form-group input-icon-left {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <i class="fa fa-lock"></i>
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña">
                                    </div>
                                    <div class="form-group input-icon-left {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <i class="fa fa-check"></i>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Repite la contraseña">
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block">Registrarme en GamersHUB</button>

                                    <div class="form-actions">
                                        <div class="checkbox checkbox-primary">
                                            <input type="checkbox" id="noticias" checked>
                                            <label for="noticias">Deseo recibir semanalmente las últimas novedades en mi bandeja de correo electrónico.</label>
                                            <input type="checkbox" name="condiciones" id="condiciones">
                                            <label for="condiciones">Acepto las <a target="_blank" href="/aviso-legal" style="color: #ac2943;">condiciones de uso y política de privacidad.</a></label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="panel-footer">
                            ¿Ya tienes una cuenta? <a href="/login">Accede desde aquí</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection