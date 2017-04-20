@extends('layouts.master')
@section('titulo', 'GamersHUB - Confirmar correo electrónico')

@section('contenido')
    <section class="hero hero-panel" style="background-image: url(/img/bg/bgreg.jpg);">
        <div class="hero-bg"></div>
        <div class="container relative">
            <div class="row">
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 pull-none margin-auto">
                    <div class="panel panel-default panel-login">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-users"></i> Confirmar dirección de correo electrónico</h3>
                        </div>
                        <div class="panel-body">
                            @if($accion == 0)
                                <div class="alert alert-danger">
                                    <b>[Error CE.{{$accion}}]</b> El usuario no existe en nuestra base de datos
                                </div>
                            @endif
                            @if($accion == 1)
                                    <div class="alert alert-danger">
                                        <b>[Error CE.{{$accion}}]</b> El usuario ya ha confirmado su dirección de correo electrónico
                                    </div>
                            @endif
                            @if($accion == 2)
                                    <div class="alert alert-danger">
                                        <b>[Error CE.{{$accion}}]</b> El token de confirmación es incorrecto
                                    </div>
                            @endif
                            @if($accion == 3)
                                    <div class="alert alert-success">
                                        Has confirmado tu dirección de correo electrónico correctamente, ya puedes acceder al sistema con tus datos de acceso
                                    </div>
                            @endif
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