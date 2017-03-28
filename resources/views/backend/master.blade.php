<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('titulo') | Backend | GAMERSHUB</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link href="{{ URL::asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('backend/css/bootstrap-responsive.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('backend/css/font-awesome.css') }}" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="{{ URL::asset('backend/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('backend/css/pages/signin.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('backend/css/pages/dashboard.css') }}" rel="stylesheet" type="text/css">

</head>

<body>

<div class="navbar navbar-fixed-top">

    <div class="navbar-inner">

        <div class="container">

            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <a class="brand" href="/">
                GamersHUB | Backend
            </a>

            <div class="nav-collapse">
                <ul class="nav pull-right">
                    <li class="">
                        <a href="/" class="">
                            <i class="icon-chevron-left"></i>
                            Volver al portal
                        </a>

                    </li>
                </ul>

            </div><!--/.nav-collapse -->

        </div> <!-- /container -->

    </div> <!-- /navbar-inner -->

</div> <!-- /navbar -->
@yield('contenido')
<script src="{{ URL::asset('backend/js/jquery-1.7.2.min.js') }}"></script>
<script src="{{ URL::asset('backend/js/bootstrap.js') }}"></script>
<script src="{{ URL::asset('backend/js/signin.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ URL::asset('backend/js/full-calendar/fullcalendar.min.js') }}"></script>
<script src="{{ URL::asset('backend/js/base.js') }}"></script>
@yield('script')
</body>
</html>