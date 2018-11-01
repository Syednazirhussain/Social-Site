@extends('user.dashboard_layout')


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

@endsection



@section('content')

<!-- https://bootsnipp.com/snippets/1e9Zq -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="main-secction">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 image-section">
            <img src="https://png.pngtree.com/thumb_back/fw800/back_pic/00/08/57/41562ad4a92b16a.jpg">
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

                <div class="pad_left">
                    
                    <button class="btn btn-default btn_clr"><i class="fa fa-share"></i>&nbsp;Share</button>
                    <button class="btn btn-default btn_clr">Become A Fan</button>
                </div>

                <div class="about_margin pad_left">
                    <div class="card" style="width: 30rem;">
<!--                         <div class="card-body">
                            <h5 class="card-title">About</h5>
                            <p class="card-text">
                                Born on October 21, Ali Khan began his journey at an early age with school level competitions. In 1996, he became a teen heartthrob with the pop group ‘ The Vibes. After the pop groups immensely successful run in the ‘ 90s, Khan went solo in 2000, releasing his first single, Surmai Ankhon Mein in 2002. Khan proved he could stand alone by topping charts nationwide and continued his success as a solo artist with Sathiya (2006) which took the industry by storm.Topping charts for several months thus landing him 3 nominations in TMA Awards 2007 amongst nominees like Ali Azmat, Shafqat Amanat Ali, Ali Zafar & Atif Aslam.
                            </p>
                        </div> -->
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
                    </ul>
                    <div class="tab-content"> 
                        @include('flash::message')    
                        <div class="tab-pane active" id="article">
                            <div class="m-a-2 p-a-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <form action="{{ route('fan.post.article') }}" method="POST" class="form-horizontal">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                            <div class="form-group">
                                                <label for="post_category">Select Post Type</label>
                                                <select type="text" name="post_category" id="post_category" class="form-control">
                                                    @if(isset($postCategories))
                                                        @foreach($postCategories as $postCategory)
                                                            @if($postCategory->name == 'Un categorized')
                                                                <option value="{{ $postCategory->id }}" selected="selected">{{ $postCategory->name }}</option>
                                                            @else
                                                                <option value="{{ $postCategory->id }}">{{ $postCategory->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                            <textarea  id="post_article" class="custom_summernote" name="article" ></textarea>
                                            </div>    
                                            <input type="submit" class="btn btn-primary pull-right" style="background-color: #f3565d;color: #fff" value="Post">
                                        </form>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        @if(isset($posts))
                                            @foreach($posts as $post)
                                                @if($post->post_type == 'text')
                                                    <div class="row">
                                                        <div class="post-area">
                                                            <div class="blog-content">
                                                                <div class="post-meta">
                                                                    <p>By <a href="javascript:void(0)">{{ $post->user->name }}</a></p>
                                                                    <p><i class="fa fa-clock-o"></i> <a href="javascript:void(0)">{{ \Carbon\Carbon::parse($post->created_at)->format('F d, Y') }}</a></p>
                                                                    <p>
                                                                        share:
                                                                        @if(isset($additional_info->facebook) && $additional_info->facebook != '')
                                                                            <a href="{{ $additional_info->facebook }}" class="fa fa-facebook"></a>
                                                                        @endif
                                                                        @if(isset($additional_info->instagram) && $additional_info->instagram != '')
                                                                            <a href="{{ $additional_info->instagram }}" class="fa fa-instagram"></a>
                                                                        @endif
                                                                        @if(isset($additional_info->linkdin) && $additional_info->linkdin != '')
                                                                            <a href="{{ $additional_info->linkdin }}" class="fa fa-linkedin"></a>
                                                                        @endif
                                                                        @if(isset($additional_info->twitter) && $additional_info->twitter != '')
                                                                            <a href="{{ $additional_info->twitter }}" class="fa fa-twitter"></a>
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                                <p>
                                                                    <?php echo htmlspecialchars_decode($post->description,ENT_NOQUOTES); ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif 
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="overview">
                            <?php echo htmlspecialchars_decode($additional_info->about_us,ENT_NOQUOTES); ?>
                        </div>
                        <div class="tab-pane" id="photo">
                            <div class="m-a-2">
                                <div class="row">
                                    <form action="{{ route('talent.post.images') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="">Gallery</label>
                                              <input type="file" name="images" class="form-control">
                                          </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-upload"></i>&nbsp;Upload</button>
                                    </form>
                                </div>
                                <div class="m-t-2"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        @if(isset($images))
                                            @foreach($images as $key => $post_images)
                                                <?php if(!empty($post_images)){ ?>
                                                    <?php $data = explode("_", $key); ?>
                                                    <div class="list-group b-a-0">
                                                        <div class="list-group-item">
                                                            <div class="dropdown pull-xs-right m-l-1">
                                                                <button type="button" class="btn btn-xs btn-outline btn-outline-colorless dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-reorder"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <li>
                                                                        <a href="javascript:void(0)" class="remove_post_images" data-id="{{ $data[1] }}">
                                                                            <i class="dropdown-icon fa fa-times text-danger"></i>&nbsp;&nbsp;Remove
                                                                        </a>
                                                                    </li>
                                                                </div>
                                                            </div>
                                                            <div class="widget blog_gallery" style="display: inline-flex;">
                                                                @foreach($post_images as $post_image)
                                                                    <?php $image = trim($post_image,'"'); ?>
                                                                        <a href="javascript:void(0)" class="img-gallery" data-id="{{ $data[1] }}"  data-toggle="modal" data-target="#myModal">
                                                                            <img src="{{ asset('storage/posts/'.$image) }}" class="img-thumbnail img-custom">
                                                                        </a>
                                                                @endforeach
                                                            </div>
                                                            <p class="list-group-item-text text-muted font-size-11">Posted on {{ \Carbon\Carbon::parse($data[0])->format('D F d, Y') }}</p>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <div class="tab-pane" id="video">
                            <div class="m-a-2 p-a-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <fieldset>
                                            <legend><i class="fa fa-upload"></i>&nbsp;Upload vedio</legend>
                                            <form action="{{ route('talent.post.vedio') }}" method="POST" id="post_vedio" class="form-horizontal">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="form-group">
                                                    <label class="control-label">Title</label>
                                                    <input type="text" class="form-control form-control-sm" name="title" placeholder="ex Picnic">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Type</label>
                                                    <select class="form-control form-control-sm" name="vedio_type" id="vedio_type">
                                                        <option value="youtube">Youtube</option>
                                                        <option value="dailymotion">Daily motion</option>
                                                        <option value="viemo">Viemo</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Url</label>
                                                    <input type="text" class="form-control form-control-sm" name="vedio_url" placeholder="ex https://youtu.be/cH6kxtzovew">
                                                </div>
                                                <input class="btn btn-primary pull-right" type="submit" value="Add">
                                            </form>
                                        </fieldset>
                                    </div>
                                    <div class="col-sm-12 col-md-12 m-t-2">
                                        @if(isset($vedios))
                                        <ul class="row video-list-thumbs " style="margin: 0; padding: 0">
                                            <!-- Loop start -->
                                            @foreach($vedios as $key => $vedio)
                                            <li class="col-sm-6 col-md-4" style="padding: 10px 10px;">
                                                <!-- Open vedio link -->    
                                                <a href="javascript:void(0)">

                                                    <?php   if ($vedio['vedio_type'] == 'youtube')    {   

                                                        $url = $vedio['vedio_url'];

                                                        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) 
                                                        {
                                                            $video_id = $match[1];
                                                        }
                                                    ?>  
                                                    <!-- utube video thumbnail -->
                                                    <img src="https://img.youtube.com/vi/<?php echo $video_id; ?>/sddefault.jpg" class="img-responsive" style="height: 190px; width: 100%;">
                                                        

                                                        
                                                    <?php   } elseif ($vedio['vedio_type']  == 'vimeo') { 

                                                        $vimeo = $vedio['vedio_url']; 
                                                        $vimeoGetID = (int) substr(parse_url($vimeo, PHP_URL_PATH), 1);
                                                        $url = 'http://vimeo.com/api/v2/video/'.$vimeoGetID.'.php';
                                                        $contents = @file_get_contents($url);
                                                        $array = @unserialize(trim($contents));
                                                    ?>

                                                    <!-- vimeo video thumbnail -->
                                                    <img src="<?php echo $array[0]['thumbnail_large']; ?>" class="img-responsive" style="height: 190px; width: 100%;">
                                                        
                                                    
                                                    <?php   } elseif ($vedio['vedio_type'] == 'dailymotion') { 

                                                        $url = $vedio['vedio_url'];
                                                        $lastSegment = basename(parse_url($url, PHP_URL_PATH));
                                                        $url = explode("_", $lastSegment); 
                                                    ?>

                                                    <!-- dailymotion video thumbnail -->

                                                     <img src="http://www.dailymotion.com/thumbnail/video/<?php echo $url[0]; ?>" data-toggle="modal" data-target="#vedioModal"  class="vedio-modal" style="height: 190px; width: 100%;">

                                                    <!--  <iframe frameborder="0" width="100%" height="190" src="//www.dailymotion.com/embed/video/<?php //echo strtok(basename($url[0]), '_'); ?>" allowfullscreen></iframe> -->


                                                    <?php   } ?>
                                                            
                                                    <h5 class="business-listing" style="margin-bottom: 0;">{{ $vedio['title'] }}</h5>
                                                    <span class="glyphicon glyphicon-play-circle"></span>
                                                    <!-- <span class="duration">03:15</span> -->
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
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
                                <button type="button" class="close btn-rounded pull-right" data-dismiss="modal">&times;</button>
                            </div>
                        </div>
                        <div class="row m-t-2">
                            <div class="col-sm-12 col-md-12">
                                <iframe frameborder="0" width="100%" id="vedio-panel" height="190" src="" allowfullscreen>
                                </iframe>
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
                                <a href="javascript:void(0)" id="remove_post_image" data-img="" data-id="" class="label label-danger">
                                    <i class="fa fa-trash"></i>
                                </a> 
                                <button type="button" class="close btn-rounded pull-right" data-dismiss="modal">&times;</button>
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
                <div class="widget social_icon">
                    @if(isset($additional_info->facebook) && $additional_info->facebook != '')
                        <a href="{{ $additional_info->facebook }}" class="fa fa-facebook"></a>
                    @endif
                    @if(isset($additional_info->instagram) && $additional_info->instagram != '')
                        <a href="{{ $additional_info->instagram }}" class="fa fa-instagram"></a>
                    @endif
                    @if(isset($additional_info->linkdin) && $additional_info->linkdin != '')
                        <a href="{{ $additional_info->linkdin }}" class="fa fa-linkedin"></a>
                    @endif
                    @if(isset($additional_info->twitter) && $additional_info->twitter != '')
                        <a href="{{ $additional_info->twitter }}" class="fa fa-twitter"></a>
                    @endif
                </div>
            </div>

            <div class="col-md-12">
                <div class="box-cell col-md-4 valign-top">
                    <h5>Counter</h5>
                  <ul class="list-group m-x-0 m-t-3 m-b-0">
                    <li class="list-group-item  b-x-0 b-t-0">
                      <span class="label label-primary pull-right">34</span>
                      Articles
                    </li>
                    <li class="list-group-item  b-x-0">
                      <span class="label label-danger pull-right">128</span>
                      Photos
                    </li>
                    <li class="list-group-item  b-x-0 b-b-0">
                      <span class="label label-info pull-right">12</span>
                      Videos
                    </li>
                  </ul>
                </div>
            </div>

            <div class="col-sm-12">
                <h5>Talents</h5>
                <div class="widget-activity-item">
                    <div class="widget-activity-avatar">
                        <img src="../../public/theme/images/team-member.jpg">
                    </div>
                    <div class="widget-activity-header">
                      <a href="javascript:void(0)">&nbsp;Cairo</a>
                      <button class="btn btn-default talent_btn">Unfollow</button>
                      
                    </div>
                </div>
                <div class="widget-activity-item">
                    <div class="widget-activity-avatar">
                        <img src="../../public/theme/images/team-member.jpg">
                    </div>
                    <div class="widget-activity-header">
                      <a href="javascript:void(0)">&nbsp;Cairo</a>
                      <button class="btn btn-default btn_clr talent_btn">Follow</button>
                      
                    </div>
                </div>
                <div class="widget-activity-item">
                    <div class="widget-activity-avatar">
                        <img src="../../public/theme/images/team-member.jpg">
                    </div>
                    <div class="widget-activity-header">
                      <a href="javascript:void(0)">&nbsp;Cairo</a>
                      <button class="btn btn-default btn_clr talent_btn">Follow</button>
                      
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="space-10"></div>
                <h5 class="m-t-2">Followers</h5>
                <div class="widget-activity-item">
                    <div class="widget-activity-avatar">
                        <img src="../../public/theme/images/team-member.jpg">
                    </div>
                    <div class="widget-activity-header">
                      <a href="javascript:void(0)">&nbsp;Cairo</a>
                      <button class="btn btn-default btn_clr talent_btn">Block</button>
                    </div>
                </div>
                <div class="widget-activity-item">
                    <div class="widget-activity-avatar">
                        <img src="../../public/theme/images/team-member.jpg">
                    </div>
                    <div class="widget-activity-header">
                      <a href="javascript:void(0)">&nbsp;Cairo</a>
                      <button class="btn btn-default btn_clr talent_btn">Block</button>
                    </div>
                </div>
                <div class="widget-activity-item">
                    <div class="widget-activity-avatar">
                        <img src="../../public/theme/images/team-member.jpg">
                    </div>
                    <div class="widget-activity-header">
                      <a href="javascript:void(0)">&nbsp;Cairo</a>
                      <button class="btn btn-default btn_clr talent_btn">Block</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="space-30"></div>
</div>




@endsection


@section('js')

<script type="text/javascript">

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('.img-gallery').on('click', function() {

        var postId = $(this).attr("data-id");
        $('#gallery-modal-img').attr('src', '');
        var getImgSrc = $(this).find('img').attr('src');
        $('#gallery-modal-img').attr('src', getImgSrc);

        $('#remove_post_image').attr('data-img',getImgSrc);
        $('#remove_post_image').attr('data-id',postId);

    });

    $('.vedio-modal').on('click', function() {

        // $('#vedio-panel').attr('src', '');
        var vedioSrc = $(this).attr('src');
        alert(vedioSrc);
        // $('#vedio-panel').attr('src', vedioSrc);

    });


    $(".remove_post_images").click(function(event){
        var post_id = $(this).data("id");
        var result = confirm("Are you sure?");
        if (result) 
        {
            $.ajax({
                url: "{{ route('talent.post.images.destroy',['']) }}/"+post_id,
                type: "DELETE",
                dataType: "json",
                success: function(response){
                    if(response.status == 'success')
                    {
                        alert(response.message);
                        window.location.href = "{{ route('user.dashboard') }}";
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
                url: "{{ route('talent.post.image.remove') }}",
                type: "POST",
                dataType: "json",
                data: Obj,
                success: function(response){
                    if(response.status == 'success')
                    {
                        alert(response.message);
                        window.location.href = "{{ route('user.dashboard') }}";
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

    
    
    // Initialize Summernote
    $(function() {
      $('#post_article').summernote({
        height:200,
        placeholder: 'Write something here',
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
            maxlength: 40,
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

    $('input[name="images"]').fileuploader({
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