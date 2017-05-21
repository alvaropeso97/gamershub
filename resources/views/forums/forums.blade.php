@extends('master')
@section('titulo', 'Foros')
@section('contenido')
    <section class="bg-grey-50 padding-bottom-60">
        <div class="container">
            @foreach($forumsSections as $forumSection)
            <div class="headline margin-top-60">
                <h4>{{$forumSection->title}} <small>{{$forumSection->description}}</small></h4>
            </div>
            <div class="forum">
                @foreach($forumSection->forums as $forum)
                <div class="forum-group">
                    <div class="forum-icon"><i class="ion-playstation"></i></div>
                    <div class="forum-title">
                        <h4><a href="forum-threads.html">{{$forum->title}}</a></h4>
                        <p>¡¡Descripción!!</p>
                    </div>
                    <div class="forum-activity">
                        <a href="profile.html"><img src="img/user/avatar.jpg" alt=""></a>
                        <div>
                            <h4><a href="forum-threads.html">Call of Duty Multiplayer</a></h4>
                            <span><a href="profile.html">Admin</a> on March 18, 2016</span>
                        </div>
                    </div>
                    <div class="forum-meta">{{count($forum->countTopics())}} temas</div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </section>
@endsection