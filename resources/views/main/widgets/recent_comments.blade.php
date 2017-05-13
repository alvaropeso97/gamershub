<div class="widget widget-list">
    <div class="title">@lang('general.recent_comments')</div>
    <?php $comments = \App\Comment::orderBy('created_at', 'desc')->take(5)->get(); ?>
    <ul>
        @foreach($comments as $comment)
            <?php
            $user = $comment->user;
            $article =  $comment->article;
            ?>
            <li>
                <a href="usuario" class="thumb"><img src="{{$user->avatar}}" alt=""></a>
                <div class="widget-list-meta">
                    <h4 class="widget-list-title"><a href="/articulo/{{$article->id}}/{{$article->seo_optimized_name}}#comentarios">{{$article->title}}</a></h4>
                    <p><i class="fa fa-clock-o"></i> {{$comment->getFecha()}}</p>
                </div>
            </li>
        @endforeach
    </ul>
</div>