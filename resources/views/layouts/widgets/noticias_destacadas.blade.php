@if(\App\ConfigGeneral::first()->noticias_dest == 1)
@php
$destacadas = \App\Articulo::orderBy('id','desc')->take(5)->get();
$contador = 1;
@endphp
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
                    <img src="{{Config::get('constants.S1_URL')}}/noticias_rsz/950x534_{{$noticia_destacada->img}}" alt="">
                    <div class="overlay">
                        <div class="caption">
                            @foreach($noticia_destacada->getCategorias as $categoria)
                                <a href="/categoria/{{$categoria->alias}}"><span class="label" style="background-color: {{$categoria->color}}; margin-left: 5px;">{{$categoria->nombre}}</span></a>
                            @endforeach
                            <div class="post-title">
                                <div class="tipo_destacadas">{{$noticia_destacada->getTipo()}}</div>
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
@endif