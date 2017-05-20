<section class="bg-grey-50 border-bottom-1 border-grey-200 padding-top-25 padding-bottom-5">
    <div class="container">
        <div class="row">
            <div class="title">
                <h4><i class="fa fa-film"></i>@lang('general.latests_videos.title')</h4>
            </div>
            <!-- Inicio Video -->
            <div class="row">
                @foreach(\App\Models\Articles\Article::where('type', '2')->orderBy('id', 'desc')->take(4)->get() as $article)
                    @php $video = $article->video @endphp
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card card-video">
                            <div class="card-img">
                                <a href="/articulo/{{$article->id}}/{{$article->seo_optimized_name}}"><img src="{{Config::get('constants.S1_URL')}}/noticias_rsz/500x281_{{$article->image}}" alt=""></a>
                                <div class="time">{{$video->duration}}</div>
                            </div>
                            <div class="caption">
                                <h3 class="card-title"><a href="/articulo/{{$video->id}}/{{$article->seo_optimized_name}}">{{$article->title}}</a></h3>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i> {{\App\Models\Articles\Article::devolverFecha($article->created_at)}}</li>
                                    <li><i class="fa fa-eye"></i> {{$video->views_count}}</li>
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