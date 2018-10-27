@extends('user.dashboard_layout')

@section('css')

<style type="text/css">
    .errorTxt, .error { 
        color: #dc3545 !important;
        font-weight: unset !important;
    }
</style>

@endsection

@section('content')
<meta name="_token" content="{{ csrf_token() }}"/>

<section id="contact-page">
    <div class="container">
    	<div class="row">
    		<form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ route('user.account.setting',$user->id) }}" id="account">
				<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="_method" value="PATCH">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset">
          @include('flash::message')
			    <div class="col-xs-12 col-sm-12 col-md-6 pull-right">
						<div class="fileinput fileinput-new" id="fileinput" data-provides="fileinput">
					          <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
					                @if(isset($user))
					                  @if($user->image != null)
					                    <input type="hidden" name="profile_image" id="logo-hidden" value="{{ $user->image }}">
					                    <img class="img-responsive" src="{{ asset('storage/users/'.$user->image ) }}" data-src="{{ asset('storage/users/'.$user->image) }}" alt="{{ $user->name}}" />
					                  @else
					                    <img class="img-responsive" src="{{ asset('storage/users/default.png') }}" alt="{{ $user->name}}"/>
					                  @endif
					                @else
					                    <img class="img-responsive" src="{{ asset('storage/users/default.png') }}" alt="user"/>
					                @endif
					          </div>
				          	<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
				          <div>
				            <span class="btn btn-default btn-file">
				                <span class="fileinput-new">Select image</span>
				                <span class="fileinput-exists">Change</span>
				            <input type="file" name="pic"></span>
				            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
				          </div>
				        </div>     
			       	</div> 				
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
					<div class="col-sm-12 col-md-12">
						<div class="form-group">
							<label class="control-label" for="name">Name</label>
							<input type="text" name="name" id="name" value="@if(isset($user)){{ $user->name }}@endif" class="form-control" placeholder="ex John Doe" >
						</div>						
					</div>
					<div class="col-sm-12 col-md-12">
						<div class="form-group">
							<label class="control-label" for="phone">Phone</label>
							<input type="text" name="phone" id="phone" value="@if(isset($user)){{ $user->phone }}@endif" class="form-control" placeholder="ex. 03xxxxxxxxx">
						</div>
					</div>
					<div class="col-sm-12 col-md-12">
						<div class="form-group">
							<label class="control-label" for="remail">Email</label>
					        <input type="email"  placeholder="ex john@example.com" id="remail" value="@if(isset($user)){{ $user->email }}@endif" name="remail" class="form-control">
					        <input type="hidden" id="compare_email" value="@if(isset($user)){{ $user->email }}@endif" >
						</div>
					</div>
					<div class="col-sm-12 col-md-12">
						<div class="form-group">
							<label class="control-label" for="password">Password</label>
					        @if(isset($user))
					          <input type="password" id="password_id" name="password_edit" placeholder="Enter password"  class="form-control">
					          <p class="text-danger font-size-12"> * Leave it blank, if you don't want to change password.</p>
					        @else
					          <input type="password" id="password_id" name="password"  placeholder="Enter password"  class="form-control">
					        @endif
						</div>	
					</div>
					<div class="col-sm-12 col-md-2 col-md-offset-9">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div> 
			</form>   		
    	</div>
    </div>
</section>

@endsection

@section('js')

<script type="text/javascript">
	
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

      $('#account').validate({
        rules: {
          'name': {
            required: true,
            maxlength: 40,
            minlength: 3
          },
          'remail': {
          	required: true,
          	email: true,
          	remote: {
                param: {
                  url: '{{ route("user.email.verify") }}',
                  type: "post",
                  dataType : "json",
                  data: {
                    email: function() {
                      return $( "#remail" ).val();
                    }
                  },                         
                  dataFilter: function(response) {
                    return checkField(response);
                  }
              },
              depends: function(element) {
                // compare email address in form to hidden field
                return ( $(element).val() !== $('#compare_email').val() );
              }
             }
        	},
          'phone': {
            required: true,
            minlength: 11,
            maxlength: 15,
            digits: true
          },
          'password': {
          	required: true,
          	minlength:6,
          	maxlength: 20
          }
        },
        messages: {
          'name': {
            required: "Please enter name",
            minlength: jQuery.validator.format("At least {0} characters required!")
          },
          'remail': {
            required: "Please enter your email",
            remote : "Email already in use"
          },
          'phone': {
            required: "Please enter phone number"
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