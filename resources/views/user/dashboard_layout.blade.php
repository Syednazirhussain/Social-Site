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


    <link href="{{ asset('/skin-1/assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('/theme/images/artist.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('/theme/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('/theme/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('/theme/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('/theme/images/ico/apple-touch-icon-57-precomposed.png') }}">

    @yield('css')
</head>
<body>
    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="top-number">
                            <p><i class="fa fa-phone-square"></i> +0123 456 70 90</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="social">
                            <ul class="social-share">
                                <li>
                                    <a href="{{ route('user.account.setting',auth::user()->id) }}" title="Account Setting"><i class="fa fa-cog"></i></a>
                                    <a href="{{ route('user.logout') }}" title="Log Out"><i class="fa fa-power-off"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('user.dashboard') }}">
                        <img src="{{ asset('/theme/images/creatifny.png') }}" style="max-width: 115px;max-height: 52px" alt="logo">
                    </a>
                </div>

                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="javascript:void(0)">Famous Post</a></li>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Artist&nbsp;<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)">Musician</a></li>
                                <li><a href="javascript:void(0)">Singers</a></li>
                                <li><a href="javascript:void(0)">Painters</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Subcription</a></li>
                    </ul>
                </div>
            </div>
            <!--/.container-->
        </nav>
        <!--/nav-->
    </header>
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
    <script src="{{ asset('/skin-1/assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js') }}"></script>
    <script src="{{ asset('/skin-1/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/skin-1/assets/js/pixeladmin.min.js') }}"></script>
   
    @yield('js')
</body>
</html>