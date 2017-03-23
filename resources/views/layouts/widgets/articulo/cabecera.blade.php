@if($id->tipo == "vid")
    <section class="background-image padding-top-50 padding-bottom-50"
             style="background-image: url(https://i.ytimg.com/vi/{{$vid->cod_yt}}/maxresdefault.jpg);">
        <span class="background-overlay"></span>
        <div class="container">
            <div class="embed-responsive embed-responsive-16by9" id="reproductor-video">
                <script type="text/javascript">
                    var playerInstance = jwplayer("reproductor-video");
                    playerInstance.setup({
                        file: "//https://www.youtube.com/watch?v={{$vid->cod_yt}}",
                        image: "https://i.ytimg.com/vi/{{$vid->cod_yt}}/maxresdefault.jpg"
                    });
                </script>
            </div>
        </div>
    </section>
    <section class="hero bg-white border-bottom-1 border-grey-200">
        <div class="container">
            <div class="page-header">
                @foreach($id->getCategorias as $categoria) <a
                        href="/categoria/{{$categoria->alias}}"><span class="art_categoria categoria_borde"
                                                                      style="border-color:{{$categoria->color}}; color: #000;">{{$categoria->nombre}}</span></a> @endforeach</p>
                <div class="page-title"><b>{{$id->titulo}}</b></div>
                <ol class="breadcrumb">
                    {{$id->descripcion}}
                </ol>
            </div>
        </div>
    </section>

@else
    <section class="hero hero-review height-500"
             style="background-image: url('{{Config::get('constants.S1_URL')}}/noticias/{{$id->img}}'); height: 400px; ">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="page-header">
                @foreach($id->getCategorias as $categoria) <a
                        href="/categoria/{{$categoria->alias}}"><span class="art_categoria categoria_borde"
                                                                      style="border-color:{{$categoria->color}};">{{$categoria->nombre}}</span></a> @endforeach</p>
                <div class="page-title">{{$id->titulo}}</div>
                <p>{{$id->descripcion}}<br><br></div>
        </div>
    </section>
@endif