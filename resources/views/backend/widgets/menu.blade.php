<div class="subnavbar">
    <div class="subnavbar-inner">
        <div class="container">
            <ul class="mainnav">
                <li @yield('dashboard')><a href="/backend/dashboard"><i class="icon-dashboard"></i><span>Dashboard</span></a></li>
                @if(auth()->user()->tienePermiso(3) || auth()->user()->acceso == 333)
                    <li @yield('usuarios')><a href="/backend/usuarios"><i class="icon-user"></i><span>Usuarios</span></a></li>
                @endif
                <li><a href="/backend/articulos"><i class="icon-file-text"></i><span>Artículos</span></a></li>
                <li><a href="/backend/juegos"><i class="icon-gamepad"></i><span>Juegos</span></a></li>
                <li><a href="/backend/videos"><i class="icon-play"></i><span>Vídeos</span></a></li>
                <li><a href="/backend/imagenes"><i class="icon-picture"></i><span>Imágenes</span></a></li>
                <li><a href="/backend/categorias"><i class="icon-bookmark"></i><span>Categorías</span></a></li>
                <li><a href="/backend/plataformas"><i class="icon-desktop"></i><span>Plataformas</span></a></li>
                @if(auth()->user()->tienePermiso(6) || auth()->user()->acceso == 333)
                <li class="dropdown @yield('configuracion')"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-cog"></i><span>Configuración</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/backend/configuracion">General</a></li>
                        @if(auth()->user()->tienePermiso(7) || auth()->user()->acceso == 333)
                        <li><a href="/backend/configuracion/roles">Roles & Permisos</a></li>
                        @endif
                    </ul>
                </li>
                @endif
        </div>
    </div>
</div>