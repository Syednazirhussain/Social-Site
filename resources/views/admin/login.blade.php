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
        <link href="{{ asset('/skin-1/assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css') }}" rel="stylesheet">

        
        @yield('css') 

        <link href="{{ asset('/skin-1/assets/css/custom.css') }}" rel="stylesheet">
        <!-- holder.js -->
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js"></script>
        <!-- Pace.js -->
        <script src="{{ asset('/skin-1/assets/pace/pace.min.js') }}"></script>
        <script src="{{ asset('/skin-1/assets/demo/demo.js') }}"></script>
        
        <!-- Custom styling -->
        <style>
            .page-header-form .input-group-addon,
            .page-header-form .form-control {
            background: rgba(0,0,0,.05);
            }
        </style>
        <!-- / Custom styling -->

  <!-- Custom styling -->
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
      padding: 10% 0px;
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
  <!-- / Custom styling -->
</head>
<body>




  <!-- Sign In form -->
<section style="background-image: url('{{ asset('skin-1/assets/demo/bgs/7.jpg')  }}');">
  <div class="page-signin-container" id="page-signin-form" >
    <h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold color-white">SOCIAL SITE</h2>
    <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold  color-white">ADMIN LOGIN</h4>


  @if(Session::has('errorMsg'))
  <div class="alert alert-danger alert-dark">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ Session::get('errorMsg') }}</strong> 
  </div>
  @endif

    <form action="{{ route('admin.user.authenticate') }}" method="POST" class="panel p-a-4" id="loginForm">

      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <fieldset class=" form-group form-group-lg">
        <input type="text" name="email" class="form-control" placeholder="Email">
      </fieldset>

      <fieldset class=" form-group form-group-lg">
        <input type="password" name="password" class="form-control" placeholder="Password">
      </fieldset>


      <div class="clearfix">
        <a href="#" class="font-size-12 text-muted" id="page-signin-forgot-link">Forgot your password?</a>
      </div>


      <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">LOGIN</button>
    </form>

  </div>

  <!-- / Sign In form -->
</section>



  <!-- Reset form -->

  <div class="page-signin-container" id="page-signin-forgot-form">
    <h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold font-size-20">Password reset</h2>

    <form action="index.html" class="panel p-a-4">
      <fieldset class="form-group form-group-lg">
        <input type="email" class="form-control" placeholder="Your Email">
      </fieldset>

      <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Send password reset link</button>
      <div class="m-t-2 text-muted">
        <a href="#" id="page-signin-forgot-back">&larr; Back</a>
      </div>
    </form>
  </div>

  <!-- / Reset form -->

  <!-- ==============================================================================
  |
  |  SCRIPTS
  |
  =============================================================================== -->



        <!-- jQuery -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="{{ asset('/skin-1/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/skin-1/assets/js/pixeladmin.min.js') }}"></script>
        <script src="{{ asset('/skin-1/assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js') }}"></script>

        <script src="{{ asset('/skin-1/assets/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('/skin-1/assets/js/additional-methods.js') }}"></script>
        
        <script src="{{ asset('/skin-1/assets/js/custom.js') }}"></script>

        <script type="text/javascript">

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          
          // Initialize validator
          $('#loginForm').validate({
            focusInvalid: false,
            rules: {
              'login_id': {
                required: true,
                maxlength: 100,
              },
              'password': {
                required: true,
                minlength: 6,
                maxlength: 20,
              }
            },

            messages: {
              'login_id': {
                required: "Please enter username",
              },
              'password': {
                required: "Please enter password",
              }
            }

          });


      </script>

        @yield('js') 

        
</body>
</html>
