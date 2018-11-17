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

<!--                 <div class="pad_left">
                    <button class="btn btn-default btn_clr"><i class="fa fa-share"></i>&nbsp;Share</button>
                    <a href="javascript:void(0)" class="btn btn-default btn_clr">Become An Artist</a>
                </div> -->

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
                        <div id="msg"></div>    
                        <div class="tab-pane active" id="article">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="panel">
                                        <div id="posts"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="overview"></div>
                        <div class="tab-pane" id="photo">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div id="post-images"></div>  
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="video">
                            <div class="m-a-2 p-a-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div id="post-video"></div>
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


            @if(isset($users))
            <div class="col-sm-12">
                <div class="space-10"></div>
                <h5 class="m-t-2">Followers</h5>
                @foreach($users as $u)
                    @if( $u->hasRole('Fans'))
                        @if(isset($follows))
                            @if(in_array($u->id,$follows))
                                <div class="widget-activity-item">
                                    <div class="widget-activity-avatar">
                                        @if($u->image != null)
                                            <img src="{{ asset('storage/users/'.$u->image) }}" title="{{ $u->name }}" alt=""> 
                                        @else
                                            <img src="{{ asset('storage/users/default.png') }}" alt=""> 
                                        @endif
                                    </div>
                                    <div class="widget-activity-header">
                                        <a href="javascript:void(0)">&nbsp;{{ $u->name }}</a>
    <!--                                             <button class="btn btn-default btn_clr talent_btn">Block</button> -->
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endif
                @endforeach
            </div>
            @endif

        </div>

    </div>
    <div class="space-30"></div>
</div>


@endsection


@section('js')

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5bebbdba767f5386"></script>



<script type="text/javascript">

    var id = "@if(isset($user)){{ $user->id }}@endif";

    page_refresh();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    function page_refresh()
    {
        $.ajax({
            url: "{{ route('fan.view.talent.detail',['']) }}/"+id,
            type: "GET",
            dataType: "json",
        }).done(function(response){
            var json =  response;

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
                        //  
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
                            vedioHtml += '<img src="'+video_info.image_url+'" data-toggle="modal" data-target="#vedioModal" data-url="'+video_info.vedio_url+'" class="border-rounded vedio-modal">';
                        }
                        else if(video_info.vedio_type == 'dailymotion')
                        {
                            vedioHtml += '<img src="'+video_info.image_url+'" data-toggle="modal" data-target="#vedioModal" data-url="'+video_info.vedio_url+'"  class="border-rounded vedio-modal">';
                        }
                        else if(video_info.vedio_type == 'vimeo')
                        {
                            vedioHtml += '<img src="'+video_info.image_url+'" data-toggle="modal" data-target="#vedioModal" data-url="'+video_info.vedio_url+'" class="border-rounded vedio-modal">';
                        }

                        vedioHtml += '</a>';
                        vedioHtml += '<div class="font-size-11 text-muted" style="margin-top: 5px;">';
                        vedioHtml += '<div class="post_vedio_author">';
                        vedioHtml += '<i class="fa fa-user"></i>&nbsp;'+talent_name;
                        vedioHtml += '</div>';
                        vedioHtml += '<div>';
                        vedioHtml += '<i class="fa fa-video-camera"></i>&nbsp;'+video_info.vedio_type.charAt(0).toUpperCase()+video_info.vedio_type.slice(1);
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
                            //
                            postHtml += '<div class="blog-content">';
                            postHtml += '<div class="post-meta">';
                            postHtml += '<p>By <a href="javascript:void(0)">'+posts[key].user_name+'</a></p>';
                            postHtml += '<p><i class="fa fa-clock-o"></i> <a href="javascript:void(0)">'+new Date(posts[key].created_at).toDateString("yyyy-MM-dd")+'</a></p>';
                            postHtml += '<p>share:';
                            postHtml += '<p class="addthis_inline_share_toolbox"></p>';
                            //
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


    function strip_html_tags(str)
    {
       if ((str===null) || (str===''))
           return false;
      else
       str = str.toString();
      return str.replace(/<[^>]*>/g, '');
    }

    $('body').delegate('.img-gallery','click',function(){

        var postId = $(this).attr("data-id");
        $('#gallery-modal-img').attr('src', '');
        var getImgSrc = $(this).find('img').attr('src');
        $('#gallery-modal-img').attr('src', getImgSrc);

        $('#remove_post_image').attr('data-img',getImgSrc);
        $('#remove_post_image').attr('data-id',postId);  
    });

    $(document).on('click','.vedio-modal',function(){
        $('#vedio-panel').attr('src', '');
        var vedioSrc = $(this).attr('data-url');
        console.log(vedioSrc);
        $('#vedio-panel').attr('src', vedioSrc);
    });

</script>





@endsection