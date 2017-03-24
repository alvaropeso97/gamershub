@extends('layouts.master')
@section('titulo', 'Categoría/Plataforma no encontrada')
@section('contenido')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <div class="title">
                        <h4><i class="fa fa-bug"></i> Sin resultados...</h4>
                    </div>
                    <p>La categoría/plataforma no existe</p>
                    <form>
                        <div class="col-lg-8 pull-none display-inline-block">
                            <div class="btn-inline">
                                <input type="text" class="form-control input-lg padding-right-40"
                                       placeholder="Buscar categorías y plataformas">
                                <button type="submit" class="btn btn-link color-grey-700 padding-top-10"><i
                                            class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <a href="/" class="btn btn-primary btn-lg margin-top-20 btn-shadow btn-rounded">Página principal</a>
                </div>
                <div class="col-lg-5 height-300">
                    <img src="/img/content/error_busq.png" class="image-right" alt="">
                </div>
            </div>
        </div>
    </section>
@endsection