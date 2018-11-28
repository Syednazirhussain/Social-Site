@extends('admin.auth.default')

@section('content')


<h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold color-white">SOCIAL SITE</h2>
<h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold  color-white">VERIFY PASSWORD</h4>


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

<form action="{{ route('admin.password.reset') }}" method="POST" class="panel p-a-4" id="verifyPassword">
  
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="user_id" value="@if(isset($user_id)){{ $user_id }}@endif">
  <fieldset class=" form-group form-group-lg">
    <input type="password" id="password" name="password" class="form-control" placeholder="Enter new password">
  </fieldset>

  <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Reset Password</button>

</form>

@endsection

@section('js')

    <script type="text/javascript">



    $('#verifyPassword').validate({
        focusInvalid: false,
        rules: {
          'password': {
            required: true,
            maxlength: 20,
            minlength: 6,
          },
        },
        messages: {
          'password': {
            required: "Please enter new password"
          }
        }
    });

  </script>

@endsection
