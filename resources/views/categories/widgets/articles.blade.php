<div class="container">
    @php $counter = 1; @endphp
    @foreach($cons as $article)
        @if($counter == 1 || $counter == 4 || $counter == 7)
            <div class="row">
                @endif
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-img">
                            <a href="/articulo/{{$article->id}}/{{$article->seo_optimized_title}}"><img style="border-radius: 10px 10px 0px 0px;-webkit-border-radius: 10px 10px 0px 0px;" src="{{$article->getImageUrl('sm')}}" alt=""></a>
                            <div class="category">@foreach($article->categories as $category) <a href="/categoria/{{$category->alias}}"><span  class="label" style="background:{{$category->color}};">{{$category->name}}</span></a> @endforeach</div>

                            <div class="meta"><a href="/articulo/{{$article->id}}/{{$article->seo_optimized_title}}"></a></div>
                        </div>
                        <div class="caption" style="border-radius: 0px 0px 10px 10px;-webkit-border-radius: 0px 0px 10px 10px;">
                            @if($article->tipo == \App\Models\Articles\Article::TYPE_REVIEW)
                                @php $nota = $article->review->getNotaMostrar() @endphp
                                <span class="nota_analisis {{$article->review->getColor()}}">{{$nota}}</span>
                            @endif
                            <div class="tipo">{{$article->getType()}}</div>
                            <h3 class="card-title"><a href="/articulo/{{$article->id}}/{{$article->seo_optimized_title}}">{{$article->title}}</a></h3>
                            <ul><li>{{$article->description}}</li></ul>
                        </div>
                    </div>
                </div>
                @if($counter == 3 || $counter == 6 || $counter == 9)
            </div>
        @endif
        @php $counter++; @endphp
    @endforeach
    <div class="row">
        <div class="col-lg-12 text-center">

        </div>
    </div>
</div>
