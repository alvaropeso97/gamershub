@php $juego_rel = \App\Http\Controllers\JuegosController::devolverJuego($id->juego_rel); @endphp
<div class="widget widget-game" style="background-image: url('{{Config::get('constants.S1_URL')}}/juegos/img/{{$juego_rel->img_box}}');">
    <div class="overlay">
        <div class="title">{{$juego_rel->titulo}}</div>

        <div class="bold text-uppercase">Plataformas</div>
        @foreach(\App\Http\Controllers\JuegosController::devolverPlataformas($juego_rel->id) as $plataforma) <a href="/plataforma/{{$plataforma->alias}}"><span  class="label" style="background:{{$plataforma->color}};">{{$plataforma->nombre}}</span></a> @endforeach

        <div class="bold text-uppercase margin-top-40">Desarrollador</div>
        <span class="font-size-13">{{$juego_rel->desarrollador}}</span>

        <div class="bold text-uppercase margin-top-35">Fecha de lanzamiento:</div>
        <span class="font-size-13">{{\App\Articulo::devolverFecha($juego_rel->fecha_lanzamiento)}}</span>

        <div class="description">
            {{$juego_rel->descripcion}}
            <a href="/juego/{{$juego_rel->id}}/{{$juego_rel->lnombre}}" class="btn btn-block btn-primary margin-top-40">Ver Ficha</a>
        </div>
    </div>
</div>