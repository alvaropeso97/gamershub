<script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
<div class="card">
    <div class="card-img">
        <a href="/articulo/200/los-10-juegos-mas-esperados-del-2017"><img src="http://img.gamershub.es/noticias/1483031189losmasesperados2017.jpg" alt=""></a>
    </div>
    <div class="caption">
        <h3 class="card-title"><a href="/articulo/200">Los 10 juegos más esperados del 2017</a></h3>
        <ul>
            Repasamos los lanzamientos más esperados del 2017
        </ul>
    </div>
</div>
<div class="card">
    <div class="card-img">
        <a href="/articulo/199/buscamos-redactoresas-y-presentadoresas"><img src="http://img.gamershub.es/noticias/1483019063sebusca.png" alt=""></a>
    </div>
    <div class="caption">
        <h3 class="card-title"><a href="/articulo/199">Buscamos redactores/as y presentadores/as</a></h3>
        <ul>
            ¿Te gustaría trabajar con nosotros?
        </ul>
    </div>
</div>
<script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
<script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
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