<meta name="_token" content="{{ csrf_token() }}"/>


<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

@if(isset($user))
    <input name="_method" type="hidden" value="PATCH">
@endif


<div class="row">
  <div class="col-sm-12">
    <div class="col-sm-12 form-group">
        <label>Name</label>
        <input type="text"  placeholder="Enter Name" value="@if(isset($user)){{ $user->name }}@endif" name="name" class="form-control">
    </div>
    <div class="col-sm-12 form-group">
      <label for="role">User Role</label>
      <select class="form-control" name="role" id="role">
        @if(isset($user))
          @foreach($roles as $role)
            @if($role->name == $myrole)
              <option value="{{ $role->name }}" selected="selected">{{ $role->name }}</option>
            @else
              <option value="{{ $role->name }}" >{{ $role->name }}</option>
            @endif
          @endforeach
        @else 
          @foreach($roles as $role)
            <option value="{{ $role->name }}" >{{ $role->name }}</option>
          @endforeach
        @endif
      </select>
    </div>
    <div class="col-sm-12 form-group">
        <label>Email</label>
        <input type="email"  placeholder="Enter email" id="email" value="@if(isset($user)){{ $user->email }}@endif" name="email" class="form-control">
        <input type="hidden" id="compare_email" value="@if(isset($user)){{ $user->email }}@endif" >
    </div>
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
</div>

<div class="col-sm-12">
    <button type="submit" class="btn btn-primary">@if(isset($user)) <i class="fa fa-refresh"></i> UPDATE @else <i class="fa fa-plus"></i> ADD @endif</button>
    <a href="{!! route('admin.users.index') !!}" class="btn btn-default"><i class="fa fa-times"></i> CANCEL</a>
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
