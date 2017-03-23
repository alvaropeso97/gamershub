<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 leftside">
@php $cons =  \App\Articulo::select()->orderBy('id','desc')->paginate(10); @endphp
@foreach($cons as $noticia)
    @php $autor = $noticia->getAutor; @endphp
    <!-- Artículo -->
        <div class="post post-md">
            <div class="row">
                <div class="col-lg-4">
                    <div class="post-thumbnail">
                        <a href="/articulo/{{$noticia->id}}/{{$noticia->lnombre}}"><img src="{{Config::get('constants.S1_URL')}}/noticias/{{$noticia->img}}" alt=""></a>
                        <div class="meta"><a href="/articulo/{{$noticia->id}}/{{$noticia->lnombre}}"><i class="fa fa-comments"></i> <span>{{count($noticia->getComentarios)}}</span></a></div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="post-header">
                        @if($noticia->tipo == "ana")
                            @php $nota = \App\Http\Controllers\AnalisisController::devolverNota($noticia->id) @endphp
                            <span class="nota_analisis {{\App\Http\Controllers\AnalisisController::devolverColor($nota)}}">{{$nota}}</span>
                        @endif
                        <div class="post-title">
                            <div class="tipo">{{\App\Http\Controllers\ArticulosController::devolverTipo($noticia->tipo)}}</div>
                            <h4><a href="/articulo/{{$noticia->id}}/{{$noticia->lnombre}}">{{$noticia->titulo}}</a></h4>
                            <ul class="post-meta">
                                <li><a href="/usuario/{{$autor->name}}"><i class="fa fa-user"></i> {{$autor->nombre}} {{$autor->apellidos}}</a></li>
                                <li><i class="fa fa-clock-o"></i>{{$noticia->getFecha()}}</li>
                                <li>@foreach($noticia->getCategorias as $categoria) <a href="/categoria/{{$categoria->alias}}"><span  class="label" style="color:{{$categoria->color}};">{{$categoria->nombre}}</span></a> @endforeach</li>
                            </ul>
                        </div>
                    </div>
                    <p>{{$noticia->descripcion}}</p>
                </div>
            </div>
        </div>
        <!-- Fin Artículo -->
    @endforeach
</div>