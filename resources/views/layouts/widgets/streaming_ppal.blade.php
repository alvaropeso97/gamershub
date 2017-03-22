<section class="hero height-150 bg-white border-bottom-1 border-grey-200">
    <div class="container">
        <div class="page-header">
            <div class="page-title"><i style="color:red;" class="fa fa-dot-circle-o"></i> Emisión en directo</div>
            <ol class="breadcrumb">
                <b><a href="https://www.twitch.tv/{{$streaming->usuario_twitch}}">{{$streaming->titulo}}</a></b>, emitido por <b><a href="https://www.twitch.tv/{{$streaming->usuario_twitch}}">{{$streaming->emisor}}</a></b>
            </ol>
        </div>
    </div>
</section>
<section class="background-image padding-top-50 padding-bottom-50" style="background-image: url({{$streaming->bg_streaming}});">
    <span class="background-overlay"></span>
    <div class="container">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://player.twitch.tv/?channel={{$streaming->usuario_twitch}}" allowfullscreen></iframe>

        </div>
    </div>
</section>