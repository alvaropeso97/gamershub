<div class="container">
    @php $contador = 1; @endphp
    @foreach($cons as $articulo)
        @if($contador == 1 || $contador == 4 || $contador == 7)
            <div class="row">
                @endif
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-img">
                            <a href="/articulo/{{$articulo->id}}/{{$articulo->lnombre}}"><img style="border-radius: 10px 10px 0px 0px;-webkit-border-radius: 10px 10px 0px 0px;" src="{{Config::get('constants.S1_URL')}}/noticias_rsz/950x534_{{$articulo->img}}" alt=""></a>
                            <div class="category">@foreach($articulo->getCategorias as $categoria) <a href="/categoria/{{$categoria->alias}}"><span  class="label" style="background:{{$categoria->color}};">{{$categoria->nombre}}</span></a> @endforeach</div>

                            <div class="meta"><a href="/articulo/{{$articulo->id}}/{{$articulo->lnombre}}"></a></div>
                        </div>
                        <div class="caption" style="border-radius: 0px 0px 10px 10px;-webkit-border-radius: 0px 0px 10px 10px;">
                            @if($articulo->tipo == "ana")
                                @php $nota = $articulo->getAnalisis->getNotaMostrar() @endphp
                                <span class="nota_analisis {{$articulo->getAnalisis->getColor()}}">{{$nota}}</span>
                            @endif
                            <div class="tipo">{{$articulo->getTipo()}}</div>
                            <h3 class="card-title"><a href="/articulo/{{$articulo->id}}/{{$articulo->lnombre}}">{{$articulo->titulo}}</a></h3>
                            <ul><li>{{\App\Http\Controllers\ArticlesController::traducirFecha($articulo->fecha)}}</li></ul>
                            <p>{{$articulo->descripcion}}</p>
                        </div>
                    </div>
                </div>
                @if($contador == 3 || $contador == 6 || $contador == 9)
            </div>
        @endif
        @php $contador++; @endphp
    @endforeach
    <div class="row">
        <div class="col-lg-12 text-center">
            {{$cons->render()}}
        </div>
    </div>
</div>