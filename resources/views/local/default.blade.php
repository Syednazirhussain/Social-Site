<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Creatifny</title>


    <link href="{{ asset('/theme/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/css/icomoon.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('/skin-1/assets/css/pixeladmin.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/skin-1/assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('/theme/images/artist.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('/theme/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('/theme/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('/theme/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('/theme/images/ico/apple-touch-icon-57-precomposed.png') }}">
    @yield('css')

    <style type="text/css">
        .navbar {
            padding: unset !important;
        }

        .navbar-nav>li {
            margin-left: 0px !important;
            padding-bottom: 0px !important;
        }

        .navbar-nav {
             margin-top: unset !important; 
        }

        .navbar-inverse .navbar-nav>li>a {
            margin: 0px 17px !important;
            color: #ddd !important;
            padding: 10px 5px !important;
            font-weight: 600 !important;
        }

        .navbar-inverse .navbar-nav>li>a:hover {
            background-color: unset !important;
            color: #fff !important;
        }
    </style>

</head>
<body>

    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">

            @if(auth()->check())
                @if(auth()->user()->plan_code == 'free')
                    <a class="navbar-brand" href="{{ route('fan.user.dashboard') }}">
                        <img src="{{ asset('/theme/images/logo1.png') }}" style="max-width: 115px;max-height: 52px" alt="logo">
                    </a>
                @else
                    <a class="navbar-brand" href="{{ route('talent.user.dashboard') }}">
                        <img src="{{ asset('/theme/images/logo1.png') }}" style="max-width: 115px;max-height: 52px" alt="logo">
                    </a>
                @endif                
            @else
                <a class="navbar-brand" href="{{ route('site.dashboard') }}">
                    <img src="{{ asset('/theme/images/logo1.png') }}" style="max-width: 115px;max-height: 52px" alt="logo">
                </a>
            @endif
        </div>
        <ul class="nav navbar-nav">
            <li>
                <a href="{{ route('site.creatifny.feature') }}">Feature</a>
            </li>
            <li>
                <a href="{{ route('site.creatifny.discover') }}">Discover</a>
            </li>
            <li>
                <a href="{{ route('site.creatifny.show') }}">Shows</a>
            </li>
            <li>
                <a href="{{ route('site.creatifny.charts') }}">Charts</a>
            </li>
            <li>
                <a href="{{ route('site.creatifny.pricing') }}">Pricing</a>
            </li>
        </ul>

        @if(auth()->check())
            <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                    @if(isset( Auth::user()->name  )){{ Auth::user()->name }}@endif
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('forum/home') }}">Forums</a></li>
                    @role('Talents')
                        <li><a href="{{ route('talent.user.dashboard') }}">Profile</a></li>
                        <li><a href="{{ route('talent.events') }}">Events</a></li>
                        <li><a href="{{ route('subcription.info') }}">Subcription</a></li>
                        <li><a href="{{ route('talent.account.setting',['']) }}/@if(isset( Auth::user()->id )){{ Auth::user()->id }}@endif">Setting</a></li>
                        <li><a href="{{ route('talent.logout') }}">Log Out</a></li>
                    @else
                        <li><a href="{{ route('fan.user.dashboard') }}">Profile</a></li>
                        <li><a href="{{ route('fan.subcription.plan') }}">Subscription</a></li>
                        <li><a href="{{ route('fan.account.setting',['']) }}/@if(isset( Auth::user()->id )){{ Auth::user()->id }}@endif">Setting</a></li>
                        <li><a href="{{ route('fan.logout') }}">Log Out</a></li>
                    @endrole
                </ul>
            </li>
            </ul>
        @else
        
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ route('user.login') }}">Login</a>
                </li>
                <li>
                    <a href="{{ route('user.login') }}" class="btn-primary">Join For Free</a>
                </li>
            </ul>
        @endif

      </div>
    </nav>

    @yield('content')

    <section id="bottom" class="bg_clr">
        <div class="container fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="row">
                <div class="col-md-3">
                    @if(auth()->check())
                        @if(auth()->user()->plan_code == 'free')
                            <a class="footer-logo" href="{{ route('fan.user.dashboard') }}">
                                <img src="{{ asset('/theme/images/logo1.png') }}" style="max-width: 115px;max-height: 52px" alt="logo">
                            </a>
                        @else
                            <a class="footer-logo" href="{{ route('talent.user.dashboard') }}">
                                <img src="{{ asset('/theme/images/logo1.png') }}" style="max-width: 115px;max-height: 52px" alt="logo">
                            </a>
                        @endif                
                    @else
                        <a class="footer-logo" href="{{ route('site.dashboard') }}">
                            <img src="{{ asset('/theme/images/logo1.png') }}" style="max-width: 115px;max-height: 52px" alt="logo">
                        </a>
                    @endif
                    <div>
                    <ul class="display_flex">
                        <li class="margin_icons">
                            <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li class="margin_icons">
                            <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li class="margin_icons">
                            <a href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </li>
                        <li class="margin_icons">
                            <a href="https://www.skype.com/en/" target="_blank"><i class="fa fa-skype"></i></a>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="widget">
                                <h3 class="heading_clr">Creatifny</h3>
                                <ul>
                                    <li><a href="{{ route('site.creatifny.feature') }}">Feature</a></li>
                                    <li><a href="{{ route('site.creatifny.discover') }}">Discover</a></li>
                                    <li><a href="{{ route('site.creatifny.crowd_pick') }}">Crowd Picks</a></li>
                                    <li><a href="{{ route('site.creatifny.show') }}">Shows</a></li>
                                    <li><a href="{{ route('site.creatifny.charts') }}">Charts</a></li>
                                    <li><a href="{{ route('site.creatifny.pricing') }}">Pricing</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="widget">
                                <h3 class="heading_clr">Artist Chart</h3>
                                @if(isset($users))
                                <ul>
                                    @foreach($users as $user)
                                        <li><a href="{{ route('fan.view.talent.profile',[$user->id]) }}">{{ $user->name }}</a></li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="widget">
                                <h3 class="heading_clr">Information</h3>
                                <ul>
                                    <li><a href="{{ route('site.creatifny.about_us') }}">About us</a></li>
                                    <li><a href="{{ route('site.creatifny.conditions') }}">Terms & condition</a></li>
                                    <li><a href="{{ route('site.creatifny.privacy_policy') }}">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer" class="midnight-blue bg_clr">
        <div class="container">
            <div class="row text-center">
                <div class="col-sm-12">
                    &copy; {{ date('Y') }} <a href="{{ route('fan.user.dashboard') }}">Creatifny</a>. All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('/theme/js/jquery.js') }}"></script>
    <script src="{{ asset('/theme/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/theme/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('/theme/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/theme/js/jquery.isotope.min.js') }}"></script>
    <script src="{{ asset('/theme/js/main.js') }}"></script>
    <script src="{{ asset('/skin-1/assets/js/jquery.validate.min.js') }}"></script>
    @yield('js')
</body>
</html>