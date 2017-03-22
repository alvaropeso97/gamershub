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
            @if(count(\App\Http\Controllers\ArticulosController::devolverArticulosJuego($id->id)) == 0)
                <div class="alert alert-danger">No hay noticias para mostrar</div>
            @endif
            @foreach(\App\Http\Controllers\ArticulosController::devolverArticulosJuego($id->id) as $noticia)
                <li>
                    <div class="widget-list-meta">
                        <h4 class="widget-list-title"><a href="/articulo/{{$noticia->id}}">{{$noticia->titulo}}</a></h4>
                        <p><i class="fa fa-clock-o"></i>{{\App\Articulo::devolverFecha($noticia->fecha)}}</p>
                    </div>
                </li>
            @endforeach
        </ul>
        <ul class="tab-pane fade" id="comentarios">
            @if(count(\App\Http\Controllers\ComentariosController::devolverComentariosJuego($id->id)) == 0)
                <div class="alert alert-danger">No hay comentarios para mostrar</div>
            @endif
            @foreach(\App\Http\Controllers\ComentariosController::devolverComentariosJuego($id->id) as $comentario)
                <li>
                    <div class="widget-list-meta">
                        <h4 class="widget-list-title"><a href="/articulo/{{$comentario->id_articulo}}/#comentarios">{{$comentario->comentario}}</a></h4>
                        <p><i class="fa fa-clock-o"></i>{{\App\Http\Controllers\ComentariosController::obtenerFecha($comentario->created_at)}} por
                            <a href="/usuario/{{\App\Http\Controllers\ComentariosController::devolverUsuario($comentario->id_usuario)->name}}">{{\App\Http\Controllers\ComentariosController::devolverUsuario($comentario->id_usuario)->name}}</a></p>
                    </div>
                </li>
            @endforeach
        </ul>
        <ul class="tab-pane fade" id="foros">
            <div class="alert alert-danger">No hay temas para mostrar</div>
        </ul>
    </div>
</div>