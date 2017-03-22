<div class="widget widget-card">
    <div class="title">Vídeos Relacionados</div>
    <?php $videos = DB::select("select * from articulos where juego_rel=".$id->id." and tipo='vid'"); ?>
    @foreach($videos as $video)
        <div class="card">
            <div class="card-img">
                <a href="/articulo/{{$video->id}}"><img src="{{Config::get('constants.S1_URL')}}/noticias/{{$video->img}}" alt=""></a>
                <div class="time">04:51</div>
            </div>
            <div class="caption">
                <h3 class="card-title"><a href="/articulo/{{$video->id}}">{{$video->titulo}}</a></h3>
                <ul>
                    <li><i class="fa fa-calendar-o"></i> {{\App\Articulo::devolverFecha($video->fecha)}}</li>
                    <li><i class="fa fa-eye"></i> 0 visualizaciones</li>
                </ul>
            </div>
        </div>
    @endforeach
    <a href="#" class="btn btn-inverse btn-block">Más Vídeos</a>
</div>