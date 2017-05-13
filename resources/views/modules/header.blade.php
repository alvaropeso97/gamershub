<header>
    <div class="barra-top">
        <span class="fa fa-bars abrir-menu"></span>
            <ul>
                <li><a href="https://twitter.com/GamersHUBes" target="_blank"><span class="fa fa-twitter"></span></a></li>
                <li><a href="https://www.facebook.com/gamershubes/" target="_blank"><span class="fa fa-facebook"></span></a></li>
                <li><a href="https://plus.google.com/b/115509563036983669622/115509563036983669622" target="_blank"><span class="fa fa-google-plus"></span></a></li>
                <li><a href="https://steamcommunity.com/groups/GHUBes" target="_blank"><span class="fa fa-steam"></span></a></li>
                <li><a href="https://www.twitch.tv/gamershubtv" target="_blank"><span class="fa fa-twitch"></span></a></li>
            </ul>
    </div>

    <div class="menu_top text-center">
        <a href="/" alt="Ir al inicio"><img width="150px" src="/img/logo_dark.png"></a>
    </div>

    <div class="menu_lateral cerrado">

        @if(Auth::user())
        <div class="menu_usuario">
            <img src="{{Auth::user()->img_perfil}}" class="img-circle" alt="">
            <h3>{{Auth::user()->name}}</h3>
        </div>

        <ul style="border-bottom: 1px solid #2a2a2a; border-top: 1px solid #2a2a2a; margin-bottom: 20px;">
            @if(Auth::user()->acceso == 2 || Auth::user()->acceso == 3)
                <li style="border-color: #AC2943;"><a href="/panel/usuarios">Usuarios</a></li>
                @endif
                @if(Auth::user()->acceso == 1 || Auth::user()->acceso == 3)
                    <li style="border-color: #AC2943;"><a href="/panel/articulos">Artículos</a></li>
                    <li style="border-color: #AC2943;"><a href="/panel/juegos">Juegos</a></li>
                @endif
            <li style="border-color: darkred;"><a href="/logout">Cerrar sesión</a></li>
        </ul>
        @else
            <ul style="border-bottom: 1px solid #2a2a2a; border-top: 1px solid #2a2a2a; margin-bottom: 20px;">
                <li style="border-color: #bf0411;"><a href="/register">Registrarme</a></li>
                <li style="border-color: #006cb1;"><a href="/login">Entrar</a></li>
            </ul>
        @endif

        <ul style="border-bottom: 1px solid #2a2a2a; border-top: 1px solid #2a2a2a;">
            <li><a href="/">Inicio</a></li>
            <li style="border-color: #d33400;"><a href="/categoria/pc">PC</a></li>
            <li style="border-color: #117d10;"><a href="/categoria/xone">XBOX ONE</a></li>
            <li style="border-color: #58a300;"><a href="/categoria/x360">XBOX 360</a></li>
            <li style="border-color: #004098;"><a href="/categoria/ps4">PLAY STATION 4</a></li>
            <li style="border-color: #006cca;"><a href="/categoria/ps3">PLAY STATION 3</a></li>
            <li style="border-color: #276d99;"><a href="/categoria/wii-u">WII U</a></li>
            <li style="border-color: #19758f;"><a href="/categoria/3ds">NINTENDO 3DS</a></li>
            <li style="border-color: #d33400;"><a href="/categoria/ps-vita">PS VITA</a></li>
            <li style="border-color: #8e7900;"><a href="/categoria/ios">iOS</a></li>
            <li style="border-color: #a4c739;"><a href="/categoria/android">ANDROID</a></li>
            <li style="border-color: #e60011;"><a href="/categoria/nintendo-switch">NINTENDO SWITCH</a></li>
        </ul>
    </div>

</header>


