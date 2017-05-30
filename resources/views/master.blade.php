<!DOCTYPE html>
<html lang="es">
<head>
    <!--
     *  ____  _             _     _ _
     * |  _ \| | __ _ _   _| |__ (_) |_   ___  ___
     * | |_) | |/ _` | | | | '_ \| | __| / _ \/ __|
     * |  __/| | (_| | |_| | |_) | | |_ |  __/\__ \
     * |_|   |_|\__,_|\__, |_.__/|_|\__(_)___||___/
     *                |___/
     *
     * TODOS LOS DERECHOS RESERVADOS ÁLVARO PESO GARCÍA
     * WWW.PLAYBIT.ES
     * CONTACTO@PLAYBIT.ES
     * @PlaybitES
     * 2017
    -->
    <!-- META -->
    <meta charset="utf-8">
    <meta http-equiv='Content-Type' content='text/html; charset=windows-1252' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Comunidad hispanohablante de videojuegos. Noticias, análisis, avances, vídeos...">
    <meta name='keywords' content='videojuegos, juegos, noticias, analisis, avances, videos, trailers, lanzamientos, trucos, guias, pc, ps4, ps3, xbox 360, 3ds, wii, wiiU, xbox one' />
    <meta name="author" content="LynoStudios">
    <meta name='robots' content='NOODP' />
    @yield('meta')

    <title>@yield('titulo')</title>
    <title>@yield('titulo-inicio')</title>

    <!-- FAVICON -->
    <link rel="shortcut icon" href="{{ URL::asset('img/logo_new/favicon.gif') }}">

    <!-- CSS -->
    <link href="{{ URL::asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/helpers.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/theme.min.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700' rel='stylesheet' type='text/css'>
    @yield('css')

    <!-- SCRIPTS -->
    <script src="{{ URL::asset('plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="https://content.jwplatform.com/libraries/ddLXtOfh.js"></script>
    <script>
        tinymce.init({
            language : "es",
            selector:'#area_texto'
        });
    </script>

    <!-- SEGUIMIENTO PARA GOOGLE ANALYTICS -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-85725549-1', 'auto');
        ga('send', 'pageview');
    </script>

    <!-- PUBLICIDAD DE GOOGLE -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-2885854253727480",
            enable_page_level_ads: true
        });
    </script>
</head>

<body class="fixed-header">
@include('modules.header')
<!-- /cabecera -->

<div class="modal-search">
    <div class="container">
        <input type="text" class="form-control" placeholder="Type to search...">
        <i class="fa fa-times close"></i>
    </div>
</div><!-- /.busqueda -->
<main>
    <!-- contenido -->
    <div id="wrapper">
        @yield('contenido')
    </div>
    <!-- /contenido -->

    <!-- pie de página -->
    @include('modules.footer')
    <!-- /.pie de página -->
</main>
<!-- Javascript -->
<script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('plugins/core.min.js') }}"></script>
<script src="{{ URL::asset('plugins/gamershub.js') }}"></script>
<script src="{{ URL::asset('js/playbit.js') }}"></script>
<script src="{{ URL::asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ URL::asset('js/procesarAjax.js') }}"></script>
<script src="{{ URL::asset('pasar/selectivity-jquery.js') }}"></script>
<script src="https://use.fontawesome.com/336665b8bb.js"></script>
@yield('script')
<script>
    tinymce.init({
        selector: '#editor',
        height: 500,
        theme: 'modern',
        language: 'es',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true,
        templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
        ],
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ]
    });

    $('.abrir-menu').on('click', function () {
        $('#wrapper').toggleClass('abierto');
        $('.menu_lateral').toggleClass('cerrado');
    });
</script>
</body>
</html>