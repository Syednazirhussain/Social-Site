<meta name="_token" content="{{ csrf_token() }}"/>


<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

@if(isset($memberShipPlan))
    <input name="_method" type="hidden" value="PATCH">
@endif


<div class="row">

  <div class="col-sm-12">
    <div class="col-sm-12 form-group">
        <label for="name">Name</label>
        <input type="text"  placeholder="Enter name here" value="@if(isset($memberShipPlan)){{ $memberShipPlan->name }}@endif" name="name" class="form-control">
    </div>
  </div>

  <div class="col-sm-12">
    <div class="col-sm-12 form-group">
        <label for="code">Code</label>
        <input type="text"  placeholder="Enter code here" value="@if(isset($memberShipPlan)){{ $memberShipPlan->code }}@endif" name="code" class="form-control">
    </div>
  </div>

  <div class="col-sm-12">
    <div class="col-sm-12 form-group">
        <label for="price">Price</label>
        <input type="text"  placeholder="Enter price here" value="@if(isset($memberShipPlan)){{ $memberShipPlan->price }}@endif" name="price" class="form-control">
    </div>
  </div>

  <div class="col-sm-12">
    <div class="col-sm-12 form-group">
        <label for="status">Status</label>
        <select type="text" name="status" id="status" class="form-control">
            @if(isset($memberShipPlan))
              @if($memberShipPlan->status == 'active')
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



</div>

<div class="col-sm-12">
    <button type="submit" class="btn btn-primary">@if(isset($memberShipPlan)) <i class="fa fa-refresh"></i> UPDATE @else <i class="fa fa-plus"></i> ADD @endif</button>
    <a href="{!! route('admin.memberShipPlans.index') !!}" class="btn btn-default"><i class="fa fa-times"></i> CANCEL</a>
</div>

@section('js')

  <script type="text/javascript">  
      
      // Initialize validator
      $('#membership').validate({
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

      // Initialize Select2
      $(function() {
        $('#status').select2({
          placeholder: 'Select value',
        });
      });

  </script>


@endsection
