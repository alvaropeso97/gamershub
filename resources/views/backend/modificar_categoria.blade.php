@extends('backend.master')
@section('titulo', 'Modificar categoría ('.$categoria->nombre.')')
@section('categorias', 'class="active"')
@section('contenido')
    <div class="main">
        <div class="main-inner">
            <div class="container">
                        <div class="widget ">
                            <div class="widget-header">
                                <i class="icon-bookmark"></i>
                                <h3>[{{$categoria->nombre}}] Modificar</h3>
                            </div>
                            <div class="widget-content">
                                @if(Session::has('mensaje')) <div class="alert alert-success"> {{Session::get('mensaje')}} </div> @endif
                                <form action="/backend/categorias/{{$categoria->id}}/update" method="POST">
                                    {{ csrf_field() }}
                                    <input type="text" name="id" value="{{$categoria->id}}" class="hidden">
                                    <div class="row">
                                        <div class="span2">
                                            <div class="form-group">
                                                <label class="control-label" for="nombre">Nombre</label>
                                                <input type="text" class="span2" id="nombre" name="nombre" value="{{$categoria->nombre}}">
                                            </div>
                                        </div>
                                        <div class="span2">
                                            <div class="form-group">
                                                <label class="control-label" for="color">Color</label>
                                                <input type="text" class="span2" id="color" name="color" value="{{$categoria->color}}">
                                            </div>
                                        </div>
                                        <div class="span2">
                                            <div class="form-group">
                                                <label class="control-label" for="alias">Alias</label>
                                                <input type="text" class="span2" id="alias" name="alias" value="{{$categoria->alias}}">
                                            </div>
                                        </div>
                                        <div class="span3">
                                            <div class="form-group">
                                                <label class="control-label" for="esplataforma">Plataforma</label>
                                                <select name="esplataforma" id="esplataforma">
                                                    <option value="0" @if($categoria->esplataforma == 0) selected @endif>No</option>
                                                    <option value="1" @if($categoria->esplataforma == 1) selected @endif>Sí</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"><i class="icon-save icon-white"></i> Guardar</button>
                                        <a class="btn" href="/backend/categorias">Volver</a>
                                    </div>
                                </form>
                            </div>
                        </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#color').ColorPicker({
            color: '{{$categoria->color}}',
            onChange: function (hsb, hex, rgb) {
                $('#color').val('#'+hex);
            }
        })
    </script>
@endsection