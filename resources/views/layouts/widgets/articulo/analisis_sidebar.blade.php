@php
    $juego_rel = \App\Http\Controllers\JuegosController::devolverJuego($id->juego_rel);
    $analisis = \App\Http\Controllers\AnalisisController::devolverAnalisis($juego_rel->id);
@endphp
<div class="widget widget-game" style="background-image: url('{{Config::get('constants.S1_URL')}}/juegos/img/{{$juego_rel->img_box}}');">
    <div class="overlay">
        <div class="title">{{$juego_rel->titulo}}</div>

        <div class="chart-align">
            <span class="chart" data-percent="{{\App\Http\Controllers\AnalisisController::devolverTotal($juego_rel->id)}}"><span class="percent">{{\App\Http\Controllers\AnalisisController::devolverTotal($juego_rel->id)}}</span><canvas height="110" width="110"></canvas></span>
        </div>

        <p class="progress-label">Jugabilidad <span>{{$analisis->jugabilidad}}%</span></p>
        <div class="progress progress-animation progress-xs">
            <div class="progress-bar progress-bar-success" aria-valuenow="{{$analisis->jugabilidad}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$analisis->jugabilidad}}%;"></div>
        </div>

        <p class="progress-label">Gráficos <span>{{$analisis->graficos}}%</span></p>
        <div class="progress progress-animation progress-xs">
            <div class="progress-bar progress-bar-danger" aria-valuenow="{{$analisis->graficos}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$analisis->graficos}}%;"></div>
        </div>

        <p class="progress-label">Sonidos <span>{{$analisis->sonidos}}%</span></p>
        <div class="progress progress-animation progress-xs">
            <div class="progress-bar progress-bar-warning" aria-valuenow="{{$analisis->sonidos}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$analisis->sonidos}}%;"></div>
        </div>

        <p class="progress-label">Innovación <span>{{$analisis->innovacion}}%</span></p>
        <div class="progress progress-animation progress-xs no-margin-bottom">
            <div class="progress-bar progress-bar-info" aria-valuenow="{{$analisis->innovacion}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$analisis->innovacion}}%;"></div>
        </div>

        <div class="bold text-uppercase margin-top-40">
            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<b>Duración:</b> {{$juego_rel->duracion}}<br><br>
            <i class="fa fa-user"></i>&nbsp;&nbsp;<b>Jugadores:</b> {{$juego_rel->jugadores}}<br><br>
            <i class="fa fa-language"></i>&nbsp;&nbsp;<b>Idioma:</b> {{$juego_rel->idioma}}
        </div>


        <div class="description">
            {{$juego_rel->descripcion}}
            <a href="/juego/{{$juego_rel->id}}/{{$juego_rel->lnombre}}" class="btn btn-block btn-primary margin-top-40">Ver ficha</a>
        </div>
    </div>
</div>