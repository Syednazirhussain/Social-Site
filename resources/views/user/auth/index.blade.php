@extends('user.default')

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
            <div class="status alert alert-success" style="display: none">
               @include('flash::message')
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    @include('user.auth.login')
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    @include('user.auth.register')
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