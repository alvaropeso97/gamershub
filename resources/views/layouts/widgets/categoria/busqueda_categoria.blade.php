<div class="container">
    <div class="headline">
        <h4>Buscar en {{$id->nombre}}</h4>
        <div class="btn-group pull-right">
            <a href="#" class="btn btn-default"><i class="fa fa-th-large no-margin"></i></a>
            <a href="#" class="btn btn-default"><i class="fa fa-bars no-margin"></i></a>
        </div>

        <input type="text" class="form-control hidden-xs" placeholder="Buscar artículo...">

        <div class="dropdown">
            <a href="#" class="btn btn-default btn-icon-left btn-icon-right dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sort-amount-desc"></i> Ordenar por <i class="ion-android-arrow-dropdown"></i></a>
            <ul class="dropdown-menu">
                <li><a href="/categoria/{{$id->alias}}">Fecha</a></li>
                <li><a href="/categoria/{{$id->alias}}/a-z">A-Z</a></li>
            </ul>
        </div>
    </div>
</div>