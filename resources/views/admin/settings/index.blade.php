@extends('admin.default')

@section('content')

<div class="px-content">
  <div class="page-header">
    <div class="row">
      <div class="col-md-4 text-xs-center text-md-left text-nowrap">
        <h1><i class="fa fa-cog"></i>&nbsp;Account Settings</h1>
      </div>
      <hr class="page-wide-block visible-xs visible-sm">
    </div>
  </div>

	<div class="row">
	    <div class="col-md-8 col-md-offset-2">
	   		@include('flash::message')
	        <div class="panel">
	            <div class="panel-body">
	                <form action="{{ route('admin.setting.update',[$user->id]) }}" method="POST" id="setting" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						 <input name="_method" type="hidden" value="PATCH">
						<div class="row">
						  <div class="col-sm-12">
						    <div class="col-sm-6">
						      <div class="form-group">
						        <label>Name</label>
						        <input type="text"  placeholder="ex. John Doe" value="@if(isset($user)){{ $user->name }}@endif" name="name" class="form-control">
						      </div>
						      <div class="form-group">
						        <label>Phone</label>
						        <input type="text" name="phone" id="phone"  placeholder="ex. 03xxxxxxxxx" value="@if(isset($user)){{ $user->phone }}@endif" class="form-control">
						      </div>
						    </div>
						    <div class="col-sm-6">
						      <div class="form-group">
						        <div class="pull-right fileinput fileinput-new" id="fileinput" data-provides="fileinput">
						          <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
						                @if(isset($user))
						                  @if($user->image != null)
						                    <input type="hidden" name="image" id="logo-hidden" value="{{ $user->image }}">
						                    <img src="{{ asset('storage/users/'.$user->image ) }}" data-src="{{ asset('storage/users/'.$user->image) }}" alt="{{ $user->name}}" />
						                  @else
						                    <img src="{{ asset('storage/users/default.png') }}" alt="{{ $user->name}}"/>
						                  @endif
						                @else
						                    <img src="{{ asset('storage/users/default.png') }}" alt="user"/>
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
						  </div>

						  <div class="col-sm-12">
						    <div class="col-sm-12 form-group">
						        <label>Email</label>
						        <input type="email"  placeholder="Enter email" id="email" value="@if(isset($user)){{ $user->email }}@endif" name="email" class="form-control">
						        <input type="hidden" id="compare_email" value="@if(isset($user)){{ $user->email }}@endif" >
						    </div>    
						  </div>

						  <div class="col-sm-12">
						    <div class="col-sm-12 form-group">
						        <label >Password</label> 
						        @if(isset($user))
						          <input type="password" id="password_id" name="password_edit" placeholder="Enter password"  class="form-control">
						          <p class="text-danger font-size-12"> * Leave it blank, if you don't want to change password.</p>
						        @else
						          <input type="password" id="password_id" name="password"  placeholder="Enter password"  class="form-control">
						        @endif
						    </div>    
						  </div>

						  <div class="col-sm-12">
						    <div class="col-sm-12 form-group">
						      <button type="submit" class="btn btn-primary">@if(isset($user)) <i class="fa fa-refresh"></i> UPDATE @else <i class="fa fa-plus"></i> ADD @endif</button>
						      <a href="{!! route('admin.dashboard') !!}" class="btn btn-default"><i class="fa fa-times"></i> CANCEL</a>
						    </div>
						  </div>
						</div>
	                </form>
	            </div>
	        </div>

	        @if ($errors->any())
	            <div class="alert alert-danger">
	                <ul>
	                    @foreach ($errors->all() as $error)
	                        <li>{{ $error }}</li>
	                    @endforeach
	                </ul>
	            </div>
	        @endif
	    </div>
	</div>


</div>

@endsection


@section('js')

  <script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });   
      
      // Initialize validator
      $('#setting').validate({
        focusInvalid: false,
        rules: {
          'name': {
            required: true,
            maxlength: 100,
            minlength: 3
          },
          'email': {
            required: true,
            email: true,
            maxlength: 50,
            minlength: 3,
              remote: {
                param: {
                  url: '{{ route("admin.user.email") }}',
                  type: "post",
                  dataType : "json",
                  data: {
                    email: function() {
                      return $( "#email" ).val();
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
          'email': {
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