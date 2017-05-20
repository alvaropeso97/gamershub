@php
    $highlighteds = \App\Models\Articles\Article::orderBy('id','desc')->take(5)->get();
    $counter = 1;
@endphp
<div style="border-top: 1px solid white;">
    @foreach($highlighteds as $highlighted_article)
        <section class="no-padding bg-dark">
            @php
                switch ($counter) {
                    case 1:
                        echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding">';
                        break;
                    default:
                       echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 no-padding-left no-padding">';
                    break;
                }
            @endphp
            <div class="post-block first">
                <a href="/articulo/{{$highlighted_article->id}}/{{$highlighted_article->seo_optimized_name}}" class="link">
                    <img src="{{$highlighted_article->getImageUrl('md')}}" alt="">
                    <div class="overlay">
                        <div class="caption">
                            @foreach($highlighted_article->categories as $category)
                                <a href="/categoria/{{$category->alias}}"><span class="label" style="background-color: {{$category->color}}; margin-left: 5px;">{{$category->name}}</span></a>
                            @endforeach
                            <div class="post-title">
                                <div class="tipo_destacadas">{{$highlighted_article->getType()}}</div>
                                <h4><a style="color: white;" href="/articulo/{{$highlighted_article->id}}/{{$highlighted_article->seo_optimized_name}}">{{$highlighted_article->title}}</a></h4></div>
                            <p>{{$highlighted_article->description}}</p>
                        </div>
                    </div>
                </a>
            </div>
            </div>
            <?php $counter++ ?>
            @endforeach
        </section>
</div>