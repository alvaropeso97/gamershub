<div class="widget widget-card">
    <div class="title">Noticias recientes</div>
    @foreach(\App\Http\Controllers\ArticulosController::devolverNoticiasRecientes($id->id) as $articulo)
        <div class="card">
            <div class="card-img">
                <a href="/articulo/{{$articulo->id}}/{{$articulo->lnombre}}"><img src="{{Config::get('constants.S1_URL')}}/noticias/{{$articulo->img}}" alt=""></a>
                <div class="cats_art_rec">
                    @foreach(\App\Http\Controllers\CategoriasController::devolverCategorias($articulo->id) as $categoria) <a href="/categoria/{{$categoria->alias}}"><span  class="label" style="background:{{$categoria->color}};">{{$categoria->nombre}}</span></a> @endforeach</p>
                </div>
            </div>
            <div class="caption">
                <h3 class="card-title"><a href="/articulo/{{$articulo->id}}">{{$articulo->titulo}}</a></h3>
                <ul>
                    {{$articulo->descripcion}}
                </ul>
            </div>
        </div>
    @endforeach
    <a href="/noticias" class="btn btn-inverse btn-block">Ver todas</a>
</div>