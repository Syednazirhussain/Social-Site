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

<style>
        
    #wrap {
        width: 1100px;
        margin: 0 auto;
        }
        
    #external-events {
        float: left;
        width: 150px;
        padding: 0 10px;
        text-align: left;
        }
        
    #external-events h4 {
        font-size: 16px;
        margin-top: 0;
        padding-top: 1em;
        }
        
    .external-event { /* try to mimick the look of a real event */
        margin: 10px 0;
        padding: 2px 4px;
        background: #3366CC;
        color: #fff;
        font-size: .85em;
        cursor: pointer;
        }
        
    #external-events p {
        margin: 1.5em 0;
        font-size: 11px;
        color: #666;
        }
        
    #external-events p input {
        margin: 0;
        vertical-align: middle;
        }

    #calendar {/*      float: right; */
        margin: 0 auto;
        width: 100%;
        background-color: #FFFFFF;
          border-radius: 6px;
        box-shadow: 0 1px 2px #C3C3C3;
        -webkit-box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
        -moz-box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
        box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
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
                        @hasanyrole('Talents|Web Master|Admin')
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
                        @endhasanyrole
                    </ul>
                    <div class="tab-content"> 
                        <div id="msg"></div>    
                        <div class="tab-pane active" id="article">
                            <div class="m-a-2 p-a-3">
                                <div class="row">
                                    @hasanyrole('Talents|Web Master|Admin')
                                    <div class="col-sm-12 col-md-12">
                                        <form id="post-article" method="POST" class="form-horizontal">
                                            <div class="form-group">
                                                <label for="post_category">Select Post Type</label>
                                                <select type="text" name="post_category" id="post_category" class="form-control">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <textarea id="post_article" class="custom_summernote" name="article" ></textarea>
                                            </div>    
                                            <input type="submit" class="btn btn-primary pull-right" style="background-color: #f3565d;color: #fff" value="Post">
                                        </form>
                                    </div>
                                    @endhasanyrole
                                    <div class="col-sm-12 col-md-12">
                                        <div class="row m-t-2">
                                            <div class="post-area" id="posts"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="overview">

                        </div>
                        <div class="tab-pane" id="photo">
                            <div class="m-a-2">
                                <div class="row">
                                    <form action="{{ route('talent.post.images') }}" method="POST" id="post-image-form" enctype="multipart/form-data" class="form-horizontal">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="">Gallery</label>
                                              <input type="file" id="file" name="images" class="form-control">
                                          </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-upload"></i>&nbsp;Upload</button>
                                    </form>
                                </div>
                                <div class="m-t-2"></div>
                                <div id="post-images"></div>  
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
                                                        <option value="vimeo">Vimeo</option>
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
                                        <div id="post-vedios"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="event">

                            <div id='calendar'></div>                                

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
                                <a href="javascript:void(0)" id="remove_post_image" data-img="" data-id="" class="label label-danger">
                                    <i class="fa fa-trash"></i>
                                </a> 
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


<!--       <span id="loader">
        <i class="fa fa-spinner fa-3x fa-spin"></i>
      </span> -->

@endsection


@section('js')

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5bebbdba767f5386"></script>



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
        post_id = $(this).data('post-id');
        $.get("{{ route('edit.single.post',['']) }}/"+post_id,function(response){
            var post = response.post;
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

        if( $(this).validate().form() ) 
        {
            if(post_id == 0)
            {
                var data = $(this).serializeArray();
                $.post("{{ route('fan.post.article') }}",data,function(response){
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

        var data = new FormData();
        $.each($('#file')[0].files, function(i, file) {
            data.append(i, file);
        });

        $.ajax({
              url: "{{ route('talent.post.images') }}",
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              type: 'POST',
              success: function(data){
                if(data.status == 'success')
                {
                    $('.fileuploader-items-list').children(".file-type-image").remove();
                    page_refresh();
                    alert(data.message);
                }
                else
                {
                    alert(data.message);
                }
              },
              error: function(xhr,status,error)  {
                console.log("status "+status+" Error "+error);
              }
        });


       event.preventDefault();
    });

    $('#post_vedio').submit(function(e){

        var formData  = $(this).serializeArray();

        $.ajax({
            url: "{{ route('talent.post.vedio') }}",
            type: "POST",
            dataType: "json",
            data : formData
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

        e.preventDefault();
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
                url: "{{ route('talent.post.images.destroy',['']) }}/"+post_id,
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
                url: "{{ route('talent.post.image.remove') }}",
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

    $(document).on('click','.vedio-modal',function(){
        $('#vedio-panel').attr('src', '');
        var vedioSrc = $(this).attr('data-url');
        console.log(vedioSrc);
        $('#vedio-panel').attr('src', vedioSrc);
    });

    function page_refresh()
    {
        $.ajax({
            url: "{{ route('get.post.data') }}",
            type: "GET",
            dataType: "json",
        }).done(function(response){
            var json =  response;

            //console.log(json.posts);
            // console.log(json.postCategories);
            //console.log(json.additional_info);
            

            // console.log(json.images);
            // console.log(Object.keys(json.images).length);

            var imagesHtml = '';
            var post_images_path = "{{ asset('storage/posts/') }}";

            if(Object.keys(json.images).length > 0)
            {
                var images = json.images;
                for (var key in images) 
                {
                    if (images.hasOwnProperty(key)) 
                    {
                        var keyArr = key.split('_');

                        imagesHtml += '<div class="row">';
                        imagesHtml += '<div class="col-md-12">';
                        /* start loop */
                        imagesHtml += '<div class="list-group b-a-0">';
                        imagesHtml += '<div class="list-group-item">';
                        imagesHtml += '<div class="dropdown pull-xs-right m-l-1">';
                        imagesHtml += '<button type="button" class="btn btn-xs btn-outline btn-outline-colorless dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
                        imagesHtml += '<i class="fa fa-reorder"></i>';
                        imagesHtml += '</button>';
                        //
                        imagesHtml += '<div class="dropdown-menu dropdown-menu-right">';
                        imagesHtml += '<li>';
                        imagesHtml += '<a href="javascript:void(0)" class="remove_post_images" data-id="'+keyArr[1]+'">';
                        imagesHtml += '<i class="dropdown-icon fa fa-times text-danger"></i>&nbsp;&nbsp;Remove';
                        imagesHtml += '</a>';
                        imagesHtml += '</li>';
                        imagesHtml += '</div>';

                        // imagesHtml += '<span class="loader">';
                        // imagesHtml += '<i class="fa fa-spinner fa-1x fa-spin"></i>';
                        // imagesHtml += '</span>';


                        //
                        imagesHtml += '</div>';
                        imagesHtml += '<div class="widget blog_gallery" style="display: inline-flex;">';
                        for(var i = 0 ; i < images[key].length ; i++)
                        {
                            var src = post_images_path+"/"+images[key][i].replace(/['"]+/g, '');
                            imagesHtml += '<a href="javascript:void(0)" class="img-gallery" data-id="'+keyArr[1]+'"  data-toggle="modal"  data-target="#myModal">';
                            imagesHtml += '<img src="'+src+'" class="img-thumbnail img-custom">';
                            imagesHtml += '</a>';
                        }
                        imagesHtml += '</div>';
                        imagesHtml += '<p class="list-group-item-text text-muted font-size-11">Posted on '+new Date(keyArr[0]).toDateString("yyyy-MM-dd")+'</p>';
                        imagesHtml += '</div>';
                        imagesHtml += '</div>';
                        /* end loop */
                        imagesHtml += '</div>';
                        imagesHtml += '</div>'; 
                    }
                }
            }
            $('#post-images').html(imagesHtml);
            // console.log(key+"  ->   "+images[key][0]);
            // console.log("id "+ keyArr[1]);
            // var date = new Date(keyArr[0]).toDateString("yyyy-MM-dd");
            // console.log("Date "+date);

            var vedioHtml = '';
            var vedios = json.vedios;
            if(Object.keys(vedios).length > 0)
            {
                for (var key in vedios) 
                {
                    vedioHtml += '<ul class="row video-list-thumbs " style="margin: 0; padding: 0">';
                    if (vedios.hasOwnProperty(key)) 
                    {
                        vedioHtml += '<li class="col-sm-6 col-md-4" style="padding: 10px 10px;">';
                        vedioHtml += '<a href="javascript:void(0)">';

                        if(vedios[key].vedio_type == 'youtube')
                        {
                            vedioHtml += '<img src="'+vedios[key].image_url+'" data-toggle="modal" data-target="#vedioModal" data-url="'+vedios[key].vedio_url+'" class="vedio-modal" style="height: 190px; width: 100%;">';
                        }
                        else if(vedios[key].vedio_type == 'dailymotion')
                        {
                            vedioHtml += '<img src="'+vedios[key].image_url+'" data-toggle="modal" data-target="#vedioModal" data-url="'+vedios[key].vedio_url+'"  class="vedio-modal" style="height: 190px; width: 100%;">';
                        }
                        else if(vedios[key].vedio_type == 'vimeo')
                        {
                            vedioHtml += '<img src="'+vedios[key].image_url+'" data-toggle="modal" data-target="#vedioModal" data-url="'+vedios[key].vedio_url+'" class="vedio-modal" style="height: 190px; width: 100%;">';
                        }                                                        
                        vedioHtml += '<h5 class="business-listing" style="margin-bottom: 0;">'+vedios[key].title+'</h5>';                                 
                        vedioHtml += '<p>'+vedios[key].vedio_type.charAt(0).toUpperCase()+vedios[key].vedio_type.slice(1)+'</p>';                                 
                        vedioHtml += '</a>';
                        vedioHtml += '<span class="glyphicon glyphicon-play-circle">&nbsp;</span>';
                        vedioHtml += '</li>';
                    }
                    vedioHtml += '</ul>';
                }               
            }
            $('#post-vedios').html(vedioHtml);
            // console.log(json.vedios);
            // for (var key in vedios) 
            // {
            //     if (vedios.hasOwnProperty(key)) 
            //     {
            //         console.log(key+"  ->   "+vedios[key].title);
            //     }
            // }


            var postHtml = '';
            var posts = json.posts;
            var additional_info = json.additional_info;
            if(Object.keys(posts).length > 0)
            {
                for (var key in posts) 
                {
                    if(posts[key].post_type == 'text')
                    {
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
                    }
                }
            }
            $('#posts').html(postHtml);



            if(additional_info.hasOwnProperty('about_us'))
            {
                $('#overview').text(strip_html_tags(additional_info.about_us));
            }

            $('#social_links').html('');
            if(additional_info.hasOwnProperty('facebook'))
            {
                $('#social_links').append('<a href="'+additional_info.facebook+'" class="fa fa-facebook" target="_blank"></a>');
            }

            if(additional_info.hasOwnProperty('instagram'))
            {
                $('#social_links').append('<a href="'+additional_info.instagram+'" class="fa fa-instagram" target="_blank"></a>');
            }

            if(additional_info.hasOwnProperty('linkdin'))
            {
                $('#social_links').append('<a href="'+additional_info.linkdin+'" class="fa fa-linkedin" target="_blank"></a>');
            }

            if(additional_info.hasOwnProperty('twitter'))
            {
                $('#social_links').append('<a href="'+additional_info.twitter+'" class="fa fa-twitter" target="_blank"></a>');
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
          ['insert', ['link', 'video', 'table', 'hr']],
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


<script>

    $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        
        /*  className colors
        
        className: default(transparent), important(red), chill(pink), success(green), info(blue)
        
        */      
        
          
        /* initialize the external events
        -----------------------------------------------------------------*/
    
        $('#external-events div.external-event').each(function() {
        
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
            
        });
    
    
        /* initialize the calendar
        -----------------------------------------------------------------*/
        
        var calendar =  $('#calendar').fullCalendar({
            header: {
                left: 'title',
                center: 'agendaDay,agendaWeek,month',
                right: 'prev,next today'
            },
            editable: true,
            firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
            selectable: true,
            defaultView: 'month',
            
            axisFormat: 'h:mm',
            columnFormat: {
                month: 'ddd',    // Mon
                week: 'ddd d', // Mon 7
                day: 'dddd M/d',  // Monday 9/7
                agendaDay: 'dddd d'
            },
            titleFormat: {
                month: 'MMMM yyyy', // September 2009
                week: "MMMM yyyy", // September 2009
                day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
            },
            allDaySlot: false,
            selectHelper: true,
            select: function(start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true // make the event "stick"
                    );
                }
                calendar.fullCalendar('unselect');
            },
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function(date, allDay) { // this function is called when something is dropped
            
                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);
                
                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                
                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
                
            },
            
            events: [
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1)
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d-3, 16, 0),
                    allDay: false,
                    className: 'info'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d+4, 16, 0),
                    allDay: false,
                    className: 'info'
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false,
                    className: 'important'
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false,
                    className: 'important'
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d+1, 19, 0),
                    end: new Date(y, m, d+1, 22, 30),
                    allDay: false,
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'https://ccp.cloudaccess.net/aff.php?aff=5188',
                    className: 'success'
                }
            ],          
        });
        
        
    });
</script>



@endsection