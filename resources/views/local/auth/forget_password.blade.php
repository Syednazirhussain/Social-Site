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
    <h1>Forget Password</h1>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">

<section id="contact-page">
    <div class="container"> 
        <div class="row contact-wrap"> 
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

            <div class="col-sm-12 col-md-4 col-md-offset-4 form-containner">
              <form action="{{ route('user.password.request') }}" method="POST" class="form-horizontal" id="forgetPassword">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <label class="control-label" for="">Email</label>
                  <input type="text" name="email" id="email" placeholder="john@example.com" class="form-control">
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
          'email': {
            required: true,
            email: true,
            maxlength: 50,
            minlength: 3,
            remote: {
                param: {
                  url: '{{ route("user.email.verify") }}',
                  type: "post",
                  dataType : "json",
                  data: {
                    remail: function() {
                      return $( "#email" ).val();
                    }
                  },                         
                  dataFilter: function(response) {
                    return checkField(response);
                  }
              }
            }
          },
        },
        messages: {
          'email': {
            required: "Please enter user email",
            remote : "Email cannot found"
          }
        }
    });



    checkField = function(response) {
        switch ($.parseJSON(response).code) {
            case 200:
                return false; // <-- the quotes are important!
            case 401:
                  return true;
                break;
            case undefined:
                alert("An undefined error occurred.");
                break;
            default:
                alert("An undefined error occurred");
                break;
        }
        return false;
    };




    
</script>


@endsection