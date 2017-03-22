<div class="widget widget-list">
    <div class="title">Comentarios recientes</div>
    <?php $comentarios = DB::select("select * from comentarios order by id desc LIMIT 5"); ?>
    <ul>
        @foreach($comentarios as $comentario)
            <?php $usuario = DB::table('users')->where('id', $comentario->id_usuario)->first();
            $articulo =  DB::table('articulos')->where('id', $comentario->id_articulo)->first();
            ?>
            <li>
                <a href="usuario" class="thumb"><img src="{{$usuario->img_perfil}}" alt=""></a>
                <div class="widget-list-meta">
                    <h4 class="widget-list-title"><a href="/articulo/{{$articulo->id}}/{{$articulo->lnombre}}#comentarios">{{$articulo->titulo}}</a></h4>
                    <p><i class="fa fa-clock-o"></i> {{\App\Http\Controllers\ComentariosController::obtenerFecha($comentario->created_at)}}</p>
                </div>
            </li>
        @endforeach
    </ul>
</div>