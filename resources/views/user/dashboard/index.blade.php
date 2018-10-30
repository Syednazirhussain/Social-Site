@extends('user.dashboard_layout')


@section('css')

<style type="text/css">

    .blog_archieve li a {
        padding: 10px 0 !important;
    }

    .post-area{
        margin: 2% 4%;
    }

    .form-group button {
        font-size: 14px !important;
        padding: 10px 10px !important;
    }

    .errorTxt, .error { 
        color: #dc3545 !important;
        font-weight: unset !important;
    }

</style>

@endsection



@section('content')

<!-- https://bootsnipp.com/snippets/1e9Zq -->


<div class="main-secction">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 image-section">
            <img src="https://png.pngtree.com/thumb_back/fw800/back_pic/00/08/57/41562ad4a92b16a.jpg">
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12 pull-left">
            <div class="col-md-12 col-md-12-sm-12 col-xs-12 user-image text-center">
                <img src="{{ asset('storage/users/'.$user->image) }}" class="img-thumbnail img-custom">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 120px">
                <div class="text-left">
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
        </div>
        <div class="col-md-9 col-sm-9 col-xs-12 profile-right-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4 col-sm-4">
                        <h2>{{ $user->name }}</h2>
                       <!--  <h5>Developer</h5> -->
                    </div>
                    <div class="col-md-4 col-sm-4 text-right">
                        <button class="btn btn-default btn-rounded"><i class="fa fa-share"></i>&nbsp;Share</button>
                        <button class="btn btn-default btn-rounded">Become a fan</button>
                    </div>                               
                </div>
                <div class="col-md-12">
                    <div class="col-md-8">
                        <div class="tabbable-panel">
                            <div class="tabbable-line">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#about" data-toggle="tab">
                                            About
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#article" data-toggle="tab">
                                            Article
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#photo" data-toggle="tab">
                                            Photos
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#video" data-toggle="tab">
                                            Vedios
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    @include('flash::message')
                                    <div class="tab-pane active" id="about">
                                        <?php echo htmlspecialchars_decode($additional_info->about_us,ENT_NOQUOTES); ?>
                                    </div>
                                    <div class="tab-pane" id="article">
                                        <div class="row">
                                            <div class="post-area">
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
                                        </div>
                                        @if(isset($posts))
                                            @foreach($posts as $post)
                                            <div class="row">
                                                <div class="post-area">
                                                    <div class="blog-content">
                                                        <div class="post-meta">
                                                            <p>By <a href="javascript:void(0)">{{ $post->user->name }}</a></p>
                                                            <p><i class="fa fa-clock-o"></i> <a href="#">{{ \Carbon\Carbon::parse($post->created_at)->format('F d, Y') }}</a></p>
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
                                            @endforeach
                                        @endif                                       
                                        <!--  <textarea style="resize: none;border: 1px solid #f3565d" class="form-control" name="article" ></textarea> -->
                                    </div>
                                    <div class="tab-pane" id="photo">
                                        <div class="post-area">
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
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="video">
                                        <div class="post-area">
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

                                                        <li class="col-sm-6 col-md-3" style="padding: 10px 10px;">
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
                                                                <img src="http://www.dailymotion.com/thumbnail/video/<?php echo $url[0]; ?>" class="img-responsive" style="height: 190px; width: 100%;">

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
                    <aside class="col-md-4">
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

                            <div class="widget archieve">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-cell col-md-4 valign-top">
                                          <ul class="list-group m-x-0 m-t-3 m-b-0">
                                            <li class="list-group-item  b-x-0 b-t-0">
                                              <span class="label label-primary pull-right">34</span>
                                              Articles
                                            </li>
                                            <li class="list-group-item  b-x-0">
                                              <span class="label label-danger pull-right">128</span>
                                              Audio
                                            </li>
                                            <li class="list-group-item  b-x-0 b-b-0">
                                              <span class="label label-info pull-right">12</span>
                                              Videos
                                            </li>
                                          </ul>
                                        </div>
                                    </div>
                                    <p>Talents</p>
                                    <div class="col-sm-12">
                                        <div class="widget-activity-item">
                                            <div class="widget-activity-avatar">
                                                <img src="{{ asset('/theme/images/team-member.jpg') }}">
                                            </div>
                                            <div class="widget-activity-header">
                                              <a href="javascript:void(0)">&nbsp;Cairo</a>
                                            </div>
                                        </div>
                                        <div class="widget-activity-item">
                                            <div class="widget-activity-avatar">
                                                <img src="{{ asset('/theme/images/team-member.jpg') }}">
                                            </div>
                                            <div class="widget-activity-header">
                                              <a href="javascript:void(0)">&nbsp;Cairo</a>
                                            </div>
                                        </div>
                                        <div class="widget-activity-item">
                                            <div class="widget-activity-avatar">
                                                <img src="{{ asset('/theme/images/team-member.jpg') }}">
                                            </div>
                                            <div class="widget-activity-header">
                                              <a href="javascript:void(0)">&nbsp;Cairo</a>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="m-t-2">Followers</p>
                                    <div class="col-sm-12">
                                        <div class="widget-activity-item">
                                            <div class="widget-activity-avatar">
                                                <img src="{{ asset('/theme/images/team-member.jpg') }}">
                                            </div>
                                            <div class="widget-activity-header">
                                              <a href="javascript:void(0)">&nbsp;Cairo</a>
                                            </div>
                                        </div>
                                        <div class="widget-activity-item">
                                            <div class="widget-activity-avatar">
                                                <img src="{{ asset('/theme/images/team-member.jpg') }}">
                                            </div>
                                            <div class="widget-activity-header">
                                              <a href="javascript:void(0)">&nbsp;Cairo</a>
                                            </div>
                                        </div>
                                        <div class="widget-activity-item">
                                            <div class="widget-activity-avatar">
                                                <img src="{{ asset('/theme/images/team-member.jpg') }}">
                                            </div>
                                            <div class="widget-activity-header">
                                              <a href="javascript:void(0)">&nbsp;Cairo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('js')

<script type="text/javascript">
    
    
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