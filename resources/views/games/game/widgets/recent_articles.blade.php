@foreach($relatedArticles as $relatedArticle)
    <!-- Artículo -->
    <div class="post post-md">
        <div class="row">
            <div class="col-lg-4">
                <div class="post-thumbnail">
                    <a href="/articulo/{{$relatedArticle->id}}/{{$relatedArticle->seo_optimized_title}}"><img src="" alt=""></a>
                    <div class="meta"><a href="/articulo/{{$relatedArticle->id}}/{{$relatedArticle->seo_optimized_title}}"><i class="fa fa-comments"></i> <span>{{count($relatedArticle->comments)}}</span></a></div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="post-header">
                    <div class="post-title">
                        <div class="tipo">{{$relatedArticle->getType()}}</div>
                        <h4><a href="/articulo/{{$noticia->id}}/{{$noticia->lnombre}}">{{$noticia->titulo}}</a></h4>
                        <ul class="post-meta">
                            <li><a href="/usuario/{{$relatedArticle->user->nickname}}"><i class="fa fa-user"></i> {{$relatedArticle->user->name." ".$relatedArticle->user->surname}}</a></li>
                            <li><i class="fa fa-calendar-o"></i>{{$relatedArticle->getFecha()}}</li>
                            <li>@foreach($relatedArticle->categories as $category) <a href="/categoria/{{$category->alias}}"><span  class="label" style="color:{{$category->color}};">{{$category->name}}</span></a> @endforeach</li>
                        </ul>
                    </div>
                </div>
                <p>{{$noticia->descripcion}}</p>
            </div>
        </div>
    </div>
    <!-- Fin Artículo -->
@endforeach