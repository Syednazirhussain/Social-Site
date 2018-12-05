@extends('local.default')

@section('css')
<style type="text/css">
    .errorTxt, .error { 
            color: #dc3545 !important;
            font-weight: unset !important;
        }
</style>

@endsection

@section('content')

<div class="page-title" style='background-image: url("{{ asset("/theme/images/page-title.png") }}")'>
    <h1>Login&nbsp;/&nbsp;Register</h1>
</div>


<section id="contact-page">
    <div class="container"> 
        <div class="row contact-wrap"> 
            @if(Session::has('errorMsg'))
                <div class="alert alert-danger alert-dark">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ Session::get('errorMsg') }}</strong>
                    @if(Session::has('sendMail'))
                      <a href="{{ Session::get('sendMail') }}">Send Again</a>
                    @endif
                </div>
            @endif
            @if(Session::has('successMsg'))
              <div class="alert alert-success alert-dismissable" style="text-align: center;">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <h4 class="m-t-0 m-b-0"><strong><i class="fa fa-check-circle fa-lg"></i>&nbsp;&nbsp;{{ Session::get('successMsg') }}</strong></h4>
              </div>
            @endif
            
            <div class="col-lg-12 col-md-12">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 col-md-offset-1">
                    @include('local.auth.login')
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 col-md-offset-1">
                    @include('local.auth.register')
                </div>
            </div>

        </div>
    </div>
</section>

@endsection


@section('js')

<script type="text/javascript">
  $('#login').validate({
    focusInvalid: false,
    rules: {
      'email': {
        required: true,
        email: true,
        maxlength: 100,
      },
      'password': {
        required: true,
        minlength: 6,
        maxlength: 20,
      }
    },
    messages: {
      'email': {
        required: "Enter your email",
      },
      'password': {
        required: "Enter your password",
      }
    }
  });
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#signup').validate({
        focusInvalid: false,
        rules: {
          'name': {
            required: true,
            maxlength: 100,
            minlength: 3
          },
          'remail': {
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
                      return $( "#remail" ).val();
                    }
                  },                         
                  dataFilter: function(response) {
                    return checkField(response);
                  }
              }
            }
          },
          'password': {
            required: true,
            maxlength: 20,
            minlength: 6,
          },
          'phone':{
            required: true,
            minlength: 11,
            maxlength:15,
            digits: true
          }
        },
        messages: {
          'name': {
            required: "Please enter name",
            minlength: jQuery.validator.format("At least {0} characters required!")
          },
          'remail': {
            required: "Please enter user email",
            remote : "Email already in use"
          },
          'phone':{
            required: "Please enter phone no"
          },
          'password': {
            required: "Please enter password"
          }
        }
    });
    checkField = function(response) {
        switch ($.parseJSON(response).code) {
            case 200:
                return "true"; // <-- the quotes are important!
            case 401:
                //alert("Sorry, our system has detected that an account with this email address already exists.");
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