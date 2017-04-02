@extends('backend.master')
@section('titulo', 'Eliminar categoria ('.$categoria->nombre.')')
@section('categorias', 'class="active"')
@section('contenido')
    <div class="main">
        <div class="main-inner">
            <div class="container">
                        <div class="widget ">
                            <div class="widget-header">
                                <i class="icon-bookmark"></i>
                                <h3>[{{$categoria->nombre}}] Eliminar</h3>
                            </div>
                            <div class="widget-content">
                                <form action="/backend/categorias/{{$categoria->id}}/destroy" method="POST">
                                    {{ csrf_field() }}
                                    <input type="text" name="id" value="{{$categoria->id}}" class="hidden">
                                    <p>
                                        ¿Deseas eliminar la categoría/plataforma {{$categoria->nombre}} de la base de datos?
                                    </p>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-danger"><i class="icon-save icon-white"></i> Eliminar</button>
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
        $('#fecha_nacimiento').datepicker({
            format: "yyyy/mm/dd",
            autoclose: true,
            language: "es"
        });
        tinymce.init({
            selector:'textarea'
        });
    </script>
@endsection