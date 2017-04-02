@extends('layouts.master')
@section('titulo', 'GamersHUB - '. $id->name)

@section('contenido')
    <section class="hero cover hidden-xs" style="background-image: url({{$id->img_header}});">
        <div class="hero-bg"></div>
        <div class="container relative">
            <div class="page-header">
                <div class="profile-avatar">
                    <div class="thumbnail" data-toggle="tooltip" title="{{$id->name}}">
                        <a href="#">
                            <img src="{{$id->img_perfil}}">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="profile-nav height-50 border-bottom-1 border-grey-300  hidden-xs">
        <div class="tab-select sticky">
            <div class="container">
                <ul class="nav nav-tabs" role="tablist">
                    <li><a href="#">Timeline</a></li>
                    <li><a href="#">Acerca de mí</a></li>
                    <li><a href="#">Amigos <span>(0)</span></a></li>
                    <li><a href="#">Imagenes <span>(0)</span></a></li>
                    <li><a href="#">Vídeos <span>(0)</span></a></li>
                    <li><a href="#">Grupos</a></li>
                    @if(Auth::check() && Auth::user()->id == $id->id)
                        <li class="active"><a href="/usuario/{{$id->name}}/editar">Editar mi perfil</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </section>

    <section class="bg-grey-50 padding-top-60 padding-top-sm-30">
        <div class="container">
            <div class="row">

                <!-- Barra lateral -->
                <div class="col-md-3 col-sm-4 hidden-xs">

                </div>

                <!-- Contenido principal -->
                <div class="col-md-9 col-sm-8">
                    <!-- Formulario para editar perfil -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#info_gral" data-toggle="tab" aria-expanded="true">Información general</a></li>
                        <li><a href="#apariencia_perfil" data-toggle="tab" aria-expanded="true">Apariencia y perfil</a></li>
                        <li><a href="#privacidad" data-toggle="tab" aria-expanded="true">Privacidad</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="info_gral">
                            @php $UsrInfo = \App\Http\Controllers\UsuariosController::devolverInfo($id->id) @endphp
                            <form method="post" action="/usuario/{{$id->name}}/editar/guardar-info">
                                {{ csrf_field() }}
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            @if(Session::has('mensaje')) <div class="alert alert-success"> {{Session::get('mensaje')}} </div> @endif
                                        </div>
                                    </div>
                                    <h2>Información general</h2>
                                    <div class="row margin-top-20">
                                        <div class="col-lg-8">
                                            <label>Plataformas</label>
                                            @php $plataformas_usuario = \App\Http\Controllers\UsuariosController::devolverPlataformasUsuario($id->id) @endphp
                                            <select id="categorias" name="plataformas[]" multiple class="form-control" style="height: 90px; padding: 0px;">
                                                @foreach(\App\Categoria::where('esplataforma','1')->get() as $plataforma)
                                                    <option id="categorias" name="plataformas[]" value="{{$plataforma->id}}" style="color: {{$plataforma->color}};" @if(count($plataformas_usuario) > 0 && in_array($plataforma->id, array_column($plataformas_usuario, "id_plataforma"))) selected @endif >{{$plataforma->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                        <div class="row margin-top-20">
                                            <div class="col-lg-8">
                                                <label>Me gustan los juegos de</label>
                                                <select name="genero_preferido" class="form-control">
                                                    <option name="genero_preferido" value="-1" selected>Seleccina un género</option>
                                                    @foreach(\App\Genero::all() as $genero)
                                                        <option name="genero_preferido" @if($UsrInfo->genero_preferido == $genero->id) selected @endif value="{{$genero->id}}">{{$genero->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    <div class="row margin-top-20">
                                        <div class="col-lg-4">
                                            <label>País</label>
                                            <div class="form-group input-icon-left">
                                                <i class="ion-earth"></i>
                                                <select name="pais" class="form-control">
                                                    <option name="pais" value="-1" selected>Seleccina tu país</option>
                                                    @foreach(\App\Pais::all() as $pais)
                                                        <option name="pais" @if($UsrInfo->pais == $pais->cod_pais) selected @endif value="{{$pais->cod_pais}}">{{$pais->pais}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Ciudad</label>
                                            <div class="form-group input-icon-left">
                                                <i class="ion-map"></i>
                                                <input type="text" name="ciudad" class="form-control" value="{{$UsrInfo->ciudad}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row margin-top-20">
                                        <div class="col-lg-5">
                                            <label>Sexo</label>
                                            <select name="sexo" class="form-control">
                                                <option name="sexo" @if($UsrInfo->sexo == 'H') selected @endif value="H">Hombre</option>
                                                <option name="sexo" value="M" @if($UsrInfo->sexo == 'M') selected @endif>Mujer</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Fecha de nacimiento</label>
                                            <input type="text" name="fecha_nacimiento" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row margin-top-20">
                                        <div class="col-lg-8">
                                            <label>Firma personal</label>
                                            <textarea name="firma_personal" class="form-control">{{$UsrInfo->firma_personal}}</textarea>
                                        </div>
                                        <hr class="col-lg-8">
                                    </div>

                                    <h2>Cuentas de juego</h2>
                                    <div class="row margin-top-20">
                                        <div class="col-lg-4">
                                            <div class="form-group input-icon-left">
                                                <i class="ion-xbox"></i>
                                                <input type="text" class="form-control" name="xbox_gamertag" placeholder="Xbox Gamertag" value="{{$UsrInfo->xbox_gamertag}}">
                                            </div>

                                            <div class="form-group input-icon-left">
                                                <i class="ion-playstation"></i>
                                                <input type="text" class="form-control" name="ps_id" placeholder="PlayStation ID" value="{{$UsrInfo->ps_id}}">
                                            </div>

                                            <div class="form-group input-icon-left">
                                                <i class="ion-network"></i>
                                                <input type="text" class="form-control" name="nintendo_network" placeholder="Nintendo Network (Wii U)" value="{{$UsrInfo->nintendo_network}}">
                                            </div>

                                            <div class="form-group input-icon-left">
                                                <i class="glyphicon glyphicon-user"></i>
                                                <input type="text" class="form-control" name="codigo_amigo_wii" placeholder="Código de Amigo (Wii)" value="{{$UsrInfo->codigo_amigo_wii}}">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group input-icon-left">
                                                <i class="glyphicon glyphicon-user"></i>
                                                <input type="text" class="form-control" name="codigo_amigo_3ds" placeholder="Código de Amigo (3DS)" value="{{$UsrInfo->codigo_amigo_3ds}}">
                                            </div>

                                            <div class="form-group input-icon-left">
                                                <i class="glyphicon glyphicon-user"></i>
                                                <input type="text" class="form-control" name="codigo_amigo_ds" placeholder="Código de Amigo (DS)" value="{{$UsrInfo->codigo_amigo_ds}}">
                                            </div>

                                            <div class="form-group input-icon-left">
                                                <i class="ion-social-windows"></i>
                                                <input type="text" class="form-control" name="microsoft_gamertag" placeholder="Microsoft Live Gamertag" value="{{$UsrInfo->microsoft_gamertag}}">
                                            </div>

                                            <div class="form-group input-icon-left">
                                                <i class="ion-steam"></i>
                                                <input type="text" class="form-control" name="steam_id" placeholder="Steam ID" value="{{$UsrInfo->steam_id}}">
                                            </div>
                                        </div>
                                        <hr class="col-lg-8">
                                    </div>

                                    <h2>Contacto</h2>
                                    <div class="row margin-top-20">
                                        <div class="col-lg-8">
                                            <label>Twitter</label>
                                            <div class="form-group input-icon-left">
                                                <i class="ion-social-twitter"></i>
                                                <input type="text" class="form-control" name="twitter" placeholder="" value="{{$UsrInfo->twitter}}">
                                            </div>

                                            <label>Facebook</label>
                                            <div class="form-group input-icon-left">
                                                <i class="ion-social-facebook"></i>
                                                <input type="text" class="form-control" name="facebook" placeholder="" value="{{$UsrInfo->facebook}}">
                                            </div>

                                            <label>Google</label>
                                            <div class="form-group input-icon-left">
                                                <i class="ion-social-google"></i>
                                                <input type="text" class="form-control" name="google" placeholder="" value="{{$UsrInfo->google}}">
                                            </div>

                                            <label>Web / Blog</label>
                                            <div class="form-group input-icon-left">
                                                <i class="ion-link"></i>
                                                <input type="text" class="form-control" name="web_blog" placeholder="" value="{{$UsrInfo->web_blog}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row margin-top-20">
                                        <div class="col-lg-8">
                                            <div class="pull-right">
                                                <input type="hidden" name="id" value="{{$id->id}}">
                                                <button type="submit" class="btn btn-success btn-icon-right">Guardar cambios<i class="fa fa-check-square-o"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="apariencia_perfil">
                            <div class="container">
                                <div class="row">
                                    <form>
                                        <div class="col-lg-6">
                                            <label>Imagen de perfil</label>
                                            <input name="img_perfil" type="file" class="form-control">
                                        </div>
                                        <div class="col-lg-2" style="margin-top: 33px">
                                            <button type="submit" class="btn btn-success btn-icon-right">Subir y aplicar<i class="fa fa-check-square-o"></i></button>
                                        </div>
                                    </form>
                                    <hr class="col-lg-8">
                                </div>

                                <div class="row">
                                    <form>
                                        <div class="col-lg-6">
                                            <label>Imagen de cabecera</label>
                                            <input name="img_perfil" type="file" class="form-control">
                                        </div>
                                        <div class="col-lg-2" style="margin-top: 33px">
                                            <button type="submit" class="btn btn-success btn-icon-right">Subir y aplicar<i class="fa fa-check-square-o"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="privacidad">
                            <div class="container">
                                @php $privacidad = \App\Http\Controllers\Privacidad_usuariosController::devolverOpcionesPrivacidad($id->id) @endphp
                                <form method="post" action="/usuario/{{$id->name}}/editar/guardar-privacidad">
                                    {{ csrf_field() }}
                                    <input type="hidden" class="form-control" name="id" value="{{$id->id}}">
                                    <div class="row margin-top-20">
                                        <div class="col-lg-8">
                                            <label>Mostrar mi página de perfil</label>
                                            <select name="mostrar_perfil" class="form-control">
                                                <option name="mostrar_perfil" value="0" @if($privacidad->mostrar_perfil == 0) selected @endif>A todo el mundo</option>
                                                <option name="mostrar_perfil" value="1" @if($privacidad->mostrar_perfil == 1) selected @endif>Solo a mis amigos</option>
                                                <option name="mostrar_perfil" value="2" @if($privacidad->mostrar_perfil == 2) selected @endif>Oculto para todos</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row margin-top-20">
                                        <div class="col-lg-8">
                                            <label>Mostrar mi ciudad y país</label>
                                            <select name="mostrar_ciudad" class="form-control">
                                                <option name="mostrar_ciudad" value="0" @if($privacidad->mostrar_ciudad == 0) selected @endif>A todo el mundo</option>
                                                <option name="mostrar_ciudad" value="1" @if($privacidad->mostrar_ciudad == 1) selected @endif>Solo a mis amigos</option>
                                                <option name="mostrar_ciudad" value="2" @if($privacidad->mostrar_ciudad == 2) selected @endif>Oculto para todos</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row margin-top-20">
                                        <div class="col-lg-8">
                                            <label>Mostrar mi edad</label>
                                            <select name="mostrar_edad" class="form-control">
                                                <option name="mostrar_edad" value="0" @if($privacidad->mostrar_edad == 0) selected @endif>A todo el mundo</option>
                                                <option name="mostrar_edad" value="1" @if($privacidad->mostrar_edad == 1) selected @endif>Solo a mis amigos</option>
                                                <option name="mostrar_edad" value="2" @if($privacidad->mostrar_edad == 2) selected @endif>Oculto para todos</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row margin-top-20">
                                        <div class="col-lg-8">
                                            <label>Mostrar mi sexo</label>
                                            <select name="mostrar_sexo" class="form-control">
                                                <option name="mostrar_sexo" value="0" @if($privacidad->mostrar_sexo == 0) selected @endif>A todo el mundo</option>
                                                <option name="mostrar_sexo" value="1" @if($privacidad->mostrar_sexo == 1) selected @endif>Solo a mis amigos</option>
                                                <option name="mostrar_sexo" value="2" @if($privacidad->mostrar_sexo == 2) selected @endif>Oculto para todos</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row margin-top-20">
                                        <div class="col-lg-8">
                                            <label>Mostrar mis cuentas de juego</label>
                                            <select name="mostrar_cuentas_jue" class="form-control">
                                                <option name="mostrar_cuentas_jue" value="0" @if($privacidad->mostrar_cuentas_jue == 0) selected @endif>A todo el mundo</option>
                                                <option name="mostrar_cuentas_jue" value="1" @if($privacidad->mostrar_cuentas_jue == 1) selected @endif>Solo a mis amigos</option>
                                                <option name="mostrar_cuentas_jue" value="2" @if($privacidad->mostrar_cuentas_jue == 2) selected @endif>Oculto para todos</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row margin-top-20">
                                        <div class="col-lg-8">
                                            <label>Mostrar mis cuentas de contacto</label>
                                            <select name="mostrar_cuentas_con" class="form-control">
                                                <option name="mostrar_cuentas_con" value="0" @if($privacidad->mostrar_cuentas_con == 0) selected @endif>A todo el mundo</option>
                                                <option name="mostrar_cuentas_con" value="1" @if($privacidad->mostrar_cuentas_con == 1) selected @endif>Solo a mis amigos</option>
                                                <option name="mostrar_cuentas_con" value="2" @if($privacidad->mostrar_cuentas_con == 2) selected @endif>Oculto para todos</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row margin-top-20">
                                        <div class="col-lg-8">
                                            <div class="pull-right">
                                                <button type="submit" class="btn btn-success btn-icon-right">Confirmar opciones de privacidad<i class="fa fa-check-square-o"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection