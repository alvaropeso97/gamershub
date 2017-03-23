<section class="bg-grey-50 border-bottom-1 border-grey-200 padding-top-25 padding-bottom-5">
    <div class="container">
        <div class="row">
            <div class="title">
                <h4><i class="fa fa-film"></i> Últimos Videos</h4>
            </div>
            <!-- Inicio Video -->
            <div class="row">
                @foreach(\App\Articulo::where('tipo', 'vid')->orderBy('id', 'desc')->take(4)->get() as $video)
                    @php $vid = $video->getVideo @endphp
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card card-video">
                            <div class="card-img">
                                <a href="/articulo/{{$video->id}}/{{$video->lnombre}}"><img src="{{Config::get('constants.S1_URL')}}/noticias/{{$video->img}}" alt=""></a>
                                <div class="time">{{$vid->dur}}</div>
                            </div>
                            <div class="caption">
                                <h3 class="card-title"><a href="/articulo/{{$video->id}}/{{$video->lnombre}}">{{$video->titulo}}</a></h3>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i> {{\App\Articulo::devolverFecha($video->fecha)}}</li>
                                    <li><i class="fa fa-eye"></i> {{$vid->visitas}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
            @endforeach
            <!-- Fin Video -->
            </div>
        </div>
    </div>
</section>