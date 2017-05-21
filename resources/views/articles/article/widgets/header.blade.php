@if($id->type == \App\Models\Articles\Article::TYPE_VIDEO)
    <section class="background-image padding-top-50 padding-bottom-50"
             style="background-image: url(https://i.ytimg.com/vi/{{$id->video->youtube_code}}/maxresdefault.jpg);">
        <span class="background-overlay"></span>
        <div class="container">
            <div class="embed-responsive embed-responsive-16by9" id="reproductor-video">
                <script type="text/javascript">
                    var playerInstance = jwplayer("reproductor-video");
                    playerInstance.setup({
                        file: "//https://www.youtube.com/watch?v={{$id->video->youtube_code}}",
                        image: "https://i.ytimg.com/vi/{{$id->video->youtube_code}}/maxresdefault.jpg"
                    });
                </script>
            </div>
        </div>
    </section>
    <section class="hero bg-white border-bottom-1 border-grey-200">
        <div class="container">
            <div class="page-header">
                @foreach($id->categories as $categoria) <a
                        href="/categoria/{{$categoria->alias}}"><span class="art_categoria categoria_borde"
                                                                      style="border-color:{{$categoria->color}}; color: #000;">{{$categoria->name}}</span></a> @endforeach</p>
                <div class="page-title"><b>{{$id->title}}</b></div>
                <ol class="breadcrumb">
                    {{$id->descripcion}}
                </ol>
            </div>
        </div>
    </section>

@else
    <section class="hero hero-review height-500"
             style="background-image: url('{{$id->getImageUrl('lg')}}'); height: 400px; ">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="page-header">
                @foreach($id->categories as $categoria) <a
                        href="/categoria/{{$categoria->alias}}"><span class="art_categoria categoria_borde"
                                                                      style="border-color:{{$categoria->color}};">{{$categoria->name}}</span></a> @endforeach</p>
                <div class="page-title">{{$id->title}}</div>
                <p>{{$id->description}}<br><br></div>
        </div>
    </section>
@endif