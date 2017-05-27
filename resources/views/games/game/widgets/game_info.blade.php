<div class="widget widget-game" style="background-image: url('');">
    <div class="overlay">
        <div class="title">{{$id->title}}</div>
        <div class="bold text-uppercase">Plataformas</div>
        @foreach($id->categories as $category) <a href="/plataforma/{{$category->alias}}"><span  class="label" style="background:{{$category->color}};">{{$category->name}}</span></a> @endforeach

        <div class="bold text-uppercase margin-top-40">Desarrollador</div>
        <span class="font-size-13">TODO</span>

        <div class="bold text-uppercase margin-top-35">Fecha de lanzamiento:</div>
        <span class="font-size-13">{{$id->release_date}}</span>

        <div class="description">
            {!! $id->description !!}
        </div>
    </div>
</div>