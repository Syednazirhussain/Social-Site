<meta name="_token" content="{{ csrf_token() }}"/>


<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

@if(isset($permission))
    <input name="_method" type="hidden" value="PATCH">
@endif


<div class="row">
  <div class="col-sm-12">
    <div class="col-sm-12 form-group">
        <label>Name</label>
        <input type="text"  placeholder="Enter Name" value="@if(isset($permission)){{ $permission->name }}@endif" name="name" class="form-control">
    </div>
  </div>
</div>

<div class="col-sm-12">
    <button type="submit" class="btn btn-primary">@if(isset($permission)) <i class="fa fa-refresh"></i> UPDATE @else <i class="fa fa-plus"></i> ADD @endif</button>
    <a href="{!! route('admin.permissions.index') !!}" class="btn btn-default"><i class="fa fa-times"></i> CANCEL</a>
</div>

@section('js')

  <script type="text/javascript">  
      
      // Initialize validator
      $('#permission').validate({
        focusInvalid: false,
        rules: {
          'name': {
            required: true,
            maxlength: 191,
            minlength: 3
          }
        },
        messages: {
          'name': {
            required: "Please enter name",
            minlength: jQuery.validator.format("At least {0} characters required!")
          }
        }
      });


  </script>


@endsection
