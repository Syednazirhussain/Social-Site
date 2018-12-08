<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        
        <title>Creatifny</title>
        <link rel="shortcut icon" href="{{ asset('/theme/images/lock.png') }}">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">
        <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link href="{{ asset('/skin-1/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/skin-1/assets/css/pixeladmin.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/skin-1/assets/css/widgets.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/skin-1/assets/css/themes/candy-orange.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/skin-1/assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css') }}" rel="stylesheet">


        <link href="{{ asset('/skin-1/assets/css/custom.css') }}" rel="stylesheet">
        <!-- holder.js -->
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js"></script>
        <!-- Pace.js -->
        <script src="{{ asset('/skin-1/assets/pace/pace.min.js') }}"></script>
        <script src="{{ asset('/skin-1/assets/demo/demo.js') }}"></script>
        

        <style>
            .page-header-form .input-group-addon,
            .page-header-form .form-control {
            background: rgba(0,0,0,.05);
            }
        </style>

        <style>
          .page-signin-header {
            box-shadow: 0 2px 2px rgba(0,0,0,.05), 0 1px 0 rgba(0,0,0,.05);
          }

          .page-signin-header .btn {
            position: absolute;
            top: 12px;
            right: 15px;
          }

          html[dir="rtl"] .page-signin-header .btn {
            right: auto;
            left: 15px;
          }

          .page-signin-container {
            width: auto;
            margin: 0px 10px;
            padding: 7% 0px;
          }

          .page-signin-container form {
            border: 0;
            box-shadow: 0 2px 2px rgba(0,0,0,.05), 0 1px 0 rgba(0,0,0,.05);
          }

          @media (min-width: 544px) {
            .page-signin-container {
              width: 350px;
              margin: 0px auto;
            }
          }
          #page-signin-forgot-form { display: none; }
        </style>

        @yield('css') 

    </head>
<body>


<section style="background-image: url('{{ asset('skin-1/assets/demo/bgs/7.jpg')  }}');">

  <div class="page-signin-container" id="page-signin-form" >
    @yield('content') 
  </div>
  <div class="m-t-4 p-b-4" id="empty-space"></div>
  <footer  class="px-footer px-footer-bottom text-center m-t-4 ">
      <span class="">Copyright © <?php echo date('Y'); ?> <a href="{{ route('site.dashboard') }}">Creatifny.</a> All rights reserved.</span>
  </footer>
</section>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('/skin-1/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/skin-1/assets/js/pixeladmin.min.js') }}"></script>
<script src="{{ asset('/skin-1/assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js') }}"></script>

<script src="{{ asset('/skin-1/assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/skin-1/assets/js/additional-methods.js') }}"></script>

<script src="{{ asset('/skin-1/assets/js/custom.js') }}"></script>

  @yield('js') 

        
</body>
</html>