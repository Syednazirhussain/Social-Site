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
            margin-left: 25px !important;
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
            <a class="navbar-brand" href="{{ route('site.dashboard') }}">
                <img src="{{ asset('/theme/images/logo1.png') }}" style="max-width: 115px;max-height: 52px" alt="logo">
            </a>
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
                <a href="javascript:void(0)">Charts</a>
            </li>
            <li>
                <a href="javascript:void(0)">Opportunities</a>
            </li>
            <li>
                <a href="javascript:void(0)">Pricing</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="{{ route('user.login') }}">Login</a>
            </li>
            <li>
                <a href="{{ route('user.login') }}" class="btn btn-primary">Join For Free</a>
            </li>
        </ul>
      </div>
    </nav>

    @yield('content')
    
    <footer id="footer" class="midnight-blue bg_clr">
        <div class="container">
            <div class="row text-center">
                <div class="col-sm-12">
                    &copy; 2018 <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">Creatifny</a>. All Rights Reserved.
                </div>
                <!-- <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="javascript:void(0)">Home</a></li>
                        <li><a href="javascript:void(0)">About Us</a></li>
                        <li><a href="javascript:void(0)">Faq</a></li>
                        <li><a href="javascript:void(0)">Contact Us</a></li>
                    </ul>
                </div> -->
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
    <script src="{{ asset('/skin-1/assets/js/jquery.validate.min.js') }}"></script>
    @yield('js')
</body>
</html>