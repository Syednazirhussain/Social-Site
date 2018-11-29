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

    .tabbable-line > .nav-tabs > li.active > a {
        color: #fff !important;
    }

    .tabbable-line > .nav-tabs > li.active {
        background: #eb613e !important;
    }
    .widget-activity-item {
        padding: 12px 5px 10px 45px !important;
    }

    .panel{
        background-color: #fff !important;
    }
    .panel-footer {
        border-top-color: rgb(255, 255, 255) !important;
        background-color: #fff !important;
    }

    .videos-list-item {
        width: 32.33%;
        display: inline-block;
        margin: 0px 5px 15px 0px;
        position: relative;
    }

    .video_date{
        position: absolute;
        z-index: 9;
        background: #eb613e;
        color: white;
        font-size: 9px;
        right: 0px;
        top: 0px;
        padding: 0px 10px;
    }

    .post_vedio_author{
        font-size: 17px;
        color: #eb613e;
    }
</style>

@endsection



@section('content')

<!-- https://bootsnipp.com/snippets/1e9Zq -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="main-secction">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 image-section">
            @if($user->additional_info->cover_image != null)
                <img src="{{ asset('storage/users/'.$user->additional_info->cover_image ) }}">
            @else
                <img src="https://png.pngtree.com/thumb_back/fw800/back_pic/00/08/57/41562ad4a92b16a.jpg">
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="pull-left">
                <div class="user-image text-center">
                    <img src="{{ asset('storage/users/'.$user->image) }}" class="img-thumbnail img-custom">
                </div>

                <div class="pad_left">
                    <h2 class="h2_margin">{{ $user->name }}</h2>
                    <h5 class="h2_margin">Developer</h5>
                </div>

                <div style="margin-top:20px">
                    <div class="pad_left">
                        <p class="text-muted font-13">
                            <strong>Mobile :</strong>
                            <span class="m-l-15">{{ $user->phone }}</span>
                        </p>
                        <p class="text-muted font-13">
                            <strong>Email :</strong>
                             <span class="m-l-15">{{ $user->email }}</span>
                        </p>
                    </div>
                </div>
                <div class="about_margin pad_left">
                    <div class="card" style="width: 30rem;">
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="space-50"></div>
            <div class="tabbable-panel">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#article" data-toggle="tab">
                                Article
                            </a>
                        </li>
                        <li>
                            <a href="#overview" data-toggle="tab">
                                Overview
                            </a>
                        </li>
                        <li>
                            <a href="#photo" data-toggle="tab">
                                Photos
                            </a>
                        </li>
                        <li>
                            <a href="#video" data-toggle="tab">
                                Videos
                            </a>
                        </li>
                        <li>
                            <a href="#event" data-toggle="tab">
                                Events
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content"> 
                        <div id="msg"></div>    
                        <div class="tab-pane active" id="article">
                            <div class="row">
                                    @hasanyrole('Talents|Web Master|Admin')
                                    <div class="col-sm-12 col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">Post an article</div>
                                            </div>
                                            <form id="post-article" method="POST">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="form-group col-sm-12">
                                                            <label for="post_category" class="control-label">Select Post Type</label>
                                                            <select type="text" name="post_category" id="post_category" class="form-control">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-12">
                                                            <label class="control-label">Message</label>
                                                            <textarea id="post_article" name="article" style="display: none;"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-footer text-right">
                                                    <button type="submit" id="articleSubmit" class="btn btn-primary">Post</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @endhasanyrole
                                    <div class="col-sm-12 col-md-12">
                                        <div class="panel">
                                            <div id="posts"></div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="overview">
                            @if(isset($additional_info))
                                @if($additional_info->about_us != null)
                                    {{ $additional_info->about_us }}
                                @else
                                    <p class="lead"><em>Write some thing about us</em></p>
                                @endif
                            @endif
                        </div>
                        <div class="tab-pane" id="photo">
                            <div class="row">
                                @hasanyrole('Talents|Web Master|Admin')
                                <div class="col-sm-12 col-md-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">Post Albums</div>
                                        </div>
                                        <form action="{{ route('add.multiple.images') }}" method="POST" id="post-image-form" enctype="multipart/form-data">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="form-group col-sm-12">
                                                        <label for="">Gallery</label>
                                                        <input type="file" id="file" name="images" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer text-right">
                                                <button type="submit" id="imagesSubmit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endhasanyrole
                                <div class="col-sm-12 col-md-12">
                                    <div id="post-images"></div>  
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="video">
                            <div class="m-a-2 p-a-3">
                                <div class="row">
                                    @hasanyrole('Talents|Web Master|Admin')
                                    <div class="col-sm-12 col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">Upload Vedio</div>
                                            </div>
                                            <form action="{{ route('add.single.vedio') }}" method="POST" id="post_vedio">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <label class="control-label">Title</label>
                                                            <input type="text" id="video_title" class="form-control" style="height: 30px !important" name="title" placeholder="ex Picnic">
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label class="control-label">Type</label>
                                                            <select class="form-control" name="vedio_type" id="vedio_type">
                                                                <option value="youtube">Youtube</option>
                                                                <option value="dailymotion">Daily motion</option>
                                                                <option value="vimeo">Vimeo</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-12">
                                                            <label class="control-label">URL</label>
                                                            <input type="text" class="form-control" style="height: 30px !important" id="vedio_url" name="vedio_url" placeholder="ex https://youtu.be/cH6kxtzovew">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-footer text-right">
                                                    <button type="submit" id="videoSubmit" class="btn btn-primary">Add</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @endhasanyrole
                                    <div class="col-sm-12 col-md-12">
                                        <div id="post-video"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="event">
                            @hasanyrole('Talents|Web Master|Admin')
                            <div id='calendar'></div>
                            @endhasanyrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vedio -->
        <div class="modal fade" id="vedioModal" role="dialog">
            <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                @hasanyrole('Talents|Web Master|Admin')
                                <a href="javascript:void(0)" id="remove_post_video" data-post-id="" class="label label-danger">
                                    <i class="fa fa-trash"></i>
                                </a> 
                                @endhasanyrole
                                <button type="button" class="close btn-rounded pull-right" data-dismiss="modal">&times;</button>
                            </div>
                        </div>
                        <div class="row m-t-2">
                            <div class="col-sm-12 col-md-12">
                                <iframe width="560" height="315" src="" id="vedio-panel" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>                            
                        </div>
                    </div>
                  </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                @hasanyrole('Talents|Web Master|Admin')
                                <a href="javascript:void(0)" id="remove_post_image" data-img="" data-id="" class="label label-danger">
                                    <i class="fa fa-trash"></i>
                                </a> 
                                @endhasanyrole
                                <button type="button" class="close btn-rounded pull-right" data-backdrop="static" data-dismiss="modal">&times;</button>
                            </div>
                        </div>
                        <div class="row m-t-2">
                            <div class="col-sm-12 col-md-12">
                                <img class="img-responsive" style="width: 100%" id="gallery-modal-img" src="{{ asset('/theme/images/portfolio/item-1.png') }}">
                            </div>                            
                        </div>
                    </div>
                  </div>
            </div>
        </div>
  
        <div class="col-md-3">
            <div class="col-md-12">
                <h5>Social Links</h5>
                <div class="widget social_icon" id="social_links"></div>
            </div>

            @hasrole('Talents')
            <div class="col-md-12">
                <div class="box-cell col-md-4 valign-top">
                    <h5>Counter</h5>
                  <ul class="list-group m-x-0 m-t-3 m-b-0">
                    <li class="list-group-item  b-x-0 b-t-0">
                      <span class="label label-primary pull-right" id="article_count"></span>
                      Articles
                    </li>
                    <li class="list-group-item  b-x-0">
                      <span class="label label-danger pull-right" id="photos_count"></span>
                      Photos
                    </li>
                    <li class="list-group-item  b-x-0 b-b-0">
                      <span class="label label-info pull-right" id="video_count"></span>
                      Videos
                    </li>
                  </ul>
                </div>
            </div>
            @endhasrole

            @hasrole('Talents')
                @if(isset($users))
                <div class="col-sm-12">
                    <div class="space-10"></div>
                    <h5 class="m-t-2">Followers</h5>
                    @foreach($users as $user)
                        @if( $user->hasRole('Fans') && Auth::user()->id != $user->id )
                            @if(isset($follows))
                                @if(in_array($user->id,$follows))
                                    <div class="widget-activity-item">
                                        <div class="widget-activity-avatar">
                                            @if($user->image != null)
                                                <img src="{{ asset('storage/users/'.$user->image) }}" title="{{ $user->name }}" alt=""> 
                                            @else
                                                <img src="{{ asset('storage/users/default.png') }}" alt=""> 
                                            @endif
                                        </div>
                                        <div class="widget-activity-header">
                                            <a href="javascript:void(0)">&nbsp;{{ $user->name }}</a>
<!--                                             <button class="btn btn-default btn_clr talent_btn">Block</button> -->
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endif
                    @endforeach
                </div>
                @endif
            @endhasrole

        </div>

    </div>
    <div class="space-30"></div>
</div>


<!--       <span id="loader">
        <i class="fa fa-spinner fa-3x fa-spin"></i>
      </span> -->

@endsection


@section('js')

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5bebbdba767f5386"></script>



<!-- full calander Js -->
<script type="text/javascript">
    $(document).ready(function(){
    
          $('#calendar').fullCalendar({
            selectable: true,         
            dayClick: function() {
                alert('a day has been clicked!');
            },
            events: [
                {
                  title  : 'event1',
                  start  : '2018-11-10'
                }
            ]
          });
    
    });
</script>

<script type="text/javascript">

    //$('.loader').css("visibility", "hidden");

    var user_plan_code = "@if(isset(Auth::user()->plan_code)){{ Auth::user()->plan_code }}@endif";


    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var post_id=0;
    $(document).on('click','.edit_post',function(){
        $('#articleSubmit').text('Update');
        post_id = $(this).data('post-id');
        $.get("{{ route('edit.single.post',['']) }}/"+post_id,function(response){
            var post = response.post;
            $('#post_category option[value='+post.post_category_id+']').prop('selected', 'selected').change();
            $('#post_article').summernote('code', post.description);
        });
    });

    $(document).on('click','.delete_post',function(){
        post_id = $(this).data('post-id');
        if (confirm("Are you sure..?")) 
        {
            $.ajax({
                url: "{{ route('delete.single.post',['']) }}/"+post_id,
                type: "DELETE"
            }).done(function(response){
                if(response.hasOwnProperty('errors'))
                {
                    var html = errorMessage('There is some problem while deleting post');
                    $('#msg').html(html);
                        setTimeout(function(){
                            $('#msg').html('');                          
                    }, 3000);
                }
                else
                {
                    if(response.status == 'success')
                    {
                        var html = errorMessage(response.message);
                        $('#msg').html(html);
                            setTimeout(function(){
                                $('#msg').html('');                          
                        }, 3000);
                        page_refresh();
                    }
                    else
                    {
                        var html = errorMessage(response.message);
                        $('#msg').html(html);
                            setTimeout(function(){
                                $('#msg').html('');                          
                        }, 3000);
                        page_refresh();
                    }
                }
            });
        }
    });


    $('#post-article').pxValidate({
        ignore: ":hidden:not(#post_article),.note-editable.panel-body",
        focusInvalid: false,
        rules: {
          'article': {
            required: true
          }
        },
        messages: {
          'article': {
            required: "Please enter some content"
          }
        }
    });


    $('#post-article').on('submit', function(e) {

        e.preventDefault();

        $('#articleSubmit').prop('disabled',true);

        if( $(this).validate().form() ) 
        {
            if(post_id == 0)
            {
                var data = $(this).serializeArray();
                $.post("{{ route('add.single.post') }}",data,function(response){
                    $('#articleSubmit').prop('disabled',false);
                    if(response.status == 'success')
                    {
                        var html = successMessage(response.message);
                        $('#msg').html(html);
                        setTimeout(function(){
                            $('#msg').html('');                          
                        }, 3000);
                    }
                    else
                    {
                        var html = errorMessage(response.message);
                        $('#msg').html(html);
                        setTimeout(function(){
                            $('#msg').html('');                          
                        }, 3000);
                    }
                    $('#post_article').summernote('reset');
                    page_refresh();
                });
            }
            else
            {
                var data = $(this).serializeArray();
                $.ajax({
                    url: "{{ route('update.single.post',['']) }}/"+post_id,
                    type: "PUT",
                    dataType: "json",
                    data : data
                }).done(function(response){
                    $('#articleSubmit').text('Post');
                    $('#articleSubmit').prop('disabled',false);
                    if(response.hasOwnProperty('errors'))
                    {
                        var html = errorMessage('There is some problem while updating post');
                        $('#msg').html(html);
                        setTimeout(function(){
                            $('#msg').html('');                          
                        }, 3000);
                        $('#post_article').summernote('reset');
                        page_refresh();     
                    }
                    else
                    {
                        var html = successMessage(response.message);
                        $('#msg').html(html);
                        setTimeout(function(){
                            $('#msg').html('');                          
                        }, 3000);
                        $('#post_article').summernote('reset');
                        page_refresh();     
                    }
                });
            }

        }
    });

    function strip_html_tags(str)
    {
       if ((str===null) || (str===''))
           return false;
      else
       str = str.toString();
      return str.replace(/<[^>]*>/g, '');
    }

    page_refresh();


    $( "#post-image-form" ).submit(function( event ) {

        $('#imagesSubmit').prop('disabled',true);

        var data = new FormData();
        $.each($('#file')[0].files, function(i, file) {
            data.append(i, file);
        });

        $.ajax({
              url: "{{ route('add.multiple.images') }}",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              type: 'POST',
        }).done(function(response){
            $('#imagesSubmit').prop('disabled',false);
            if(response.status == 'success')
            {
                $('.fileuploader-items-list').children(".file-type-image").remove();
                page_refresh();
                alert(data.message);
            }
            else
            {
                alert(data.message);
            }
        });

       event.preventDefault();
    });

    $('body').delegate('.img-gallery','click',function(){

        var postId = $(this).attr("data-id");
        $('#gallery-modal-img').attr('src', '');
        var getImgSrc = $(this).find('img').attr('src');
        $('#gallery-modal-img').attr('src', getImgSrc);

        $('#remove_post_image').attr('data-img',getImgSrc);
        $('#remove_post_image').attr('data-id',postId);  
    });


    $('body').delegate('.remove_post_images','click',function(){
        var post_id = $(this).data("id");
        var result = confirm("Are you sure?");
        if (result) 
        {
            $.ajax({
                url: "{{ route('delete.multiple.images',['']) }}/"+post_id,
                type: "DELETE",
                dataType: "json",
                beforeSend: function(){
                    $(this).prop('disabled', true);
                }
            }).done(function(response){

                $('.loader').css("visibility", "hidden");
                if(response.status == 'success')
                {
                    alert(response.message);
                    page_refresh();
                }
                else
                {
                    alert(response.message);
                }
            });
        }
        event.preventDefault();
    });


    $("#remove_post_image").click(function(e){

        var result = confirm("Are you sure?");
        if (result) 
        {
            var image_url  =  $(this).data('img');
            var post_id = $(this).data('id');
            var Obj = {
                'image': image_url,
                'post_id': post_id
            };

            console.log(Obj);

            $.ajax({
                url: "{{ route('delete.single.image') }}",
                type: "POST",
                dataType: "json",
                data: Obj,
                success: function(response){
                    if(response.status == 'success')
                    {
                       // alert(response.message);
                        $("#myModal").modal('hide');
                        $(document.body).removeClass("modal-open");
                        $(".modal-backdrop").remove();
                        
                        page_refresh();

                    }
                    else
                    {
                        alert(response.message);
                    }
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

        e.preventDefault();
    });

    function page_refresh()
    {
        $.ajax({
            url: "{{ route('talent.profile') }}",
            type: "GET",
            dataType: "json",
        }).done(function(response){
            var json =  response;

            //console.log(json.posts);
            // console.log(json.postCategories);
            //console.log(json.additional_info);
            
            var imagesHtml = '';
            var post_images_path = "{{ asset('storage/posts/') }}";

            // here is an array console.log(Object.values(json.images));
            var images = Object.values(json.images);

            var total_images = 0;
            for(var i = 0 ; i < images.length ; i++)
            {
                for(var talent_image in images[i])
                {
                    var keyArr = talent_image.split('_');
                    var talent_name = keyArr[0];
                    var talent_id = keyArr[1];


                    for(var dates in images[i][talent_image])
                    {
                        var keyArr1 = dates.split('_');                        
                        var post_date = keyArr1[0]; // posted date
                        var post_id = keyArr1[1];   // post_id
                        
                        imagesHtml += '<div class="row">';
                        imagesHtml += '<div class="col-md-12">';
                        imagesHtml += '<div class="list-group b-a-0">';
                        imagesHtml += '<div class="list-group-item">';
                        if(user_plan_code != 'free')
                        {
                            imagesHtml += '<div class="dropdown pull-xs-right m-l-1">';
                            imagesHtml += '<button type="button" class="btn btn-xs btn-outline btn-outline-colorless dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
                            imagesHtml += '<i class="fa fa-reorder"></i>';
                            imagesHtml += '</button>';
                            imagesHtml += '<div class="dropdown-menu dropdown-menu-right">';
                            imagesHtml += '<li>';
                            imagesHtml += '<a href="javascript:void(0)" class="remove_post_images" data-id="'+post_id+'">';
                            imagesHtml += '<i class="dropdown-icon fa fa-times text-danger"></i>&nbsp;&nbsp;Remove';
                            imagesHtml += '</a>';
                            imagesHtml += '</li>';
                            imagesHtml += '</div>';
                            // imagesHtml += '<span class="loader">';
                            // imagesHtml += '<i class="fa fa-spinner fa-1x fa-spin"></i>';
                            // imagesHtml += '</span>';
                            imagesHtml += '</div>';
                        }   
                        imagesHtml += '<div class="widget blog_gallery" style="display: inline-flex;">';
                        var imagesArr = images[i][talent_image][dates].images; // images array
                        total_images += imagesArr.length;
                        for(var j = 0 ; j < imagesArr.length ; j++)
                        {
                            var src = post_images_path+"/"+imagesArr[j].replace(/['"]+/g, '');
                            imagesHtml += '<a href="javascript:void(0)" class="img-gallery" data-id="'+post_id+'"  data-toggle="modal"  data-target="#myModal">';
                            imagesHtml += '<img src="'+src+'" class="img-thumbnail img-custom">';
                            imagesHtml += '</a>';
                        }

                        imagesHtml += '</div>';
                        imagesHtml += '<p class="list-group-item-text text-muted font-size-11">Post by <b>'+talent_name+'</b> on '+new Date(post_date).toDateString("yyyy-MM-dd")+'</p>';
                        imagesHtml += '</div>';
                        imagesHtml += '</div>';
                        //
                        imagesHtml += '</div>';
                        imagesHtml += '</div>'; 
                    }                
                }
            }
            $('#photos_count').text(total_images);
            $('#post-images').html(imagesHtml);

            // here is an array console.log(Object.values(json.images));
            var vedioHtml = '';
            var vedios = Object.values(json.vedios);
            var total_videos = 0;
            for(var i = 0 ; i < vedios.length ; i++)
            {
                for(var talent_video in vedios[i])
                {
                    var keyArr = talent_video.split('_');
                    var talent_name = keyArr[0];
                    var talent_id = keyArr[1];

                    total_videos += Object.keys(vedios[i][talent_video]).length;

                    vedioHtml += '<div class="ps-block videos-list p-b-2">';
                    for(var dates in vedios[i][talent_video])
                    {
                        var keyArr1 = dates.split('_');                        
                        var post_date = keyArr1[0]; // posted date
                        var post_id = keyArr1[1];   // post_id
                        var video_info = vedios[i][talent_video][dates].videos;

                        vedioHtml += '<div class="videos-list-item">';
                        vedioHtml += '<a href="javascript:void(0)">';
                        vedioHtml += '<div class="video_date">';
                        vedioHtml += '<i class="fa fa-calendar"></i>&nbsp;'+new Date(post_date).toDateString("yyyy-MM-dd");
                        vedioHtml += '</div>';

                        if(video_info.vedio_type == 'youtube')
                        {
                            vedioHtml += '<img src="'+video_info.image_url+'" data-toggle="modal" data-target="#vedioModal" data-post-id="'+post_id+'" data-url="'+video_info.vedio_url+'" class="border-rounded vedio-modal">';
                        }
                        else if(video_info.vedio_type == 'dailymotion')
                        {
                            vedioHtml += '<img src="'+video_info.image_url+'" data-toggle="modal" data-target="#vedioModal" data-post-id="'+post_id+'" data-url="'+video_info.vedio_url+'"  class="border-rounded vedio-modal">';
                        }
                        else if(video_info.vedio_type == 'vimeo')
                        {
                            vedioHtml += '<img src="'+video_info.image_url+'" data-toggle="modal" data-target="#vedioModal" data-post-id="'+post_id+'" data-url="'+video_info.vedio_url+'" class="border-rounded vedio-modal">';
                        }

                        vedioHtml += '</a>';
                        vedioHtml += '<div class="font-size-11 text-muted" style="margin-top: 5px;">';
                        vedioHtml += '<div class="post_vedio_author">';
                        //vedioHtml += '<i class="fa fa-user"></i>&nbsp;'+video_info.title;  talent_name;
                        vedioHtml += video_info.title+'&nbsp;<a href="javascript:void(0)" class="edit_post_vedio" data-post-id='+post_id+'><i class="fa fa-pencil-square-o"></i></a>';
                        vedioHtml += '</div>';
                        vedioHtml += '<div>';
                        vedioHtml += '<p class="list-group-item-text text-muted font-size-11">Post by <b>'+talent_name+'</b> on '+video_info.vedio_type.charAt(0).toUpperCase()+video_info.vedio_type.slice(1);
                        //vedioHtml += '<i class="fa fa-video-camera"></i>&nbsp;'+video_info.vedio_type.charAt(0).toUpperCase()+video_info.vedio_type.slice(1);
                        vedioHtml += '</div>';
                        vedioHtml += '</div>';
                        vedioHtml += '</div>';
                    } 
                    vedioHtml += '</div>';
                }        
            }
            $('#video_count').text(total_videos);
            $('#post-video').html(vedioHtml);


            if(json.hasOwnProperty('posts'))
            {
                var posts = json.posts;
                if(Object.keys(posts).length > 0)
                {
                    var postHtml = '';
                    $('#article_count').text(Object.keys(posts).length);
                    for (var key in posts) 
                    {
                        if(posts[key].post_type == 'text')
                        {
                            postHtml += '<div class="panel-body">';
                            postHtml += '<div class="list-group-item">';
                            if(user_plan_code != 'free')
                            {
                                postHtml += '<div class="dropdown pull-xs-right m-l-1">';
                                postHtml += '<button type="button" class="btn btn-xs btn-outline btn-outline-colorless dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-reorder"></i></button>';
                                postHtml += '<div class="dropdown-menu dropdown-menu-right">';
                                postHtml += '<li>';
                                postHtml += '<a href="javascript:void(0)" class="edit_post" data-post-id="'+posts[key].id+'" >';
                                postHtml += '<i class="dropdown-icon fa fa-pencil"></i>&nbsp;&nbsp;Edit';
                                postHtml += '</a>';
                                postHtml += '</li>';
                                postHtml += '<li>';
                                postHtml += '<a href="javascript:void(0)" class="delete_post" data-post-id="'+posts[key].id+'" >';
                                postHtml += '<i class="dropdown-icon fa fa-times text-danger"></i>&nbsp;&nbsp;Remove';
                                postHtml += '</a>';
                                postHtml += '</li>';
                                postHtml += '</div>';
                                postHtml += '</div>';
                            }
                            postHtml += '<div class="blog-content">';
                            postHtml += '<div class="post-meta">';
                            postHtml += '<p>By <a href="javascript:void(0)">'+posts[key].user_name+'</a></p>';
                            postHtml += '<p><i class="fa fa-clock-o"></i> <a href="javascript:void(0)">'+new Date(posts[key].created_at).toDateString("yyyy-MM-dd")+'</a></p>';
                            postHtml += '<p>share:';
                            postHtml += '<p class="addthis_inline_share_toolbox"></p>';
                            // if(additional_info.hasOwnProperty('facebook'))
                            // {
                            //     postHtml += '<a href="'+additional_info.facebook+'" class="fa fa-facebook"></a>';
                            // }
                            // if(additional_info.hasOwnProperty('instagram'))
                            // {
                            //     postHtml += '<a href="'+additional_info.instagram+'" class="fa fa-instagram"></a>';
                            // }
                            // if(additional_info.hasOwnProperty('linkdin'))
                            // {
                            //     postHtml += '<a href="'+additional_info.linkdin+'" class="fa fa-linkedin"></a>';
                            // }
                            // if(additional_info.hasOwnProperty('twitter'))
                            // {
                            //     postHtml += '<a href="'+additional_info.twitter+'" class="fa fa-twitter"></a>';
                            // }
                            postHtml += '</p>';
                            postHtml += '<p>';
                            postHtml += strip_html_tags(posts[key].description)
                            postHtml += '</p>';
                            postHtml += '</div>';
                            postHtml += '</div>';
                            postHtml += '</div>';
                            postHtml += '</div>';
                        }
                    }
                    $('#posts').html(postHtml);
                }
            }




            var additional_info = json.additional_info;
            if(additional_info.hasOwnProperty('about_us'))
            {
                $('#overview').text(strip_html_tags(additional_info.about_us));
            }

            $('#social_links').html('');
            if(additional_info.hasOwnProperty('facebook'))
            {
                if(additional_info.facebook == null)
                {
                    $('#social_links').append('<a href="javascript:void(0)" class="fa fa-facebook" target="_blank"></a>');
                }
                else
                {
                    $('#social_links').append('<a href="'+additional_info.facebook+'" class="fa fa-facebook" target="_blank"></a>');
                }
            }

            if(additional_info.hasOwnProperty('instagram'))
            {
                if(additional_info.instagram == null)
                {
                    $('#social_links').append('<a href="javascript:void(0)" class="fa fa-instagram" target="_blank"></a>');
                }
                else
                {
                    $('#social_links').append('<a href="'+additional_info.instagram+'" class="fa fa-instagram" target="_blank"></a>');
                }
            }

            if(additional_info.hasOwnProperty('linkdin'))
            {
                if(additional_info.linkdin == null)
                {
                    $('#social_links').append('<a href="javascript:void(0)" class="fa fa-linkedin" target="_blank"></a>');
                }
                else
                {
                    $('#social_links').append('<a href="'+additional_info.linkdin+'" class="fa fa-linkedin" target="_blank"></a>');
                }
            }

            if(additional_info.hasOwnProperty('twitter'))
            {
                if(additional_info.twitter == null)
                {
                    $('#social_links').append('<a href="javascript:void(0)" class="fa fa-twitter" target="_blank"></a>');
                }
                else
                {
                    $('#social_links').append('<a href="'+additional_info.twitter+'" class="fa fa-twitter" target="_blank"></a>');
                }
            }

            if(additional_info.hasOwnProperty('about_us'))
            {
                var html = '<p>'+ strip_html_tags(additional_info.about_us) +'</p>';
                $('#overview').html('');
                $('#overview').html(html);
            }

            var postCategoryHtml = '';
            var postCategory = json.postCategories;
            if(Object.keys(postCategory).length > 0)
            {
                $('#post_category').html('');
                for (var key in postCategory) 
                {
                    if(postCategory[key].name == 'Un categorized')
                    {
                        $('#post_category').append('<option value='+postCategory[key].id+' selected>' + postCategory[key].name + '</option>');
                    }
                    else
                    {
                        $('#post_category').append('<option value='+postCategory[key].id+'>' + postCategory[key].name + '</option>');
                    }
                }
            }

        });
    }

    var vedio_post_id = 0;
    var post_meta_id = 0;
    $(document).on('click','.edit_post_vedio',function(){

        vedio_post_id = $(this).data('post-id');

        $.get("{{ route('edit.single.vedio',['']) }}/"+vedio_post_id,function(response){
            if(response.hasOwnProperty('status'))
            {   
                if(response.status == 'success')
                {
                    post_meta_id = response.payload.id;
                    $('#videoSubmit').text('Update');
                    $('#video_title').val(response.payload.meta_value.title);
                    $('#vedio_type option[value='+response.payload.meta_value.vedio_type+']').prop('selected', 'selected').change();
                    $('#vedio_url').val(response.payload.meta_value.vedio_url);

                }
            }
        });
    });

    $('#post_vedio').submit(function(e){

        var formData  = $(this).serializeArray();

        $('#videoSubmit').prop('disabled', true);

        if(vedio_post_id == 0 && post_meta_id == 0)
        {
            $.ajax({
                    url: "{{ route('add.single.vedio') }}",
                    type: "POST",
                    dataType: "json",
                    data : formData,
                    beforeSend: function(){
                        $('#videoSubmit').prop('disabled', false);                    
                    }
            }).done(function(response){

                if(response.status == 'success')
                {
                    alert(response.message);
                    page_refresh();
                }
                else
                {
                    alert(response.message);
                }
            });
        }
        else
        {
            $.ajax({
                    url: "{{ route('update.single.vedio',['']) }}/"+post_meta_id,
                    type: "PUT",
                    dataType: "json",
                    data : formData,
                    beforeSend: function(){
                        $('#videoSubmit').prop('disabled', false);                    
                    }
            }).done(function(response){
                if(response.status == 'success')
                {
                    $('#videoSubmit').text('Add');
                    $('#video_title').val('');
                    $('#vedio_type option:selected').remove();
                    $('#vedio_url').val('');
                    alert(response.message);
                    page_refresh();
                }
                else
                {
                    alert(response.message);
                }
            });
        }
        e.preventDefault();
    });

    $(document).on('click','.vedio-modal',function(){
        
        $('#vedio-panel').attr('src', '');
        var vedioSrc = $(this).attr('data-url');
        var post_id = $(this).data('post-id');
        
        $('#remove_post_video').data('post-id',post_id); 

        $('#vedio-panel').attr('src', vedioSrc);
    });

    $(document).on('click','#remove_post_video',function(){

        var post_id = $(this).data('post-id');

        if(confirm('Are you sure.?'))
        {
            $.ajax({
                    url: "{{ route('delete.single.vedio',['']) }}/"+post_id,
                    type: "DELETE"
            }).done(function(response){
                if(response.status == 'success')
                {
                    $("#vedioModal").modal('hide');
                    $(document.body).removeClass("modal-open");
                    $(".modal-backdrop").remove();
                    alert(response.message);
                    page_refresh();
                }
                else
                {
                    alert(response.message);
                }
            });
        }
    });

    function errorMessage(message)
    {
        var html = '<div class="alert alert-success alert-dismissable" style="text-align: center;">';
        html += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        html += '<h4 class="m-t-0 m-b-0"><strong><i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;'+message+'</strong></h4>';
        html += '</div>';
        return html;
    }
    
    function successMessage(message)
    {
        var html = '<div class="alert alert-success alert-dismissable" style="text-align: center;">';
        html += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        html += '<h4 class="m-t-0 m-b-0"><strong><i class="fa fa-check-circle fa-lg"></i>&nbsp;&nbsp;'+message+'</strong></h4>';
        html += '</div>';
        return html;
    }

    // Initialize Summernote
    $(function() {
      $('#post_article').summernote({
        height: 200,
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

    $('#post_vedio').validate({
        focusInvalid: false,
        rules: {
          'title': {
            required: true,
            minlength: 3,
            maxlength: 12,
          },
          'vedio_url': {
            required: true,
            url: true
          }
        },
        messages: {
          'title': {
            required: "Please enter title",
          },
          'vedio_url': {
            required: "Please provide vedio url",
          }
        }
    });

    // Initialize Select2
    $(function() {
      $('#vedio_type').select2({
        placeholder: 'Select value',
      });
    });

    // Initialize Select2
    $(function() {
      $('#post_category').select2({
        placeholder: 'Select value',
      });
    });

    $('#file').fileuploader({
         extensions: ['jpg', 'jpeg', 'png', 'gif', 'bmp'],
         changeInput: ' ',
         theme: 'thumbnails',
         enableApi: true,
         addMore: true,
         limit: 4,
         fileMaxSize: 2,
         thumbnails: {
            box: '<div class="fileuploader-items">' +
                         '<ul class="fileuploader-items-list">' +
                        '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner">+</div></li>' +
                         '</ul>' +
                     '</div>',
            item: '<li class="fileuploader-item">' +
                      '<div class="fileuploader-item-inner">' +
                              '<div class="thumbnail-holder">${image}</div>' +
                              '<div class="actions-holder">' +
                                  '<a class="fileuploader-action fileuploader-action-remove" title="Remove"><i class="remove"></i></a>' +
                              '</div>' +
                              '<div class="progress-holder">${progressBar}</div>' +
                          '</div>' +
                      '</li>',
            item2: '<li class="fileuploader-item">' +
                      '<div class="fileuploader-item-inner">' +
                              '<div class="thumbnail-holder">${image}</div>' +
                              '<div class="actions-holder">' +
                                  '<a class="fileuploader-action fileuploader-action-remove" title="Remove"><i class="remove"></i></a>' +
                              '</div>' +
                          '</div>' +
                      '</li>',
            startImageRenderer: true,
            canvasImage: false,
            _selectors: {
               list: '.fileuploader-items-list',
               item: '.fileuploader-item',
               start: '.fileuploader-action-start',
               retry: '.fileuploader-action-retry',
               remove: '.fileuploader-action-remove'
            },
            onItemShow: function(item, listEl) {
               var plusInput = listEl.find('.fileuploader-thumbnails-input');
               
               plusInput.insertAfter(item.html);
               
               if(item.format == 'image') {
                  item.html.find('.fileuploader-item-icon').hide();
               }
            }
         },
         afterRender: function(listEl, parentEl, newInputEl, inputEl) {
            var plusInput = listEl.find('.fileuploader-thumbnails-input'),
               api = $.fileuploader.getInstance(inputEl.get(0));
         
            plusInput.on('click', function() {
               api.open();
            });
         },
    });
</script>



@endsection