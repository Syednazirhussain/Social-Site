<meta name="_token" content="{{ csrf_token() }}"/>


<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

@if(isset($user))
    <input name="_method" type="hidden" value="PATCH">
@endif


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
                    <input type="hidden" name="profile_image" id="logo-hidden" value="{{ $user->image }}">
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
      <label for="plan_code">Membership Plan</label>
      <select class="form-control" name="plan_code" id="plan_code">
        @if(isset($user))
          @foreach($memberships as $membership)
            @if($membership->code == $user->plan_code)
              <option value="{{ $membership->code }}" selected="selected">{{ $membership->name }}</option>
            @else
              <option value="{{ $membership->code }}" >{{ $membership->name }}</option>
            @endif
          @endforeach
        @else 
          @foreach($memberships as $membership)
            <option value="{{ $membership->code }}" >{{ $membership->name }}</option>
          @endforeach
        @endif
      </select>
    </div>
  </div>

  <div class="col-sm-12">
    <div class="col-sm-12 form-group">
      <label for="role">User Role</label>
      <select class="form-control" name="role" id="role">
        @if(isset($user))
          @foreach($roles as $role)
            @if($role->name == $myrole)
              <option value="{{ $role->name }}" selected="selected">{{ $role->name }}</option>
            @else
              @if($role->name != 'Admin')
              <option value="{{ $role->name }}" >{{ $role->name }}</option>
              @endif
            @endif
          @endforeach
        @else 
          @foreach($roles as $role)
            @if($role->name != 'Admin')
              <option value="{{ $role->name }}" >{{ $role->name }}</option>
            @endif
          @endforeach
        @endif
      </select>
    </div>
  </div>

  <div class="col-sm-12">
    <div class="col-sm-12 form-group">
      <label for="status">Status</label>
      <select type="text" name="status" id="status" class="form-control">
          @if(isset($user))
            @if($user->status == 'active')
                <option value="active" selected="selected">Active</option>
                <option value="inactive">In-Active</option>
            @else
                <option value="active">Active</option>
                <option value="inactive" selected="selected">In-Active</option>
            @endif
          @else
            <option value="active">Active</option>
            <option value="inactive">In-Active</option>
          @endif
      </select>
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
      <a href="{!! route('admin.users.index') !!}" class="btn btn-default"><i class="fa fa-times"></i> CANCEL</a>
    </div>
  </div>

</div>



@section('js')

  <script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });   
      
      // Initialize validator
      $('#userForm').validate({
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

      $(function() {
        $('#role').select2({
            placeholder: 'Select user role',
        });
      });

      $(function() {
        $('#status').select2({
            placeholder: 'Select status',
        });
      });

      $(function() {
        $('#plan_code').select2({
            placeholder: 'Select membership plan',
        });
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
