<div class="widget widget-list">
    <div class="tab-select border-bottom-1 border-grey-300">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#noticias" data-toggle="tab">Noticias</a></li>
            <li><a href="#comentarios" data-toggle="tab">Comentarios</a></li>
            <li><a href="#foros" data-toggle="tab">Foros</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <ul class="tab-pane fade in active" id="noticias">
            @if(count($id->getArticulos) == 0)
                <div class="alert alert-danger">No hay noticias para mostrar</div>
            @endif
            @foreach($id->getArticulos as $noticia)
                <li>
                    <div class="widget-list-meta">
                        <h4 class="widget-list-title"><a href="/articulo/{{$noticia->id}}">{{$noticia->titulo}}</a></h4>
                        <p><i class="fa fa-clock-o"></i>{{$noticia->getFechaLocal()}}</p>
                    </div>
                </li>
            @endforeach
        </ul>
        <ul class="tab-pane fade" id="comentarios">
            @if(count(\App\Http\Controllers\CommentsController::devolverComentariosJuego($id->id)) == 0)
                <div class="alert alert-danger">No hay comentarios para mostrar</div>
            @endif
            @foreach(\App\Http\Controllers\CommentsController::devolverComentariosJuego($id->id) as $comentario)
                @php $autor = $comentario->getAutor @endphp
                <li>
                    <div class="widget-list-meta">
                        <h4 class="widget-list-title"><a href="/articulo/{{$comentario->id_articulo}}/#comentarios">{{$comentario->comentario}}</a></h4>
                        <p><i class="fa fa-clock-o"></i>{{$comentario->getFecha}} por
                            <a href="/usuario/{{$autor->name}}">{{$autor->name}}</a></p>
                    </div>
                </li>
            @endforeach
        </ul>
        <ul class="tab-pane fade" id="foros">
            <div class="alert alert-danger">No hay temas para mostrar</div>
        </ul>
    </div>
</div>