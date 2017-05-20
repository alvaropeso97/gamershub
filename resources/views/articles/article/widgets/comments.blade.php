<a name="comentarios"></a>
<div class="comments">
    <h4 class="page-header"><i class="fa fa-comment-o"></i> Comentarios ({{count($id->comments)}})</h4>
    @foreach($id->comments as $comentario)
        @php $usuario = $comentario->user; @endphp

        <div class="media">
            <a class="media-left" href="/usuario/{{$usuario->name}}">
                <img src="{{$usuario->avatar}}" alt="">
            </a>
            <div class="media-body">
                <div class="media-content">
                    <a href="/usuario/{{$usuario->name}}" class="media-heading">{{$usuario->name}}</a>
                    <span class="date">{{$comentario->getFecha()}}</span>
                    <p>{{$comentario->comment}}</p>
                    @if(Auth::check() && Auth::user()->acceso > 2)
                        <h6 class="text-right"><a href="{{$comentario->id}}/eliminar">Eliminar</a></h6>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    @if(!Auth::user())
        <div class="form-group">
            <textarea id="comentario" name="comentario" data-toggle="modal" data-target=".no-registrado" readonly class="form-control bg-white" rows="6" placeholder="Envía un comentario..." required></textarea>
        </div>
        <button type="submit" data-toggle="modal" data-target=".no-registrado" class="btn btn-primary btn-rounded btn-shadow pull-right">Enviar comentario</button>
        <!-- AVISO MODAL / NO REGISTRADO -->
        <div class="modal fade no-registrado" tabindex="-1" role="dialog" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Aviso</h4>
                    </div>
                    <div class="modal-body">
                        Para poder realizar esta acción es necesario estar registrado.<br>
                        Si ya tienes una cuenta <b><a href="/login">inicia sesión</a></b>.<br>
                        Si todavía no estás registrado <b><a href="/register">crea una nueva cuenta</a></b>.
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="window.location.href='/login'" class="btn btn-success">Iniciar sesión</button>
                        <button type="button" onclick="window.location.href='/register'" class="btn btn-warning">Crear una cuenta</button>
                        <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN AVISO MODAL / NO REGISTRADO-->
    @else
        @if ($errors->has('comentario'))
            <div class="alert alert-danger">
                El contenido del comentario es demasiado corto (Mínimo 25 caracteres)</a>
            </div>
        @endif
        <form name="comentarios" method="post" action="/articulo/{{$id->id}}/add-comentario">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="hidden" name="id_usuario" value="{{Auth::user()->id}}">
                <input type="hidden" name="id_articulo" value="{{$id->id}}">
                <textarea id="comentario" name="comentario" class="form-control bg-white" rows="6" placeholder="Envía un comentario..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-rounded btn-shadow pull-right">Enviar comentario</button>
        </form>
    @endif
</div>