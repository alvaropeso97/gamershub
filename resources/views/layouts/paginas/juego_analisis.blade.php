@extends('layouts.master')
@section('titulo', $id->titulo.' - Análisis')

@section('contenido')
    <section class="hero height-350 hero-game" style="background-image: url('{{Config::get('constants.S1_URL')}}/juegos/cabeceras/{{$id->img_header}}');">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="page-header">
                <div class="page-title">{{$id->titulo}}</div>
                <ol class="breadcrumb">
                    <li><a href="#" class="no-padding-left">Inicio</a></li>
                    <li><a href="#">Juegos</a></li>
                    <li><a href="/juego/{{$id->id}}/{{$id->lnombre}}">{{$id->titulo}}</a></li>
                    <li class="active">Análisis</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="bg-white no-padding hidden-xs border-bottom-1 border-grey-300" style="height: 54px">
        <div class="tab-select text-center sticky">
            <div class="container">
                <ul class="nav nav-tabs">
                    <li><a href="/juego/{{$id->id}}/{{$id->lnombre}}">{{$id->titulo}}</a></li>
                    <li class="active"><a><i class="fa fa-star"></i> Análisis</a></li>
                    <li><a href="/juego/{{$id->id}}/{{$id->lnombre}}/noticias"><i class="fa fa-pencil"></i> Noticias</a></li>
                    <li><a href="#"><i class="fa fa-image"></i> Imágenes</a></li>
                    <li><a href="#"><i class="fa fa-video-camera"></i> Vídeos</a></li>
                    <li><a href="#"><i class="fa fa-quote-left"></i> Foro del juego</a></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="bg-grey-50 padding-top-30">
        <div class="container">
            <div class="row">

                <div class="post-header">
                    <div class="post-title">
                        <h2>{{$articulo->descripcion}}</h2>
                    </div>
                </div>

                <div class="lead margin-top-20">
                    @php echo $articulo->cont; @endphp
                </div>

            </div>
        </div>
    </section>
    <!-- ANÁLISIS -->
    <div class="widget widget-game margin-top-30" style="background-image: url('{{Config::get('constants.S1_URL')}}/juegos/img/{{$id->img_box}}');">
        <div class="overlay">
            <div class="container">
            <div class="analisis_titulo text-center">VEREDICTO</div>

            <div class="chart-align nota_juego_analisis">
                    {{\App\Http\Controllers\AnalisisController::devolverNota($articulo->id)}}
            </div>

            <p class="progress-label">Jugabilidad <span>{{$analisis->jugabilidad}}%</span></p>
            <div class="progress progress-animation progress-xs">
                <div class="progress-bar progress-bar-success" aria-valuenow="{{$analisis->jugabilidad}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$analisis->jugabilidad}}%;"></div>
            </div>

            <p class="progress-label">Gráficos <span>{{$analisis->graficos}}%</span></p>
            <div class="progress progress-animation progress-xs">
                <div class="progress-bar progress-bar-danger" aria-valuenow="{{$analisis->graficos}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$analisis->graficos}}%;"></div>
            </div>

            <p class="progress-label">Sonidos <span>{{$analisis->sonidos}}%</span></p>
            <div class="progress progress-animation progress-xs">
                <div class="progress-bar progress-bar-warning" aria-valuenow="{{$analisis->sonidos}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$analisis->sonidos}}%;"></div>
            </div>

            <p class="progress-label">Innovación <span>{{$analisis->innovacion}}%</span></p>
            <div class="progress progress-animation progress-xs no-margin-bottom">
                <div class="progress-bar progress-bar-info" aria-valuenow="{{$analisis->innovacion}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$analisis->innovacion}}%;"></div>
            </div>

            <div class="bold text-uppercase margin-top-40">
                <i class="fa fa-clock-o"></i>&nbsp;&nbsp;<b>Duración:</b> {{$id->duracion}}<br><br>
                <i class="fa fa-user"></i>&nbsp;&nbsp;<b>Jugadores:</b> {{$id->jugadores}}<br><br>
                <i class="fa fa-language"></i>&nbsp;&nbsp;<b>Idioma:</b> {{$id->idioma}}
            </div>


            <div class="description">
                {{$id->descripcion}}
            </div>
        </div>
        </div>
    </div>
    <!-- FIN ANÁLISIS -->
@endsection