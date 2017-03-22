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
                    </div><!-- Fin Sidebar -->


                </div>
            </div>
        </section><!-- Fin Últimas noticias -->
    @endsection