@extends('master')
@section('titulo', 'GamersHUB - Actualidad y novedades de videojuegos, comunidad gamer, servicios para jugadores')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('css')
    <link href="{{ URL::asset('plugins/tags-input/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
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

        #image_preview{
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
@endsection
@section('contenido')
    <section class="bg-primary">
        <div class="container">
            <h3 class="color-white font-weight-300">@if(isset($article)) @lang('admin.editArticle.title') @else @lang('admin.addArticle.title') @endif</h3>
        </div>
    </section>
    <section class="border-bottom-1 border-grey-300 padding-top-10 padding-bottom-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="/">@lang('general.index.title')</a></li>
                        <li><a href="#">@lang('general.articles.title')</a></li>
                        <li class="active">@if(isset($article)) @lang('general.edit') @else @lang('general.add') @endif</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <form action="" method="POST" id="article_form" enctype="multipart/form-data">
        {{ csrf_field() }}
    <div class="container margin-bottom-30">
        <div class="row margin-top-30">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if ($errors->has('title'))
                            <div class="alert alert-danger">
                                @lang('admin.addEditArticle.title.error')
                            </div>
                        @endif
                        <div class="form-group input-icon-left">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            <input type="text" class="form-control" placeholder="@lang('admin.title.input')" value="@if(isset($article)){{$article->title}}@else{{ old('title') }}@endif" name="title" id="title">
                        </div>
                        @if ($errors->has('seo_optimized_title'))
                             <div class="alert alert-danger">
                                 @lang('admin.addEditArticle.seo_optimized_title.error')
                             </div>
                            @endif
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="@lang('admin.addEditArticle.seo_optimized_title.input')" value="@if(isset($article)){{$article->seo_optimized_title}}@else{{ old('seo_optimized_title') }}@endif" name="seo_optimized_title" id="seo_optimized_title">
                        </div>
                            @if ($errors->has('content'))
                                <div class="alert alert-danger">
                                    @lang('admin.addEditArticle.content.error')
                                </div>
                            @endif
                        <div class="form-group">
                            <textarea name="content">@if(isset($article)){{$article->content}}@else{{ old('content') }}@endif</textarea>
                        </div>
                            @if ($errors->has('description'))
                                <div class="alert alert-danger">
                                    @lang('admin.addEditArticle.description.error')
                                </div>
                            @endif
                        <div class="form-group input-icon-left">
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                            <textarea name="description" class="form-control" placeholder="@lang('admin.addEditArticle.description.textarea')">@if(isset($article)){{$article->description}}@else{{ old('description') }}@endif</textarea>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default margin-top-30" id="video_panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-youtube-play" aria-hidden="true"></i> @lang('admin.addEditArticle.video.title')</h3>
                    </div>
                    <div class="panel-body">
                        @if ($errors->has('youtube_code'))
                            <div class="alert alert-danger">
                                @lang('admin.addEditArticle.youtube_code.error')
                            </div>
                        @endif
                        @if ($errors->has('duration'))
                            <div class="alert alert-danger">
                                @lang('admin.addEditArticle.duration.error')
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="youtube_code">@lang('admin.addEditArticle.youtube_code.label')</label>
                                    <input type="text" class="form-control" placeholder="@lang('admin.addEditArticle.youtube_code.input')" value="@if(isset($article->video)){{$article->video->youtube_code}}@else{{ old('youtube_code') }}@endif" name="youtube_code" id="youtube_code">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="duration">@lang('admin.addEditArticle.duration.label')</label>
                                    <input type="text" class="form-control" placeholder="@lang('admin.addEditArticle.duration.input')" value="@if(isset($article->video)){{$article->video->duration}}@else{{ old('duration') }}@endif" name="duration" id="duration">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default margin-top-30" id="review_panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-star-half-o" aria-hidden="true"></i> @lang('admin.addEditArticle.review.title')</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group text-center">
                            <h3>@lang('admin.addEditArticle.gameplay_score.text')</h3>
                            <h4 id="range_gameplay_score">0</h4>
                            <input type="range"  min="0" max="100" class="form-control" name="gameplay_score" id="gameplay_score" value="@if(isset($article->review)){{$article->gameplay_score}}@else{{ old('gameplay_score') }}@endif" onchange="showValueGameplay(this.value)"/>
                        </div>
                        <div class="form-group text-center">
                            <h3>@lang('admin.addEditArticle.graphics_score.text')</h3>
                            <h4 id="range_graphics_score">0</h4>
                            <input type="range"  min="0" max="100" class="form-control" name="graphics_score" id="graphics_score" value="@if(isset($article->review)){{$article->graphics_score}}@else{{ old('graphics_score') }}@endif" onchange="showValueGraphics(this.value)"/>
                        </div>
                        <div class="form-group text-center">
                            <h3>@lang('admin.addEditArticle.sounds_score.text')</h3>
                            <h4 id="range_sounds_score">0</h4>
                            <input type="range"  min="0" max="100" class="form-control" name="sounds_score" id="sounds_score" value="@if(isset($article->review)){{$article->sounds_score}}@else{{ old('sounds_score') }}@endif" onchange="showValueSounds(this.value)"/>
                        </div>
                        <div class="form-group text-center">
                            <h3>@lang('admin.addEditArticle.innovation_score.text')</h3>
                            <h4 id="range_innovation_score">0</h4>
                            <input type="range"  min="0" max="100" class="form-control" name="innovation_score"  id="innovation_score" value="@if(isset($article->review)){{$article->review->innovation_score}}@else{{ old('innovation_score') }}@endif" onchange="showValueInnovation(this.value)"/>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <button type="button" class="btn btn-lg btn-block btn-rounded btn-shadow btn-success" id="save_btn">@lang('general.save.button')</button>
                @if(isset($article)) <button type="button" class="btn btn-lg btn-block btn-rounded btn-shadow btn-danger" onclick="destroyArticle({{$article->id}})">@lang('general.delete.button')</button> @endif
                <button type="button" class="btn btn-sm btn-block btn-rounded btn-shadow btn-secondary" onclick="location.href = '{{ route('admin.articles.index') }}'">@lang('general.cancel.button')</button>
                <div class="card card-hover margin-top-30" id="game_id_box">
                    <div class="card-img">
                        <img src="@if(isset($article->game)) {{$article->game->getBoxedImageUrl('sm')}} @endif" alt="" id="game_img_card">
                    </div>
                    <div class="caption">
                        <h3 class="card-title"><a href="#" id="game_title_card">@if(isset($article->game)) {{$article->game->title}} @endif</a></h3>
                        <p id="game_desc_card">@if(isset($article->game)) {!! $article->game->description !!} @endif</p>
                        <a href="@if(isset($article->game)) /admin/games/addEdit/{{$article->game->id}} @endif" class="btn btn-block btn-primary" id="game_href_card">@lang('general.view_game')</a>
                    </div>
                </div>
                @if(isset($article->user))
                <div class="panel panel-default margin-top-30">
                    <div class="panel-heading">
                        <h3 class="panel-title">@lang('admin.articleUser.title')</h3>
                    </div>
                    <div class="panel-body text-center">
                        <img src="{{$article->user->avatar}}" class="img-circle" alt="" height="150px" width="150px" style="margin-bottom: 25px;">
                        <h3>{{$article->user->nickname}} <small>{{$article->getFechaLocal()}}</small></h3>
                    </div>
                </div>
                @endif
                <div class="panel panel-primary margin-top-30">
                    <div class="panel-heading">
                        <h3 class="panel-title">@lang('admin.articleOptions.title')</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="type">@lang('admin.addEditArticle.type.label')</label>
                            <select class="form-control" name="type" id="type">
                                <option value="0" @if(old('type') == 0 || (isset($article) && $article->type == 0)) selected @endif>@lang('general.new')</option>
                                <option value="1" @if(old('type') == 1 || (isset($article) && $article->type == 1)) selected @endif>@lang('general.advance')</option>
                                <option value="2" @if(old('type') == 2 || (isset($article) && $article->type == 2)) selected @endif>@lang('general.video')</option>
                                <option value="3" @if(old('type') == 3 || (isset($article) && $article->type == 3)) selected @endif>@lang('general.review')</option>
                            </select>
                        </div>
                        @if ($errors->has('game_id'))
                            <div class="alert alert-danger">
                                @lang('admin.addEditArticle.game_id.error')
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="game_id">@lang('admin.addEditArticle.relatedGame.label')</label>
                            <select class="form-control selectpicker" name="game_id" id="game_id" data-live-search="true">
                                <option value="0" selected>@lang('general.none.text')</option>
                                @foreach(\App\Models\Games\Game::all() as $game)
                                    <option value="{{$game->id}}" @if(old('game_id') == $game->id || (isset($article->game) && $article->game->id == $game->id)) selected @endif>{{$game->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categories">@lang('admin.addEditArticle.categories.label')</label>
                            <select class="form-control selectpicker" name="categories[]" id="categories" data-live-search="true" multiple>
                                @foreach(\App\Models\Articles\Category::all() as $category)
                                    <option value="{{$category->id}}" @if((old('categories') && in_array($category->id, old('categories'))) || (isset($article) && in_array($category->id, $article->categoriesArray()))) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>                        </div>
                        @if ($errors->has('tags'))
                            <div class="alert alert-danger">
                                @lang('admin.addEditArticle.tags.error')
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="tags">@lang('admin.addEditArticle.tags.label')</label>
                            <input data-role="tagsinput" name="tags" id="tags" value="@if(isset($article)) @foreach($article->tags as $tag){{$tag->name}},@endforeach @else {{old('tags')}} @endif">
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary margin-top-30">
                    <div class="panel-heading">
                        <h3 class="panel-title">@lang('admin.articleImage.title')</h3>
                    </div>
                    <div class="panel-body">
                        @if ($errors->has('image'))
                            <div class="alert alert-danger">
                                @lang('admin.addEditArticle.image.error')
                            </div>
                        @endif
                        <img id="image_preview" src="@if(isset($article)) {{Config::get('constants.S1_URL')}}/noticias_rsz/500x281_{{$article->image}} @endif" alt="" />
                        <div class="upload_file_label btn btn-lg btn-block btn-shadow btn-success">
                            <input type="file" name="image" value="@if(isset($article)) {{Config::get('constants.S1_URL')}}/noticias_rsz/1600x900_{{$article->image}} @endif" id="image"/>
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
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <script src="{{ URL::asset('plugins/tags-input/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ URL::asset('js/admin/articles.js') }}"></script>
    <script>
        @if(!isset($article)) $( "#image_preview" ).hide(); @endif
        $( "#review_panel" ).hide();
        $( "#video_panel" ).hide();
        @if(!isset($article->game)) $( "#game_id_box" ).hide(); @endif
        @if(old('type') == 2  || (isset($article) && $article->type == 2)) $( "#video_panel" ).show(); @endif
        @if(old('type') == 3  || (isset($article) && $article->type == 3)) $( "#review_panel" ).show(); @endif
    </script>
@endsection