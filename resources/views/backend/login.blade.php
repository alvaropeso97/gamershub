@extends('backend.master')
@section('titulo', 'Login')
@section('contenido')
    <div class="account-container">

        <div class="content clearfix">

            <form action="#" method="post" autocomplete="off">

                <h1>Acceso de usuarios</h1>

                <div class="login-fields">
                    <div class="field">
                        <label for="email">E-mail</label>
                        <input type="text" id="email" name="email" placeholder="Dirección de correo electrónico"
                               class="login username-field"/>
                    </div>
                    <div class="field">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" placeholder="Contraseña"
                               class="login password-field"/>
                    </div>
                </div>

                <div class="login-actions">
                    <button class="button btn btn-success btn-large">Acceder</button>
                </div>


            </form>

        </div>

    </div>
@endsection