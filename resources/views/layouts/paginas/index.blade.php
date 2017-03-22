@extends('layouts.master')
@section('titulo', 'GamersHUB - Actualidad y novedades de videojuegos, comunidad gamer, servicios para jugadores...')

@section('contenido')
    <!-- Noticias destacadas -->
    @include('layouts.widgets.noticias_destacadas')
    <!-- Fin noticias destacadas -->
    <!-- Últimos Vídeos -->
    @include('layouts.widgets.ultimos_videos')
    <!-- Fin Últimos Vídeos -->

    <!-- Últimas noticias -->
        <section>
            <div class="container">
                <!-- <center><img src="img/weblogo_2017.png" class="img-responsive" style="margin-bottom: 70px" alt="FELIZ2017"></center> -->
                <div class="row sidebar">
                    <!-- Noticias -->
                    @include('layouts.widgets.noticias')
                    <!-- Sidebar -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 rightside">
                        <!-- Próximos lanzamientos -->
                        @include('layouts.widgets.proximos_lanzamientos')

                        <!-- Comentarios recientes -->
                        @include('layouts.widgets.comentarios_recientes')
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- Principal -->
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:270px;height:270px"
                             data-ad-client="ca-pub-6228540434295821"
                             data-ad-slot="7686710196"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div><!-- Fin Sidebar -->


                </div>
            </div>
        </section><!-- Fin Últimas noticias -->


    @endsection