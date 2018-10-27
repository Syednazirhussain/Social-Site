<meta name="_token" content="{{ csrf_token() }}"/>


<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

@if(isset($postCategory))
    <input name="_method" type="hidden" value="PATCH">
@endif


<div class="row">
  <div class="col-sm-12">
    <div class="form-group">
        <label>Name</label>
        <input type="text"  placeholder="ex. Blog post" value="@if(isset($postCategory)){{ $postCategory->name }}@endif" name="name" class="form-control">
    </div>
  </div>
  <div class="col-sm-12">
    <div class="form-group">
        <label>Description</label>
        <textarea type="text"  placeholder="Enter description here" rows="6" name="description" class="form-control" style="resize: none">@if(isset($postCategory)){{ $postCategory->description }}@endif</textarea>
    </div>
  </div>
</div>

<div class="col-sm-12">
    <button type="submit" class="btn btn-primary">@if(isset($postCategory)) <i class="fa fa-refresh"></i> UPDATE @else <i class="fa fa-plus"></i> ADD @endif</button>
    <a href="{!! route('admin.postCategories.index') !!}" class="btn btn-default"><i class="fa fa-times"></i> CANCEL</a>
</div>

@section('js')

  <script type="text/javascript">  
      
      // Initialize validator
      $('#post_category').validate({
        focusInvalid: false,
        rules: {
          'name': {
            required: true,
            maxlength: 191,
            minlength: 3
          },
          'description': {
            required: true,
            maxlength: 191
          }
        },
        messages: {
          'name': {
            required: "Please enter name",
            minlength: jQuery.validator.format("At least {0} characters required!")
          },
          'description':{
            required: "Please enter description"
          }
        }
      });


  </script>


@endsection
