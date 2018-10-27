<meta name="_token" content="{{ csrf_token() }}"/>


<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

@if(isset($post))
    <input name="_method" type="hidden" value="PATCH">
@endif


<div class="row">

  <div class="col-sm-12 col-md-12">
    <div class="col-md-7">
      <div class="col-sm-12  form-group">
          <label for="title">Title</label>
          <input type="text" name="title" id="title" placeholder="Enter title here" class="form-control" value="@if(isset($post)){{ $post->title }}@endif">
      </div>
      <div class="col-sm-12 form-group">
          <label for="post_type">Post Type</label>
          <input type="text" name="post_type" id="post_type" class="form-control" placeholder="Enter post type here" value="@if(isset($post)){{ $post->post_type }}@endif">
      </div>
      <div class="col-sm-12 form-group">
        <label for="post_category_id"></label>
        <select type="text" name="post_category_id" id="post_category_id" class="form-control">
            @foreach($postCategorys as $postCategory)
              @if(isset($post))
                @if($post->post_category_id == $postCategory->id)
                  <option  value="{{ $postCategory->id }}" selected="selected">{{ $postCategory->name }}</option>
                @else
                  <option  value="{{ $postCategory->id }}">{{ $postCategory->name }}</option>
                @endif
              @else
                <option  value="{{ $postCategory->id }}">{{ $postCategory->name }}</option>
              @endif
            @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-5">
      <div class="form-group col-sm-12">
        <div class="pull-right fileinput fileinput-new" id="fileinput" data-provides="fileinput">
          <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                @if(isset($post))
                  @if($post->image != null)
                    <input type="hidden" name="profile_image" id="logo-hidden" value="{{ $post->image }}">
                    <img src="{{ asset('storage/posts/'.$post->image ) }}" data-src="{{ asset('storage/posts/'.$post->image) }}" alt="{{ $post->title}}" />
                  @else
                    <img src="{{ asset('storage/posts/default.png') }}" alt="{{ $post->title}}"/>
                  @endif
                @else
                    <img src="{{ asset('storage/posts/default.png') }}" alt="post"/>
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

  <div class="col-sm-12 col-md-12">
    <div class="col-md-12">
      <div class="col-sm-12  form-group">
        <label for="status">Status</label>
        <select type="text" name="status" id="status" class="form-control">
            @if(isset($post))
              @if($post->status == 'active')
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
    <div class="col-md-12">
          <div class="form-group">
              <label for="description">Description</label>
              <input type="hidden" id="editDesc" value="@if(isset($post)){{ $post->description }}@endif">
              <textarea id="description" name="description" required="required"></textarea>
          </div>
    </div>
  </div>

  <div class="col-sm-12 col-md-12">
    <div class="col-md-12">
      <div class="col-sm-12  form-group">
        <button type="submit" class="btn btn-primary">@if(isset($post)) <i class="fa fa-refresh"></i> UPDATE @else <i class="fa fa-plus"></i> ADD @endif</button>
        <a href="{!! route('admin.posts.index') !!}" class="btn btn-default"><i class="fa fa-times"></i> CANCEL</a>
      </div>
    </div>
  </div>
</div>

@section('js')

  <script type="text/javascript">

      //https://github.com/jasny/bootstrap/issues/334#issuecomment-383005685
      $('.fileinput').on("change.bs.fileinput", function (e) {
      var file = $(e.delegateTarget, $("form")).find('input[type=file]')[0].files[0];

          var fileExtension = file.name.split(".");
          fileExtension = fileExtension[fileExtension.length - 1].toLowerCase();

          var arrayExtensions = ["jpg", "jpeg", "png"];

          if (arrayExtensions.lastIndexOf(fileExtension) == -1) {
              alert('Only Images can be uploaded');
          }
          else {
              if (file["size"] >= 4194304 && (fileExtension == "jpg" || fileExtension == "jpeg" || fileExtension == "png")) {
                  alert('Max 2 MB of file size can be uploaded.');                 
                  $(this).fileinput('clear');
              }
          }  
      });


      var editPost = "{{ (isset($post))? $post->id : 0 }}";

      if(editPost)
      {
        $('#description').val($('#editDesc').val());
      }

        // Initialize validator
      $('#post').pxValidate({
          ignore: ":hidden:not(#description),.note-editable.panel-body",
          focusInvalid: false,
          rules: {
            'title':{
              required: true,
              alphanumeric: true,
              maxlength:40
            },
            'post_type': {
              required: true
            },
            'post_category_id': {
              required: true
            },
            'status': {
              required: true
            },
            'description': {
              required: true
            }
          },
          messages: {
            'title':{
              required: "Please enter title"
            },
            'description': {
              required: "Please enter the content above"
            }
          }
      }); 
      


      // Initialize Select2
      $(function() {
        $('#post_category_id').select2({
          placeholder: 'Select value',
        });
      });

      // Initialize Select2
      $(function() {
        $('#status').select2({
          placeholder: 'Select value',
        });
      });

    // Initialize Summernote
    $(function() {
      $('#description').summernote({
        height: 200,
        placeholder: 'Type description here..',
        toolbar: [
          ['parastyle', ['style']],
          ['fontstyle', ['fontname', 'fontsize']],
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
          ['insert', ['picture', 'link', 'video', 'table', 'hr']],
          ['history', ['undo', 'redo']],
          ['misc', ['codeview', 'fullscreen']],
          ['help', ['help']]
        ],
        disableResizeEditor: true
      });
    });

      jQuery.validator.addMethod("alphanumeric", function(value, element) {
              return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
      }, "Please enter alphabets only");

  </script>


@endsection
