<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 leftside">
@php $articles =  \App\Article::select()->orderBy('id','desc')->paginate(10); @endphp
@foreach($articles as $article)
    @php $user = $article->user; @endphp
    <!-- Artículo -->
        <div class="post post-md">
            <div class="row">
                <div class="col-lg-4">
                    <div class="post-thumbnail">
                        <a href="/articulo/{{$article->id}}/{{$article->seo_optimized_name}}"><img src="{{Config::get('constants.S1_URL')}}/noticias_rsz/500x281_{{$article->image}}" alt=""></a>
                        <div class="meta"><a href="/articulo/{{$article->id}}/{{$article->seo_optimized_name}}"><i class="fa fa-comments"></i> <span>{{count($article->comments)}}</span></a></div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="post-header">
                        @if($article->type == "3")
                            @php $score = $article->review->getNotaMostrar() @endphp
                            <span class="nota_analisis {{$article->review->getColor()}}">{{$score}}</span>
                        @endif
                        <div class="post-title">
                            <div class="tipo">{{$article->getTipo()}}</div>
                            <h4><a href="/articulo/{{$article->id}}/{{$article->seo_optimized_name}}">{{$article->title}}</a></h4>
                            <ul class="post-meta">
                                <li><a href="/usuario/{{$user->nickname}}"><i class="fa fa-user"></i> {{$user->name}} {{$user->surname}}</a></li>
                                <li><i class="fa fa-clock-o"></i>{{$noticia->getFecha()}}</li>
                                <li>@foreach($article->categories as $category) <a href="/categoria/{{$category->alias}}"><span  class="label" style="color:{{$category->color}};">{{$category->name}}</span></a> @endforeach</li>
                            </ul>
                        </div>
                    </div>
                    <p>{{$article->description}}</p>
                </div>
            </div>
        </div>
        <!-- Fin Artículo -->
    @endforeach
    {{$articles->render()}}
</div>