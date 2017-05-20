<div class="widget widget-card">
    <div class="title">Noticias recientes</div>
    @foreach(\App\Models\Articles\Article::where('type', 0)->where('id','!=',$id->id)->orderBy('id', 'desc')->take(3)->get() as $articulo)
        <div class="card">
            <div class="card-img">
                <a href="/articulo/{{$articulo->id}}/{{$articulo->seo_optimized_title}}"><img src="{{Config::get('constants.S1_URL')}}/noticias_rsz/500x281_{{$articulo->image}}" alt=""></a>
                <div class="cats_art_rec">
                    @foreach($articulo->categories as $categoria) <a href="/categoria/{{$categoria->alias}}"><span  class="label" style="background:{{$categoria->color}};">{{$categoria->name}}</span></a> @endforeach</p>
                </div>
            </div>
            <div class="caption">
                <h3 class="card-title"><a href="/articulo/{{$articulo->id}}">{{$articulo->title}}</a></h3>
                <ul>
                    {{$articulo->description}}
                </ul>
            </div>
        </div>
    @endforeach
    <a href="/noticias" class="btn btn-inverse btn-block">Ver todas</a>
</div>