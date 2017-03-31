@extends('backend.master')
@section('titulo', 'Categorías y plataformas')
@section('categorias', 'class="active"')
@section('contenido')
    <div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="widget ">
                            <div class="widget-header">
                                <i class="icon-bookmark"></i>
                                <h3>Categorías y plataformas</h3>
                            </div>
                            <div class="widget-content">
                                @if(Session::has('mensaje')) <div class="alert alert-success"> {{Session::get('mensaje')}} </div> @endif
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Alias</th>
                                        <th>Plataforma</th>
                                        <th width="77px">Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categorias as $categoria)
                                        <tr>
                                            <td>{{$categoria->id}}</td>
                                            <td style="color: {{$categoria->color}};">{{$categoria->nombre}}</td>
                                            <td>{{$categoria->alias}}</td>
                                            <td>@if($categoria->esplataforma == 1) Sí @else No @endif</td>
                                            <td>
                                                <a href="/backend/categorias/{{$categoria->id}}/modificar" class="btn btn-small btn-success"><i class="btn-icon-only icon-edit"></i></a>
                                                <a href="/backend/categorias/{{$categoria->id}}/eliminar" class="btn btn-small btn-success"><i class="btn-icon-only icon-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="widget">
                            <div class="widget-header">
                                <i class="icon-plus"></i>
                                <h3>Nueva categoría</h3>
                            </div>
                            <div class="widget-content">
                                <form action="/backend/categorias/store" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="span2">
                                            <div class="form-group">
                                                <label class="control-label" for="nombre">Nombre</label>
                                                <input type="text" class="span2" id="nombre" name="nombre">
                                            </div>
                                        </div>
                                        <div class="span2">
                                            <div class="form-group">
                                                <label class="control-label" for="color">Color</label>
                                                <input type="text" class="span2" id="color" name="color">
                                            </div>
                                        </div>
                                        <div class="span2">
                                            <div class="form-group">
                                                <label class="control-label" for="alias">Alias</label>
                                                <input type="text" class="span2" id="alias" name="alias">
                                            </div>
                                        </div>
                                        <div class="span3">
                                            <div class="form-group">
                                                <label class="control-label" for="esplataforma">Plataforma</label>
                                                <select name="esplataforma" id="esplataforma">
                                                    <option value="0">No</option>
                                                    <option value="1">Sí</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary"><i class="icon-plus icon-white"></i> Crear</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#color').ColorPicker({
            onChange: function (hsb, hex, rgb) {
                $('#color').val('#'+hex);
            }
        })
    </script>
@endsection