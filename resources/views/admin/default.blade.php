<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Social Site</title>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">
        <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link href="{{ asset('/skin-1/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/skin-1/assets/css/pixeladmin.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/skin-1/assets/css/widgets.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/skin-1/assets/css/themes/candy-orange.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/skin-1/assets/demo/demo.css') }}" rel="stylesheet">
        <link href="{{ asset('/skin-1/assets/css/custom.css') }}" rel="stylesheet">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js"></script>
        <link href="{{ asset('/skin-1/assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css') }}" rel="stylesheet">
        <script src="{{ asset('/skin-1/assets/pace/pace.min.js') }}"></script>
        <script src="{{ asset('/skin-1/assets/demo/demo.js') }}"></script>


        @yield('css') 
        <!-- holder.js -->
        <!-- Pace.js -->

        <!-- Custom styling -->
        <style>
            .page-header-form .input-group-addon,
            .page-header-form .form-control {
            background: rgba(0,0,0,.05);
            }
            .error{
            color: #FF0000;
            }
        </style>
        <!-- / Custom styling -->
    </head>
    <body>

  <nav class="px-nav px-nav-left">
        <button type="button" class="px-nav-toggle" data-toggle="px-nav">
          <span class="px-nav-toggle-arrow"></span>
          <span class="navbar-toggle-icon"></span>
          <span class="px-nav-toggle-label font-size-11">HIDE MENU</span>
        </button>

        <ul class="px-nav-content">
            <li class="px-nav-item">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="px-nav-icon  ion-ios-home"></i>
                    <span class="px-nav-label">Dashboard</span>
                </a>
            </li>
            <li class="px-nav-item px-nav-dropdown">
                <a href="javascript:void(0)">
                    <span class="px-nav-label">
                        <i class="fa fa-users"></i>&nbsp;Users
                    </span>
                </a>
                <ul class="px-nav-dropdown-menu">
                    <li class="px-nav-item">
                        <a href="{{ route('admin.users.index') }}">
                            <span class="px-nav-label">
                                <i class="fa fa-users"></i>&nbsp;Users
                            </span>
                        </a>   
                    </li>
                    @can('User Rigths')
                    <li class="px-nav-item">
                        <a href="{{ route('admin.roles.index') }}">
                            <span class="px-nav-label">
                                <i class="fa fa-user"></i>&nbsp;&nbsp;Roles
                            </span>
                        </a>
                    </li>
                    <li class="px-nav-item">
                        <a href="{{ route('admin.permissions.index') }}">
                            <span class="px-nav-label">
                                <i class="fa fa-hand-o-right"></i>&nbsp;&nbsp;Permissions
                            </span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li> 
            @can('Membership Managment')
            <li class="px-nav-item">
                <a href="{{ route('admin.memberShipPlans.index') }}">
                    <span class="px-nav-label">
                        <i class="fa fa-calendar-minus-o"></i>&nbsp;Member Ship Plans
                    </span>
                </a>
            </li>
            @endcan
            @hasanyrole('Admin|Web Master')
            <li class="px-nav-item px-nav-dropdown">
                <a href="javascript:void(0)">
                    <span class="px-nav-label">
                        <i class="fa fa-file-image-o"></i>&nbsp;Posts
                    </span>
                </a>
                <ul class="px-nav-dropdown-menu">
                    <li class="px-nav-item">
                        <a href="{{ route('admin.posts.index') }}">
                            <span class="px-nav-label">
                                <i class="fa fa-file-image-o"></i>&nbsp;Post
                            </span>
                        </a>   
                    </li>
                    <li class="px-nav-item">
                        <a href="{{ route('admin.postCategories.index') }}">
                            <span class="px-nav-label">
                                <i class="fa fa-file-image-o"></i>&nbsp;Post Category
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="px-nav-item">
                <a href="{{ route('admin.newsletter.index') }}">
                    <span class="px-nav-label">
                        <i class="fa fa-paper-plane-o"></i>&nbsp;Newsletters
                    </span>
                </a>
            </li>
            @endhasanyrole 
            @can('Settings')
            <li class="px-nav-item">
                <a href="{{ route('admin.setting.edit',[auth()->user()->id]) }}">
                    <span class="px-nav-label"><i class="fa fa-cog"></i>&nbsp;Setting</span>
                </a>
            </li> 
            @endcan
        </ul>
    </nav>

    <nav class="navbar px-navbar">
        <!-- Header -->
        <div class="navbar-header">
            <a class="navbar-brand px-demo-brand" href="{{route('admin.dashboard')}}"><span class="px-demo-logo bg-primary"><span class="px-demo-logo-1"></span><span class="px-demo-logo-2"></span><span class="px-demo-logo-3"></span><span class="px-demo-logo-4"></span><span class="px-demo-logo-5"></span><span class="px-demo-logo-6"></span><span class="px-demo-logo-7"></span><span class="px-demo-logo-8"></span><span class="px-demo-logo-9"></span></span>Social Site</a>
        </div>
        <!-- Navbar togglers -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#px-demo-navbar-collapse" aria-expanded="false"><i class="navbar-toggle-icon"></i></button>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="px-demo-navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('storage/users/'.Auth::user()->image) }}" alt="" class="px-navbar-image">
                        <span class="hidden-md">{{ ucfirst(Auth::user()->name) }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('admin.setting.edit',[auth()->user()->id]) }}">
                                <i class="dropdown-icon fa fa-wrench"></i>&nbsp;&nbsp;Account Settings
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('admin.logout') }}">
                                <i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>


        @yield('content')




        <!-- getting route for nav active -->
        <input type="hidden" name="currRoute" id="currRoute" value="{{url()->current()}}">


        <div class="m-t-4 p-b-4" id="empty-space"></div>
        <footer  class="px-footer px-footer-bottom text-center m-t-4 ">
            <span class="">Copyright © 2018 Stallyons. All rights reserved.</span>
        </footer>
        <!-- jQuery -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="{{ asset('/skin-1/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/skin-1/assets/js/pixeladmin.min.js') }}"></script>
        <script src="{{ asset('/skin-1/assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js') }}"></script>
        <script src="{{ asset('/skin-1/assets/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('/skin-1/assets/js/additional-methods.js') }}"></script>
        <script src="{{ asset('/skin-1/assets/js/custom.js') }}"></script>
        <script type="text/javascript">
            // -------------------------------------------------------------------------
            // Initialize DEMO

            $(function() {
              var file = String(document.location).split('/').pop();
              var currRoute = $('#currRoute').val();


              // Activate current nav item
              $('body > .px-nav')
                .find('.px-nav-item > a[href="' + currRoute + '"]')
                .parent()
                .addClass('active');

              $('body > .px-nav').pxNav();
              $('body > .px-footer').pxFooter();

            });
        </script>
        @yield('js') 
    </body>
</html>