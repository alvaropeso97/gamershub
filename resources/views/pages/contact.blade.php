@extends('layouts.master')
@section('titulo', 'GamersHUB - Contacto')

@section('contenido')

    <section class="hero">
        <div class="hero-bg-primary" style="background: #a3112e; opacity: 0.9;"></div>
        <div class="container">
            <div class="page-header">
                <div class="page-title">CONTACTO</div>
                <ol class="breadcrumb">
                    <li><a href="/">Inicio</a></li>
                    <li><a href="/">GAMERSHUB</a></li>
                    <li class="active">Contacto</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="padding-30">
        <div class="container text-center">
            <h2 class="font-size-22 font-weight-300">¿Tienes algo que contarnos? Queremos escucharte.</h2>
        </div>
    </section>

    <section class="overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="title">
                        <h4><i class="fa fa-envelope"></i> Formulario de contacto</h4>
                        <p>Si tienes alguna duda, sugerencia, o simplemente quieres decirnos algo. Completa el siguiente formulario o envíanos un email a <b>contacto@gamershub.es</b></p>
                    </div>
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nombre" required>
                        </div>
                        <div class="form-group">
                        <select name="tipo" class="form-control" style="height: 45px;">
                            <option name="tipo" value="soporte">Soporte</option>
                            <option name="tipo" value="publicidad">Publicidad</option>
                            <option name="tipo" value="colaboracion">Colaboraciones</option>
                            <option name="tipo" value="redaccion">Redacción</option>
                            <option name="tipo" value="publicidad">Ofertas de trabajo</option>
                        </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Asunto" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="7" placeholder="Escribe tu mensaje..."></textarea>
                        </div>
                        <div class="text-center margin-top-30">
                            <button type="button" class="btn btn-primary btn-lg btn-rounded btn-shadow">Enviar mensaje</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5 height-300">
                    <img src="img/content/contacto.png" class="image-right" alt="">
                </div>
            </div>
        </div>
    </section>
    </div>
    <!-- /#wrapper -->

@endsection