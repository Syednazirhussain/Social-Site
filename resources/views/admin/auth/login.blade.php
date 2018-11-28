@extends('admin.auth.default')

@section('content')


<h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold color-white">SOCIAL SITE</h2>
<h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold  color-white">ADMIN LOGIN</h4>


  @if(Session::has('errorMsg'))
      <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ Session::get('errorMsg') }}</strong> 
      </div>
  @endif
  @if(Session::has('successMsg'))
    <div class="alert alert-success alert-dismissable" style="text-align: center;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <h4 class="m-t-0 m-b-0"><strong><i class="fa fa-check-circle fa-lg"></i>&nbsp;&nbsp;{{ Session::get('successMsg') }}</strong></h4>
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
    <a href="{{ route('admin.forget.password') }}" class="text-primary">Forgot password</a>
  </div>
  <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">LOGIN</button>
</form>

@endsection

@section('js')

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

@endsection
