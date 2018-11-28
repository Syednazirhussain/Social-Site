@extends('admin.auth.default')

@section('content')


<h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold color-white">SOCIAL SITE</h2>
<h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold  color-white">FORGET PASSWORD</h4>


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

<form action="{{ route('admin.password.request') }}" method="POST" class="panel p-a-4" id="forgetPassword">
  
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  
  <fieldset class=" form-group form-group-lg">
    <input type="text" id="email" name="email" class="form-control" placeholder="Enter your email">
  </fieldset>

  <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Send Password</button>

</form>

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
