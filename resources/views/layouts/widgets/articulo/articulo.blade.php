<div class="post post-single">
    @if(Auth::check() && Auth::user()->acceso > 1)
        <div style="text-align: right"><a href="http://beta.gamershub.es/panel/articulos/editar-articulo/{{$id->id}}">Editar</a></div>
    @endif

    <?php echo $id->cont;?>

    <div class="row margin-top-40">
        <div class="col-md-8">
            <div class="tags">
                @foreach(\App\Http\Controllers\ArticulosController::devolverEtiquetas($id->id) as $etiqueta)
                    <a href="/busqueda/etiquetas/{{$etiqueta->nombre}}">{{$etiqueta->nombre}}</a>
                @endforeach
            </div>
        </div>
        <div class="col-md-4 hidden-xs hidden-sm">
            <ul class="share">
                <li><a onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=gamershub.es/articulo/{{$id->id}}/{{$id->lnombre}}','name','width=600,height=400')" class="btn btn-sm btn-social-icon btn-facebook" data-toggle="tooltip" title="Compartir en Facebook"><i class="fa fa-facebook"></i></a></li>
                <li><a onclick="window.open('https://twitter.com/home?status=gamershub.es/articulo/{{$id->id}}/{{$id->lnombre}}','name','width=600,height=400')" class="btn btn-sm btn-social-icon btn-twitter" data-toggle="tooltip" title="Compartir en Twitter"><i class="fa fa-twitter"></i></a></li>
                <li><a onclick="window.open('https://plus.google.com/share?url=gamershub.es/articulo/{{$id->id}}/{{$id->lnombre}}','name','width=600,height=400')" class="btn btn-sm btn-social-icon btn-google-plus" data-toggle="tooltip" title="Compartir en Google+"><i class="fa fa-google-plus"></i></a></li>
            </ul>
        </div>
    </div>
</div>