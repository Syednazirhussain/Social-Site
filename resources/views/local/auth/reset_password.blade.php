@extends('local.default')

@section('css')
<style type="text/css">
    .errorTxt, .error { 
            color: #dc3545 !important;
            font-weight: unset !important;
        }
    .form-containner {
        margin-top: 37px;
        margin-bottom: 37px;
    }
</style>

@endsection

@section('content')

<div class="page-title" style='background-image: url("{{ asset("/theme/images/page-title.png") }}")'>
    <h1>Reset Password</h1>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">

<section id="contact-page">
    <div class="container"> 
        <div class="row contact-wrap"> 
            <div class="status alert alert-success" style="display: none">
            </div>
            @if(Session::has('errorMsg'))
                <div class="alert alert-danger alert-dark">
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


            <div class="col-sm-12 col-md-4 col-md-offset-4 form-containner">

              <form action="{{ route('reset.password') }}" method="POST" class="form-horizontal" id="forgetPassword">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="@if(isset($user_id)){{ $user_id }}@endif">
                <div class="form-group">
                  <label class="control-label" for="">Reset Password</label>
                  <input type="text" name="password" id="password" placeholder="Enter your new password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Reset Password</button> 
              </form>
            </div>

        </div>
    </div>
</section>

@endsection


@section('js')

<script type="text/javascript">



    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#forgetPassword').validate({
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