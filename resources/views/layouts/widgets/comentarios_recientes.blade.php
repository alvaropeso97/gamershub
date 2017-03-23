<div class="widget widget-list">
    <div class="title">Comentarios recientes</div>
    <?php $comentarios = \App\Comentario::orderBy('id', 'desc')->take(5)->get(); ?>
    <ul>
        @foreach($comentarios as $comentario)
            <?php
            $usuario = $comentario->getAutor;
            $articulo =  $comentario->getArticulo;
            ?>
            <li>
                <a href="usuario" class="thumb"><img src="{{$usuario->img_perfil}}" alt=""></a>
                <div class="widget-list-meta">
                    <h4 class="widget-list-title"><a href="/articulo/{{$articulo->id}}/{{$articulo->lnombre}}#comentarios">{{$articulo->titulo}}</a></h4>
                    <p><i class="fa fa-clock-o"></i> {{$comentario->getFecha()}}</p>
                </div>
            </li>
        @endforeach
    </ul>
</div>