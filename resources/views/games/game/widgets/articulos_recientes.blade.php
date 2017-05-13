<?php
$cons =  \App\Article::orderBy('id','desc')->where('juego_rel',$id->id)->paginate(10);
?>
@foreach($cons as $noticia)
    @php $autor = DB::table('users')->where('id', $noticia->id_autor)->first(); @endphp
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
                        @php $nota = $noticia->getAnalisis->getNotaMostrar() @endphp
                        <span class="nota_analisis {{$noticia->getAnalisis->getColor()}}">{{$nota}}</span>
                    @endif
                    <div class="post-title">
                        <div class="tipo">{{$noticia->getTipo()}}</div>
                        <h4><a href="/articulo/{{$noticia->id}}/{{$noticia->lnombre}}">{{$noticia->titulo}}</a></h4>
                        <ul class="post-meta">
                            <li><a href="/usuario/{{$autor->name}}"><i class="fa fa-user"></i> {{$autor->name}}</a></li>
                            <li><i class="fa fa-calendar-o"></i>{{\App\Article::devolverFecha($noticia->fecha)}}</li>
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