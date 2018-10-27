<meta name="_token" content="{{ csrf_token() }}"/>


<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

@if(isset($role))
    <input name="_method" type="hidden" value="PATCH">
@endif


<div class="row">

  <div class="col-sm-12">
    <div class="col-sm-12 form-group">
        <label>Name</label>
        <input type="text"  placeholder="Enter Name" value="@if(isset($role)){{ $role->name }}@endif" name="name" class="form-control">
    </div>
  </div>
  <input type="hidden" name="permissionArr" id="permissionArr">
  
  <div class="col-sm-12">
    <div class="col-sm-12 form-group">
      <label for="permission">Permissions</label>
      <select class="form-control" name="permission" id="permission" multiple>
        @if(isset($role))

          @foreach($permissions as $permission)
            <option  <?php foreach ($rolePermissions as $rolePermission) { if ($rolePermission == $permission->name) { echo "selected"; } } ?>   value="{{ $permission->name }}" >{{ $permission->name }}</option>
          @endforeach

        @else 

          @foreach($permissions as $permission)
            <option value="{{ $permission->name }}" >{{ $permission->name }}</option>
          @endforeach

        @endif
      </select>
          <label id="categoryIds-error" class="error" for="permission"></label>
    </div>
  </div>

</div>

<div class="col-sm-12">
    <button type="submit" class="btn btn-primary">@if(isset($role)) <i class="fa fa-refresh"></i> UPDATE @else <i class="fa fa-plus"></i> ADD @endif</button>
    <a href="{!! route('admin.roles.index') !!}" class="btn btn-default"><i class="fa fa-times"></i> CANCEL</a>
</div>

@section('js')

  <script type="text/javascript">  

      // Initialize validator
      $('#role').validate({
        rules: {
          'name': {
            required: true,
            maxlength: 191,
            minlength: 3
          },
          'permission': {
            required: true
          }
        },
        messages: {
          'name': {
            required: "Please enter name",
            minlength: jQuery.validator.format("At least {0} characters required!")
          },
          'permission': {
            required: "Please select atleat one permission"
          }
        }
      });

      $('#role').on('submit', function(e) {
        var permissionArr =  $('#permission').val();
        $('#permissionArr').val(permissionArr);
        return true;
      });
      

      // Initialize Select2
      $(function() {
        $('#permission').select2({
          placeholder: 'Select value',
        });
      });
  </script>


@endsection
