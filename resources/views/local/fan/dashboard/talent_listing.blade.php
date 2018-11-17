@extends('local.dashboard_layout')


@section('css')

<style type="text/css">

    .blog_archieve li a {
        padding: 10px 0 !important;
    }

    .form-group button {
        font-size: 14px !important;
        padding: 10px 10px !important;
    }

    .navbar-inverse .navbar-nav>li>a{
        padding: 10px 17px;
        margin: 0px 17px;
    }

    .navbar-inverse .navbar-nav>li>a:hover{
        padding: 10px 17px;
        margin: 0px 17px;
    }

    .user-image{
        position: inherit;
    }

    .about_margin{
        margin-top: -20px;
    }

    .space-50{
        height: 50px;
    }

    .space-30{
        height: 30px;
    }

    .aside,.widget{
        padding: 10px !important;
    }

    .widget{
        margin-bottom: 0px;
    }

    .h2_margin{
        margin-top: 30px;
    }

    .pad_left{
        padding-left: 50px;
    }

    body{
        background-color: #fff;
    }

    .btn_clr{
        color: #fff;
        background-color: #EC5538;
    }

    .btn_clr:hover{
        color: #fff;
        background-color: #EC5538;
        border-color: #EC5538;
    }

    .widget.social_icon a{
        background-color: #fff;
        font-size: 25px;
    }

    .talent_btn{
        padding: 3px 15px;
        font-size: 12px;
        margin-left: 60px;
    }

    .block_btn{
        padding: 3px 15px;
        font-size: 12px;
        margin-left: 60px;
    }

    .errorTxt, .error { 
        color: #dc3545 !important;
        font-weight: unset !important;
    }

    body>section{
        min-height: 299px;
    }

    .team-img {
        height: 270px;
    }

    .single-team img{
        height: 100%;
    }
</style>

@endsection

@section('content')

<!-- <div class="page-title" style='background-image: url("{{ asset("/theme/images/page-title.png") }}")'>
    <h1>Talents</h1>
</div> -->


<section id="team-area">
        <div class="container">
            <div class="center fadeInDown">
                <h2>Talents</h2>
<!--                 <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p> -->
            </div>
            <div class="row">
                @if(isset($users))
                    @foreach($users as $user)
                        @if( $user->hasRole('Talents') && Auth::user()->id != $user->id )
                            <div class="col-md-3 col-sm-6 single-team">
                                <div class="inner">
                                    <div class="team-img">
                                        @if($user->image != null)
                                            <img src="{{ asset('storage/users/'.$user->image) }}" title="{{ $user->name }}" alt=""> 
                                        @else
                                            <img src="{{ asset('storage/users/default.png') }}" alt=""> 
                                        @endif
                                    </div>
                                    <div class="team-content">
                                        <h4>{{ $user->name }}</h4>
                                        @if($user->plan_code == 'premium' && $user->hasRole('Talents'))
                                            @if(isset($follows))
                                                @if(in_array($user->id,$follows))
                                                    <form action="{{ route('fan.unfollow.talent') }}" method="POST">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="follower_id" value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="followed_id" value="{{ $user->id }}">
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-default bt-sm">Unfollow</button>
                                                        </div>
                                                    </form>
                                                @else
                                                    <form action="{{ route('fan.follow.talent') }}" method="POST">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="follower_id" value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="followed_id" value="{{ $user->id }}">
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-primary bt-sm">Follow</button>
                                                        </div>
                                                    </form>
                                                @endif
                                            @endif
                                        @endif
                                        <div class="team-social">
                                            @if($user->additional_info->facebook != '')
                                                <a class="fa fa-facebook" href="{{ $user->additional_info->facebook }}"></a>
                                            @endif
                                            @if($user->additional_info->twitter != '')
                                                <a class="fa fa-twitter" href="{{ $user->additional_info->twitter }}"></a>
                                            @endif
                                            @if($user->additional_info->linkedin != '')
                                                <a class="fa fa-linkedin" href="{{ $user->additional_info->linkedin }}"></a>
                                            @endif
                                            @if($user->additional_info->instagram != '')
                                                <a class="fa fa-instagram" href="{{ $user->additional_info->instagram }}"></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
</section>


@endsection