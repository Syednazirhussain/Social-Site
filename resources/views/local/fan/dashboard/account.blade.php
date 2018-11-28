@extends('local.dashboard_layout')

@section('css')

<style type="text/css">

    .blog_archieve li a {
        padding: 10px 0 !important;
    }

    .form-group button {
        font-size: 14px !important;
        padding: 10px 10px !important;
    }

    .navbar-inverse .navbar-nav>li>a{
        padding: 10px 17px;
        margin: 0px 17px;
    }

    .navbar-inverse .navbar-nav>li>a:hover{
        padding: 10px 17px;
        margin: 0px 17px;
    }

    .user-image{
        position: inherit;
    }

    .about_margin{
        margin-top: -20px;
    }

    .space-50{
        height: 50px;
    }

    .space-30{
        height: 30px;
    }

    .aside,.widget{
        padding: 10px !important;
    }

    .widget{
        margin-bottom: 0px;
    }

    .h2_margin{
        margin-top: 30px;
    }

    .pad_left{
        padding-left: 50px;
    }

    body{
        background-color: #fff;
    }

    .btn_clr{
        color: #fff;
        background-color: #EC5538;
    }

    .btn_clr:hover{
        color: #fff;
        background-color: #EC5538;
        border-color: #EC5538;
    }

    .widget.social_icon a{
        background-color: #fff;
        font-size: 25px;
    }

    .talent_btn{
        padding: 3px 15px;
        font-size: 12px;
        margin-left: 60px;
    }

    .block_btn{
        padding: 3px 15px;
        font-size: 12px;
        margin-left: 60px;
    }

    .errorTxt, .error { 
        color: #dc3545 !important;
        font-weight: unset !important;
    }
</style>

<style type="text/css">
    .errorTxt, .error { 
        color: #dc3545 !important;
        font-weight: unset !important;
    }
    .sty-summernote >  .form-group button {
        font-size: 14px !important;
        padding: 10px 10px !important;
    }
    .sty-summernote > .panel-default>.panel-heading, .panel{
          border: 1px solid #e6e6e6 !important;
    }
</style>

@endsection

@section('content')
<meta name="_token" content="{{ csrf_token() }}"/>

<section id="contact-page">
    <div class="container">
      <div class="m-t-4">
          <form action="{{ route('fan.account.update',$user->id) }}" enctype="multipart/form-data" class="form-horizontal" method="POST" id="account">
            <div class="row">
              <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="_method" value="PATCH">
              @include('flash::message')

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="col-md-6 col-lg-6">
                  <div class="fileinput fileinput-new" id="fileinput" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                  @if(isset($user))
                                    @if($user->image != null)
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
                            <input type="file" name="profile_image"></span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                          </div>
                    </div>  
                    <label class="control-label pull-left m-l-4" for="name">Profile Image</label>
                </div>

                <div class="col-md-6 col-lg-6">
                    <div class="fileinput fileinput-new" id="fileinput" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                  @if(isset($additional_info))
                                    @if($additional_info->cover_image != null)
                                      <img class="img-responsive" src="{{ asset('storage/users/'.$additional_info->cover_image ) }}" data-src="{{ asset('storage/users/'.$user->image) }}" alt="{{ $user->name}}" />
                                    @else
                                      <img class="img-responsive" src="{{ asset('storage/users/default_cover.png') }}" alt="{{ $user->name}}"/>
                                    @endif
                                  @else
                                      <img class="img-responsive" src="{{ asset('storage/users/default_cover.png') }}" alt="user"/>
                                  @endif
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                          <div>
                            <span class="btn btn-default btn-file">
                                <span class="fileinput-new">Select image</span>
                                <span class="fileinput-exists">Change</span>
                            <input type="file" name="cover_image"></span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                          </div>
                    </div> 
                    <label class="control-label pull-left m-l-4" for="name">Cover Image</label> 
                </div>
              </div>

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                      <label class="control-label" for="name">Name</label>
                      <input type="text" name="name" id="name" value="@if(isset($user)){{ $user->name }}@endif" class="form-control" placeholder="ex John Doe" >
                    </div> 
                </div>

                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                      <label class="control-label" for="phone">Phone</label>
                      <input type="text" name="phone" id="phone" value="@if(isset($user)){{ $user->phone }}@endif" class="form-control" placeholder="ex. 03xxxxxxxxx">
                    </div>
                </div>
              </div>
                
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                      <label class="control-label" for="linkdin">Linkdin</label>
                      <input type="text" name="linkdin" id="linkdin" value="@if(isset($additional_info)){{ $additional_info->linkdin }}@endif" class="form-control">
                    </div>
                </div>

                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                      <label class="control-label" for="instagram">Instagram</label>
                      <input type="text" name="instagram" id="instagram" value="@if(isset($additional_info)){{ $additional_info->instagram }}@endif" class="form-control">
                    </div>
                </div>
              </div>

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                      <label class="control-label" for="facebook">Facebook</label>
                      <input type="text" name="facebook" id="facebook" value="@if(isset($additional_info)){{ $additional_info->facebook }}@endif" class="form-control">
                    </div>
                </div>

                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                      <label class="control-label" for="twitter">Twitter</label>
                      <input type="text" name="twitter" id="twitter" value="@if(isset($additional_info)){{ $additional_info->twitter }}@endif" class="form-control">
                    </div>
                </div>
              </div>

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                      <label class="control-label" for="remail">Email</label>
                          <input type="email"  placeholder="ex john@example.com" id="remail" value="@if(isset($user)){{ $user->email }}@endif" name="remail" class="form-control">
                          <input type="hidden" id="compare_email" value="@if(isset($user)){{ $user->email }}@endif" >
                    </div>
                </div>

                <div class="col-md-6 col-lg-6">
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
              </div>

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="col-xs-12 col-sm-12 sty-summernote">
                    <div class="form-group">
                        <label for="description">About Us</label>
                        <input type="hidden" id="editDesc" value="@if(isset($additional_info)){{ $additional_info->about_us }}@endif">
                        <textarea id="description" name="about_us" required="required"></textarea>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-md-offset-11">
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </div>

            </div>

          </form>
    	</div>
    </div>
</section>

@endsection

@section('js')

<script type="text/javascript">
	

$(document).ready(function() {


	   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $('#description').val(  $('#editDesc').val() );

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
        'facebook': {
          url: true
        },
        'linkdin': {
          url: true
        },
        'twitter': {
          url: true
        },
        'instagram': {
          url: true
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



    // Initialize Summernote
    $(function() {
      $('#description').summernote({
        height:200,
        placeholder: 'Write something about us',
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




  });

/*
        callbacks: {
          onImageUpload: function(image) {
           var sizeKB = image[0]['size'] / 1000;
           var tmp_pr = 0;
           if(sizeKB > 200){
              tmp_pr = 1;
              alert("pls, select less then 200kb image.");
           }
           if(image[0]['type'] != 'image/jpeg' && image[0]['type'] != 'image/png'){
              tmp_pr = 1;
              alert("pls, select png or jpg image.");
           }
           if(tmp_pr == 1){
              var file = image[0];
              var reader = new FileReader();
              reader.onloadend = function() {
                var image = $('<img>').attr('src',  reader.result);
                $(this).summernote("insertNode", image[0]);
              }
              reader.readAsDataURL(file);
           }
          }
        }









        callbacks: {
          onImageUpload: function(files){ 
            console.log(files);
          },
          onImageUploadError: function() { console.log("Error uploading image"); }
        },
*/






</script>


@endsection