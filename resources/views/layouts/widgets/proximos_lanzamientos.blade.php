@php $contador = 1; @endphp
<div class="widget widget-games">
    <div class="title">Próximos Lanzamientos</div>
    <ul>
        @foreach(\App\Http\Controllers\JuegosController::devolverProximosLanzamientos() as $juego)
            <li style="background-image: url('{{Config::get('constants.S1_URL')}}/juegos/cabeceras/{{$juego->img_header}}');">
                <a href="/juego/{{$juego->id}}" class="overlay">
                    <span class="number">{{$contador}}</span>
                    <div class="game-meta">
                        <h4 class="game-title">{{$juego->titulo}}</h4>
                        <span>{{\App\Http\Controllers\ArticulosController::traducirFecha($juego->fecha_lanzamiento)}}</span>
                    </div>
                </a>
            </li>
            <?php $contador++ ?>
        @endforeach
    </ul>
</div>