<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Creatifny</title>
    
    <link href="{{ asset('/skin-1/assets/css/pixeladmin.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/theme/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/css/icomoon.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/css/profile.css') }}" rel="stylesheet">

    <link href="{{ asset('/skin-1/assets/css/pixeladmin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/skin-1/assets/css/widgets.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/skin-1/assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/skin-1/assets/css/themes/candy-orange.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/skin-1/assets/fileuploader/src/jquery.fileuploader.css') }}" media="all" rel="stylesheet">
    <link href="{{ asset('/skin-1/assets/fileuploader/css/jquery.fileuploader-theme-thumbnails.css') }}" media="all" rel="stylesheet">
    <link href="{{ asset('/skin-1/assets/calender/calender-css.css') }}" media="all" rel="stylesheet">



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
            padding-bottom: 5px !important;
        }

        .navbar-nav {
             margin-top: unset !important; 
        }

        .navbar-inverse .navbar-nav>li>a {
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
            @role('Talents')
            <a class="navbar-brand" href="{{ route('talent.user.dashboard') }}">
                <img src="{{ asset('/theme/images/logo1.png') }}" style="max-width: 115px;max-height: 52px" alt="logo">
            </a>
            @else
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="{{ asset('/theme/images/logo1.png') }}" style="max-width: 115px;max-height: 52px" alt="logo">
            </a>
            @endrole
        </div>
        <ul class="nav navbar-nav">
            <li>
                <a href="javascript:void(0)">Feature</a>
            </li>
            <li>
                <a href="javascript:void(0)">Discover</a>
            </li>
            <li>
                <a href="javascript:void(0)">Crowd Picks</a>
            </li>
            <li>
                <a href="javascript:void(0)">Shows</a>
            </li>
            <li>
                <a href="{{ route('talent.list') }}">Charts</a>
            </li>
            <li>
                <a href="javascript:void(0)">Opportunities</a>
            </li>
            <li>
                <a href="javascript:void(0)">Pricing</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                    @if(isset( Auth::user()->name  )){{ Auth::user()->name }}@endif
                </a>
                <ul class="dropdown-menu">
                    @role('Talents')
                        <li><a href="{{ route('talent.user.dashboard') }}">Profile</a></li>
                        <li><a href="javascript:void(0)">Cancel Subcription</a></li>
                    @else
                        <li><a href="javascript:void(0)">Profile</a></li>
                        <li><a href="{{ route('user.membership.pricing') }}">Subscription</a></li>
                    @endrole

                    <li><a href="{{ route('user.account.setting',['']) }}/@if(isset( Auth::user()->id )){{ Auth::user()->id }}@endif">Setting</a></li>
                    <li><a href="{{ route('user.logout') }}">Log Out</a></li>
                </ul>
            </li>
        </ul>
      </div>
    </nav>

    @yield('content')
    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2013 <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">ShapeBootstrap</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li><a href="javascript:void(0)">About Us</a></li>
                        <li><a href="javascript:void(0)">Faq</a></li>
                        <li><a href="javascript:void(0)">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!--/#footer-->
    <script src="{{ asset('/theme/js/jquery.js') }}"></script>
    <script src="{{ asset('/theme/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/theme/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('/theme/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/theme/js/jquery.isotope.min.js') }}"></script>
    <script src="{{ asset('/theme/js/main.js') }}"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('/skin-1/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/skin-1/assets/js/pixeladmin.min.js') }}"></script>
    <script src="{{ asset('/skin-1/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/skin-1/assets/js/custom.js') }}"></script>

    <script src="{{ asset('/skin-1/assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js') }}"></script>
    <script src="{{ asset('/skin-1/assets/fileuploader/src/jquery.fileuploader.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/skin-1/assets/fileuploader/js/custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/skin-1/assets/calender/calender-js.js') }}" type="text/javascript"></script>

    @yield('js')
</body>
</html>