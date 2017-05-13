<div class="widget widget-game" style="background-image: url('{{Config::get('constants.S1_URL')}}/juegos/img/{{$id->img_box}}');">
    <div class="overlay">
        <div class="title">{{$id->titulo}}</div>
        <div class="bold text-uppercase">Plataformas</div>
        @foreach(\App\Http\Controllers\GamesController::devolverPlataformas($id->id) as $plataforma) <a href="/plataforma/{{$plataforma->alias}}"><span  class="label" style="background:{{$plataforma->color}};">{{$plataforma->nombre}}</span></a> @endforeach

        <div class="bold text-uppercase margin-top-40">Desarrollador</div>
        <span class="font-size-13">{{$id->desarrollador}}</span>

        <div class="bold text-uppercase margin-top-35">Fecha de lanzamiento:</div>
        <span class="font-size-13">{{\App\Http\Controllers\ArticlesController::traducirFecha($id->fecha_lanzamiento)}}</span>

        <div class="description">
            {{$id->descripcion}}
        </div>
    </div>
</div>