@extends('master')
@section('titulo', 'GamersHUB - Actualidad y novedades de videojuegos, comunidad gamer, servicios para jugadores')
@section('contenido')
    <!-- Noticias destacadas -->
    @include('main.widgets.highlighted_articles')
    <!-- Fin noticias destacadas -->
    <!-- Últimos Vídeos -->
    @include('main.widgets.latests_videos')
    <!-- Fin Últimos Vídeos -->

    <!-- Últimas noticias -->
        <section>
            <div class="container">
                <div class="row sidebar">
                    <!-- Noticias -->
                    @include('main.widgets.articles')
                    <!-- Sidebar -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 rightside">
                        <!-- Próximos lanzamientos -->
                        @include('main.widgets.next_releases')

                        <!-- Comentarios recientes -->
                        @include('main.widgets.recent_comments')
                    </div><!-- Fin Sidebar -->


                </div>
            </div>
        </section><!-- Fin Últimas noticias -->
    @endsection