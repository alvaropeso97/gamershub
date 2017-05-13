@extends('master')
@section('titulo', 'Registrarse en la comunidad de GamersHUB')

@section('contenido')
    <section class="hero hero-panel">
        <div class="hero-bg"></div>
        <div class="container relative">
            <div class="row">
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 pull-none margin-auto">
                    <div class="panel panel-default panel-login">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-users"></i>@lang('auth.register.title')</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-6" style="text-align: center; padding-left: 20px; padding-right: 20px; padding-top: 100px; padding-bottom: 40px;">

                                <div class="title">
                                    <h4><i class="fa fa-gamepad"></i>@lang('auth.text1')</h4><br>
                                    @lang('auth.desc1')
                                </div>
                                <div class="title">
                                    <h4><i class="fa fa-users"></i>@lang('auth.text2')</h4><br>
                                    @lang('auth.desc2')
                                </div>
                                <div class="title">
                                    <h4><i class="fa fa-server"></i> @lang('auth.text3')</h4><br>
                                    @lang('auth.desc3')
                                </div>
                                <h2><i>@lang('auth.more')</i></h2>
                            </div>
                            <div class="col-lg-6">
                                <form role="form" method="POST" action="/register">

                                    {{ csrf_field() }}

                                    @if ($errors->has('condiciones'))
                                        <div class="alert alert-danger">
                                            @lang('auth.conditions.error')
                                        </div>
                                    @endif
                                    <label>@lang('auth.nickname.label')</label>
                                    @if ($errors->has('nickname'))
                                        <div class="alert alert-danger">
                                            @lang('auth.nickname.error')
                                        </div>
                                    @endif
                                    <div class="form-group input-icon-left {{ $errors->has('nickname') ? ' has-error' : '' }}">
                                        <i class="fa fa-user"></i>
                                        <input id="nickname" type="text" class="form-control" name="nickname" value="{{ old('nickname') }}" placeholder="@lang('auth.nickname.input')" autofocus>
                                    </div>

                                    <div class="form-group">
                                        @if ($errors->has('name'))
                                            <div class="alert alert-danger">
                                                @lang('auth.name.error')
                                            </div>
                                        @endif
                                        @if ($errors->has('surname'))
                                             <div class="alert alert-danger">
                                                @lang('auth.surname.error')
                                             </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <label>@lang('auth.name.label')</label>
                                                <div class="form-group input {{ $errors->has('name') ? ' has-error' : '' }}">
                                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="@lang('auth.name.input')">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <label>@lang('auth.surname.label')</label>
                                                <div class="form-group input {{ $errors->has('surname') ? ' has-error' : '' }}">
                                                    <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" placeholder="@lang('auth.surname.input')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        @if ($errors->has('country'))
                                            <div class="alert alert-danger">
                                                @lang('auth.country.error')
                                            </div>
                                        @endif
                                        @if ($errors->has('city'))
                                            <div class="alert alert-danger">
                                                @lang('auth.city.error')
                                            </div>
                                        @endif
                                        <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label>@lang('auth.country.label')</label>
                                                    <select name="country" class="form-control" style="height: 45px;">
                                                        @foreach(\App\Country::all() as $country)
                                                            <option name="country" value="{{$country->id}}" @if(App::isLocale(strtolower($country->code))) selected @endif>{{$country->country}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                    <label>@lang('auth.city.label')</label>
                                                    <div class="form-group input-icon-left {{ $errors->has('city') ? ' has-error' : '' }}">
                                                        <i class="fa fa-map-marker"></i>
                                                        <input type="text" class="form-control" name="city" placeholder="@lang('auth.city.input')"  value="">
                                                    </div>
                                                </div>
                                        </div>
                                    </div>

                                    <label>@lang('auth.email.label')</label>
                                    @if ($errors->has('email'))
                                        <div class="alert alert-danger">
                                            @lang('auth.email.error') <a href="/login">aquí</a>
                                        </div>
                                    @endif
                                    <div class="form-group input-icon-left {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <i class="fa fa-envelope"></i>
                                        <input id="email" type="email" class="form-control" name="email" placeholder="@lang('auth.email.input')"  value="{{ old('email') }}">
                                    </div>

                                    <div class="form-group input-icon-left {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <i class="fa fa-envelope"></i>
                                        <input type="email" class="form-control" name="email_confirmation" placeholder="@lang('auth.email_repeat.input')"  value="">
                                    </div>

                                    <label>@lang('auth.birthday.label')</label>
                                    @if ($errors->has('dia'))
                                        <div class="alert alert-danger">
                                            @lang('auth.birthday.day.error')</a>
                                        </div>
                                    @endif
                                    @if ($errors->has('mes'))
                                        <div class="alert alert-danger">
                                            @lang('auth.birthday.month.error')</a>
                                        </div>
                                    @endif
                                    @if ($errors->has('ano'))
                                        <div class="alert alert-danger">
                                            @lang('auth.birthday.year.error')</a>
                                        </div>
                                    @endif
                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <select name="dia" class="form-control" style="height: 45px;">
                                                    <option name="dia" value="" selected>@lang('auth.day.label')</option>
                                                    @php $dia = 1; @endphp
                                                    @while($dia <= 31)
                                                        <option name="dia" value="{{$dia}}">{{$dia}}</option>
                                                        @php $dia++ @endphp
                                                        @endwhile
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <select name="mes" class="form-control" style="height: 45px;">
                                                    <option name="mes" value="" selected>@lang('auth.month.label')</option>
                                                    <option name="mes" value="01">@lang('dates.date.month1')</option>
                                                    <option name="mes" value="02">@lang('dates.date.month2')</option>
                                                    <option name="mes" value="03">@lang('dates.date.month3')</option>
                                                    <option name="mes" value="04">@lang('dates.date.month4')</option>
                                                    <option name="mes" value="05">@lang('dates.date.month5')</option>
                                                    <option name="mes" value="06">@lang('dates.date.month6')</option>
                                                    <option name="mes" value="07">@lang('dates.date.month7')</option>
                                                    <option name="mes" value="08">@lang('dates.date.month8')</option>
                                                    <option name="mes" value="09">@lang('dates.date.month9')</option>
                                                    <option name="mes" value="10">@lang('dates.date.month10')</option>
                                                    <option name="mes" value="11">@lang('dates.date.month11')</option>
                                                    <option name="mes" value="12">@lang('dates.date.month12')</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <select name="ano" class="form-control" style="height: 45px;">
                                                    <option name="ano" value="" selected>@lang('auth.year.label')</option>
                                                    @php $ano = 2016; $contador = 0; @endphp
                                                    @while($contador <= 115)
                                                        <option name="ano" value="{{$ano}}">{{$ano}}</option>
                                                        @php $contador++; $ano--; @endphp
                                                    @endwhile
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <label>@lang('auth.password.label')</label>
                                    @if ($errors->has('password'))
                                        <div class="alert alert-danger">
                                            @lang('auth.password.error')
                                        </div>
                                    @endif
                                    <div class="form-group input-icon-left {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <i class="fa fa-lock"></i>
                                        <input id="password" type="password" class="form-control" name="password" placeholder="@lang('auth.password.input')">
                                    </div>
                                    <div class="form-group input-icon-left {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <i class="fa fa-check"></i>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="@lang('auth.password_repeat.input')">
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                @if ($errors->has('g-recaptcha-response'))
                                                    <div class="alert alert-danger">
                                                        @lang('auth.g-recaptcha-response.error')</a>
                                                    </div>
                                                @endif
                                                {!! Recaptcha::render() !!}
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <button type="submit" class="btn btn-primary btn-block">@lang('auth.register.button')</button>

                                    <div class="form-actions">
                                        <div class="checkbox checkbox-primary">
                                            <input type="checkbox" id="noticias" checked>
                                            <label for="noticias">@lang('auth.newsletter.checkbox')</label>
                                            <input type="checkbox" name="condiciones" id="condiciones">
                                            <label for="condiciones">@lang('auth.conditions.checkbox')</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="panel-footer">
                            @lang('auth.login.text')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection