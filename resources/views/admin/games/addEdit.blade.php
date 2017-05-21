@extends('master')
@section('titulo', 'GamersHUB - Actualidad y novedades de videojuegos, comunidad gamer, servicios para jugadores')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('css')
    <link href="{{ URL::asset('plugins/tags-input/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('plugins/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css"/>
    <style>
        .upload_file_label {
            position: relative;
        }

        .upload_file_label input {
            position: absolute;
            z-index: 2;
            opacity: 0;
            width: 100%;
            height: 100%;
        }

        #header_image_preview {
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
@endsection
@section('contenido')
    <section class="bg-primary">
        <div class="container">
            <h3 class="color-white font-weight-300">@lang('admin.addGame.title') | @lang('admin.editGame.title')</h3>
        </div>
    </section>
    <section class="border-bottom-1 border-grey-300 padding-top-10 padding-bottom-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="/">@lang('general.index.title')</a></li>
                        <li><a href="#">@lang('general.games.title')</a></li>
                        <li class="active">@lang('general.add') | @lang('general.edit')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <form action="" method="POST" id="game_form" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="container margin-bottom-30">
            <div class="row margin-top-30">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @if ($errors->has('title'))
                                <div class="alert alert-danger">
                                    @lang('admin.addEditGame.title.error')
                                </div>
                            @endif
                            <div class="form-group input-icon-left">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                <input type="text" class="form-control" placeholder="@lang('admin.title.input')" value="@if(isset($game)){{$game->title}}@else{{ old('title') }}@endif"
                                       name="title" id="title">
                            </div>
                            @if ($errors->has('seo_optimized_title'))
                                <div class="alert alert-danger">
                                    @lang('admin.addEditGame.seo_optimized_title.error')
                                </div>
                            @endif
                            <div class="form-group">
                                <input type="text" class="form-control"
                                       placeholder="@lang('admin.addEditGame.seo_optimized_title.input')" value="@if(isset($game)){{$game->seo_optimized_title}}@else{{ old('seo_optimized_title') }}@endif"
                                       name="seo_optimized_title" id="seo_optimized_title">
                            </div>
                            @if ($errors->has('desc'))
                                <div class="alert alert-danger">
                                    @lang('admin.addEditGame.desc.error')
                                </div>
                            @endif
                            <div class="form-group">
                                <textarea name="desc">@if(isset($game)){{$game->description}}@else{{ old('desc') }}@endif</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary margin-top-30">
                        <div class="panel-heading">
                            <h3 class="panel-title">@lang('admin.addEditGame.gameInfo.title')</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row margin-bottom-10">
                                <div class="col-lg-6">
                                    @if ($errors->has('genres'))
                                        <div class="alert alert-danger">
                                            @lang('admin.addEditGame.genres.error')
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="game_id">@lang('admin.addEditGame.genres.label')</label>
                                        <select class="form-control selectpicker" name="genres" id="genres"
                                                data-live-search="true" multiple>
                                            @foreach(\App\Models\Games\Genre::all() as $genre)
                                                <option value="{{$genre->id}}" @if((old('genres') && in_array($genre->id, old('genres'))) || (isset($game) && in_array($genre->id, $game->genresArray()))) selected @endif>{{$genre->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    @if ($errors->has('categories[]'))
                                        <div class="alert alert-danger">
                                            @lang('admin.addEditGame.categories.error')
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="game_id">@lang('admin.addEditGame.categories.label')</label>
                                        <select class="form-control selectpicker" name="categories[]" id="categories"
                                                data-live-search="true" multiple>
                                            @foreach(\App\Models\Articles\Category::all() as $category)
                                                <option value="{{$category->id}}" @if((old('categories[]') && in_array($category->id, old('categories[]'))) || (isset($game) && in_array($category->id, $game->categoriesArray()))) selected @endif>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row margin-bottom-10">
                                <div class="col-lg-6">
                                    @if ($errors->has('developers'))
                                        <div class="alert alert-danger">
                                            @lang('admin.addEditGame.developers.error')
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="game_id">@lang('admin.addEditGame.developers.label')</label>
                                        <select class="form-control selectpicker" name="developers" id="developers"
                                                data-live-search="true" multiple>
                                            @foreach(\App\Models\Games\Developer::all() as $developer)
                                                <option value="{{$developer->id}}" @if((old('developers') && in_array($developer->id, old('developers'))) || (isset($game) && in_array($developer->id, $game->developersArray()))) selected @endif>{{$developer->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    @if ($errors->has('distributors'))
                                        <div class="alert alert-danger">
                                            @lang('admin.addEditGame.distributors.error')
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="game_id">@lang('admin.addEditGame.distributors.label')</label>
                                        <select class="form-control selectpicker" name="distributors" id="distributors"
                                                data-live-search="true" multiple>
                                            @foreach(\App\Models\Games\Distributor::all() as $distributor)
                                                <option value="{{$distributor->id}}" @if((old('distributors') && in_array($distributor->id, old('distributors'))) || (isset($game) && in_array($distributor->id, $game->distributorsArray()))) selected @endif>{{$distributor->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('available_on'))
                                <div class="alert alert-danger">
                                    @lang('admin.addEditGame.available_on.error')
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="available_on">@lang('admin.addEditGame.available_on.label')</label>
                                <input type="text" class="form-control"
                                       placeholder="@lang('admin.addEditGame.available_on.input')" value="@if(isset($game)){{$game->available_on}}@else{{ old('available_on') }}@endif" name="available_on"
                                       id="available_on">
                            </div>
                            @if ($errors->has('players_quantity'))
                                <div class="alert alert-danger">
                                    @lang('admin.addEditGame.players_quantity.error')
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="players_quantity">@lang('admin.addEditGame.players_quantity.label')</label>
                                <input type="text" class="form-control"
                                       placeholder="@lang('admin.addEditGame.players_quantity.input')" value="@if(isset($game)){{$game->players_quantity}}@else{{ old('players_quantity') }}@endif"
                                       name="players_quantity" id="players_quantity">
                            </div>
                            @if ($errors->has('duration'))
                                <div class="alert alert-danger">
                                    @lang('admin.addEditGame.duration.error')
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="duration">@lang('admin.addEditGame.duration.label')</label>
                                <input type="text" class="form-control"
                                       placeholder="@lang('admin.addEditGame.duration.input')" value="@if(isset($game)){{$game->duration}}@else{{ old('duration') }}@endif" name="duration"
                                       id="duration">
                            </div>
                            @if ($errors->has('language'))
                                <div class="alert alert-danger">
                                    @lang('admin.addEditGame.language.error')
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="language">@lang('admin.addEditGame.language.label')</label>
                                <input type="text" class="form-control"
                                       placeholder="@lang('admin.addEditGame.language.input')" value="@if(isset($game)){{$game->language}}@else{{ old('language') }}@endif" name="language"
                                       id="language">
                            </div>
                            @if ($errors->has('release_date'))
                                <div class="alert alert-danger">
                                    @lang('admin.addEditGame.release_date.error')
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="release_date">@lang('admin.addEditGame.release_date.label')</label>
                                <input type="text" class="form-control"
                                       placeholder="@lang('admin.addEditGame.release_date.input')" value="@if(isset($game)){{\App\Http\Controllers\Games\GamesController::fechaEs($game->release_date)}}@else{{ old('release_date') }}@endif" name="release_date"
                                       id="release_date">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <button type="button"
                            class="btn btn-lg btn-block btn-rounded btn-shadow btn-success "
                            id="save_btn">@lang('general.save.button')</button>
                    @if(isset($game))
                    <button type="button" class="btn btn-lg btn-block btn-rounded btn-shadow btn-danger "
                            onclick="destroyGame({{$game->id}})">@lang('general.delete.button')</button>
                    @endif
                    <button
                            class="btn btn-sm btn-block btn-rounded btn-shadow btn-secondary ">@lang('general.cancel.button')</button>
                    <div class="card card-hover margin-top-30" id="game_box">
                        <div class="card-img">
                            <img src="@if(isset($game)) {{$game->getBoxedImageUrl('sm')}} @else http://placehold.it/370x450/ECECEC @endif" id="boxed_image_preview" alt="">
                        </div>
                        <div class="caption">
                            <h3 class="card-title"><a href="#">@if(isset($game)) {{$game->title}} @else Título @endif</a></h3>
                            <p>@if(isset($game)) {!! $game->description !!} @else Descripción @endif</p>
                            @if ($errors->has('boxed_image'))
                                <div class="alert alert-danger" style="margin-top: 15px">
                                    @lang('admin.addEditGame.boxed_image.error')
                                </div>
                            @endif
                            <div class="upload_file_label btn btn-lg btn-block btn-shadow btn-success">
                                <input type="file" name="boxed_image" id="boxed_image"/>
                                <span>@lang('general.upload_file.button')</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary margin-top-30">
                        <div class="panel-heading">
                            <h3 class="panel-title">@lang('admin.addEditGame.headerImage.title')</h3>
                        </div>
                        <div class="panel-body">
                            <img id="header_image_preview" src="@if(isset($game)){{$game->getHeaderImageUrl('sm')}}@endif" alt=""/>
                            @if ($errors->has('header_image'))
                                <div class="alert alert-danger">
                                    @lang('admin.addEditGame.header_image.error')
                                </div>
                            @endif
                            <div class="upload_file_label btn btn-lg btn-block btn-shadow btn-success">
                                <input type="file" name="header_image" id="header_image"/>
                                <span>@lang('general.upload_file.button')</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <script src="{{ URL::asset('plugins/tags-input/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ URL::asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ URL::asset('plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js') }}"></script>
    <script src="{{ URL::asset('js/admin/games.js') }}"></script>
    <script>
        @if(!isset($game)) $("#header_image_preview").hide(); @endif
    </script>
@endsection