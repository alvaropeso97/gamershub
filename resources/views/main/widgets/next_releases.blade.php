@php $counter = 1; @endphp
<div class="widget widget-games">
    <div class="title">@lang('general.next_releases.title')</div>
    <ul>
        @foreach(\App\Http\Controllers\GamesController::devolverProximosLanzamientos() as $game)
            <li style="background-image: url('{{Config::get('constants.S1_URL')}}/juegos/cabeceras/{{$game->header_image}}');">
                <a href="/juego/{{$game->id}}" class="overlay">
                    <span class="number">{{$counter}}</span>
                    <div class="game-meta">
                        <h4 class="game-title">{{$game->title}}</h4>
                        <span>{{\App\Http\Controllers\ArticlesController::traducirFecha($game->release_date)}}</span>
                    </div>
                </a>
            </li>
            <?php $counter++ ?>
        @endforeach
    </ul>
</div>