<?php
$destacadas = DB::select("select * from articulos ORDER BY id DESC LIMIT 5");
$contador = 1;
?>
<div style="border-top: 1px solid white;">
    @foreach($destacadas as $noticia_destacada)
        <section class="no-padding bg-dark">
            @php
                switch ($contador) {
                    case 1:
                        echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding">';
                        break;
                    default:
                       echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 no-padding-left no-padding">';
                    break;
                }
            @endphp
            <div class="post-block first">
                <a href="/articulo/{{$noticia_destacada->id}}/{{$noticia_destacada->lnombre}}" class="link">
                    <img src="{{Config::get('constants.S1_URL')}}/noticias/{{$noticia_destacada->img}}" alt="">
                    <div class="overlay">
                        <div class="caption">
                            <?php $etiquetas = DB::select("select * from categorias where id in (select id_cat from categorias_articulos where cod_art=".$noticia_destacada->id.")"); ?>
                            @foreach($etiquetas as $etiqueta)
                                <a href="/categoria/{{$etiqueta->alias}}"><span class="label" style="background-color: {{$etiqueta->color}}; margin-left: 5px;">{{$etiqueta->nombre}}</span></a>
                            @endforeach
                            <div class="post-title">
                                <div class="tipo_destacadas">{{\App\Http\Controllers\ArticulosController::devolverTipo($noticia_destacada->tipo)}}</div>
                                <h4><a style="color: white;" href="/articulo/{{$noticia_destacada->id}}/{{$noticia_destacada->lnombre}}">{{$noticia_destacada->titulo}}</a></h4></div>
                            <p>{{$noticia_destacada->descripcion}}</p>
                        </div>
                    </div>
                </a>
            </div>
            </div>
            <?php $contador++ ?>
            @endforeach
        </section>
</div>