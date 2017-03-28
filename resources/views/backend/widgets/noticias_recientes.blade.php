<div class="widget widget-nopad">
    <div class="widget-header"> <i class="icon-list-alt"></i>
        <h3> Artículos recientes</h3>
    </div>
    <!-- /widget-header -->
    <div class="widget-content">
        <ul class="news-items">
            @foreach($noticias_recientes as $noticia)
                @php
                    $fecha = strtotime($noticia->fecha);
                @endphp
            <li>

                <div class="news-item-date"> <span class="news-item-day">{{date('d', $fecha)}}</span> <span class="news-item-month">{{date('M', $fecha)}}</span> </div>
                <div class="news-item-detail"> <a href="/articulo/{{$noticia->id}}/{{$noticia->lnombre}}" class="news-item-title" target="_blank">{{$noticia->titulo}}</a>
                    <p class="news-item-preview"> {{$noticia->descripcion}} </p>
                </div>

            </li>
            @endforeach
        </ul>
    </div>
    <!-- /widget-content -->
</div>