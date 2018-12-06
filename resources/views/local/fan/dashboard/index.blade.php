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
        width: 100%;
        display: inline-block;
        margin: 20px 0px 20px 0px;
        position: relative;
    }

    .video_date{
        position: absolute;
        z-index: 9;
        background: #eb613e;
        color: white;
        font-size: 12px;
        right: 0px;
        top: 0px;
        padding: 0px 30px;
    }

    .post_vedio_author{
        font-size: 24px;
        color: #eb613e;
        margin: 9px 0px;
    }

    .vedio_detail{
        font-size: 12px;
    }

    .ps-block{
        position: relative;
        width: 80% !important;
        margin: 0 auto !important;
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
                    @if(isset($user))
                        @if($user->image != null)
                            <input type="hidden" name="profile_image" id="logo-hidden" value="{{ $user->image }}">
                            <img class="img-thumbnail img-custom" src="{{ asset('storage/users/'.$user->image ) }}" data-src="{{ asset('storage/users/'.$user->image) }}" alt="{{ $user->name}}" />
                        @else
                            <img class="img-thumbnail img-custom" src="{{ asset('storage/users/default.png') }}" alt="{{ $user->name}}"/>
                        @endif
                    @else
                        <img class="img-thumbnail img-custom" src="{{ asset('storage/users/default.png') }}" alt="user"/>
                    @endif
                </div>

                <div class="pad_left">
                    <h2 class="h2_margin">{{ $user->name }}</h2>
                  <!--   <h5 class="h2_margin">Developer</h5> -->
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
                    </ul>
                    <div class="tab-content"> 
                        <div id="msg"></div>    
                        <div class="tab-pane active" id="article">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div id="posts"></div> 
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="overview">
                            @if(isset($additional_info))
                                @if($additional_info->about_us != null)
                                    <?php echo html_entity_decode($additional_info->about_us); ?>
                                @else
                                    <p class="lead"><em>Write something about us</em></p>
                                @endif
                            @endif
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
                <div class="widget social_icon">
                    @if(isset($additional_info->facebook) && $additional_info->facebook != null)
                        <a href="@if(isset($additional_info->facebook )){{ $additional_info->facebook  }}@endif" class="fa fa-facebook" target="_blank"></a>
                    @endif
                    @if(isset($additional_info->instagram) && $additional_info->instagram != null)
                    <a href="@if(isset($additional_info->instagram )){{ $additional_info->instagram  }}@endif" class="fa fa-instagram" target="_blank"></a>
                    @endif
                    @if(isset($additional_info->linkdin) && $additional_info->linkdin != null)
                        <a href="@if(isset($additional_info->linkdin)){{ $additional_info->linkdin }}@endif" class="fa fa-linkedin" target="_blank"></a>
                    @endif
                    @if(isset($additional_info->twitter) && $additional_info->twitter != null)
                        <a href="@if(isset($additional_info->twitter)){{ $additional_info->twitter }}@endif" class="fa fa-twitter" target="_blank"></a>
                    @endif
                </div>
            </div>


            @hasrole('Fans')
                @if(isset($users))
                <div class="col-sm-12">
                    <h5>Talents</h5>
                    @foreach($users as $user)
                        @if( $user->hasRole('Talents') && Auth::user()->id != $user->id )
                        <div class="widget-activity-item">
                            <div class="widget-activity-avatar">
                                @if($user->image != null)
                                    <img src="{{ asset('storage/users/'.$user->image) }}" title="{{ $user->name }}" alt=""> 
                                @else
                                    <img src="{{ asset('storage/users/default.png') }}" alt=""> 
                                @endif
                            </div>
                            <div class="widget-activity-header">
                                <a href="{{ route('fan.view.talent.profile',[$user->id]) }}">&nbsp;{{ $user->name }}</a>
                                @if($user->plan_code == 'premium' && $user->hasRole('Talents'))
                                    @if(isset($follows))
                                        @if(in_array($user->id,$follows))
                                            <form action="{{ route('fan.unfollow.talent') }}" method="POST" style="margin-top: -24px">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="follower_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="followed_id" value="{{ $user->id }}">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-default talent_btn">Unfollow</button>
                                                </div>
                                            </form>
                                        @else
                                            <form action="{{ route('fan.follow.talent') }}" method="POST" style="margin-top: -24px">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="follower_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="followed_id" value="{{ $user->id }}">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary talent_btn">Follow</button>
                                                </div>
                                            </form>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
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



<script type="text/javascript">

    //$('.loader').css("visibility", "hidden");

    var user_plan_code = "@if(isset(Auth::user()->plan_code)){{ Auth::user()->plan_code }}@endif";


    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

    function page_refresh()
    {
        $.ajax({
            url: "{{ route('fan.profile') }}",
            type: "GET",
            dataType: "json",
        }).done(function(response){
            var json =  response;


            var postHtml = '';
            var post_images_path = "{{ asset('storage/posts/') }}";

            // here is an array console.log(Object.values(json.images));

            if(json.hasOwnProperty('images'))
            {
                var images = Object.values(json.images);
                var total_images = 0;
                for(var i = 0 ; i < images.length ; i++)
                {
                    for(var talent_image in images[i])
                    {
                        var keyArr = talent_image.split('_');
                        var talent_name = keyArr[0];
                        var talent_id = keyArr[1];

                        var profile_url = "{{ route('fan.view.talent.profile',['']) }}/"+talent_id;

                        for(var dates in images[i][talent_image])
                        {
                            var keyArr1 = dates.split('_');                        
                            var post_date = keyArr1[0]; // posted date
                            var post_id = keyArr1[1];   // post_id
                            
                            postHtml += '<div class="row">';
                            postHtml += '<div class="col-md-12">';
                            postHtml += '<div class="list-group b-a-0">';
                            postHtml += '<div class="list-group-item">';
                            if(user_plan_code != 'free')
                            {
                                postHtml += '<div class="dropdown pull-xs-right m-l-1">';
                                postHtml += '<button type="button" class="btn btn-xs btn-outline btn-outline-colorless dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
                                postHtml += '<i class="fa fa-reorder"></i>';
                                postHtml += '</button>';
                                postHtml += '<div class="dropdown-menu dropdown-menu-right">';
                                postHtml += '<li>';
                                postHtml += '<a href="javascript:void(0)" class="remove_post_images" data-id="'+post_id+'">';
                                postHtml += '<i class="dropdown-icon fa fa-times text-danger"></i>&nbsp;&nbsp;Remove';
                                postHtml += '</a>';
                                postHtml += '</li>';
                                postHtml += '</div>';
                                // postHtml += '<span class="loader">';
                                // postHtml += '<i class="fa fa-spinner fa-1x fa-spin"></i>';
                                // postHtml += '</span>';
                                postHtml += '</div>';
                            }   
                            postHtml += '<div class="widget blog_gallery" style="display: inline-flex;">';
                            var imagesArr = images[i][talent_image][dates].images; // images array
                            total_images += imagesArr.length;
                            for(var j = 0 ; j < imagesArr.length ; j++)
                            {
                                var src = post_images_path+"/"+imagesArr[j].replace(/['"]+/g, '');
                                postHtml += '<a href="javascript:void(0)" class="img-gallery" data-id="'+post_id+'"  data-toggle="modal"  data-target="#myModal">';
                                postHtml += '<img src="'+src+'" class="img-thumbnail img-custom">';
                                postHtml += '</a>';
                            }

                            postHtml += '</div>';
                            postHtml += '<p class="list-group-item-text text-muted font-size-11">Post by <a href="'+profile_url+'"><b>'+talent_name+'</b></a> on '+new Date(post_date).toDateString("yyyy-MM-dd")+'</p>';
                            postHtml += '</div>';
                            postHtml += '</div>';
                            //
                            postHtml += '</div>';
                            postHtml += '</div>'; 
                        }                
                    }
                }
                $('#photos_count').text(total_images);
            }

            // here is an array console.log(Object.values(json.images));

            //console.log(json.vedios);

            var vedios = json.vedios;
            var vedios_arr = Object.values(vedios)[0];


            if(vedios_arr.length > 0)
            {
                for(var i = 0 ; i < vedios_arr.length ; i++)
                {
                    var profile_url = "{{ route('fan.view.talent.profile',['']) }}/"+vedios_arr[i].user_id;

                    postHtml += '<div class="ps-block videos-list">';
                    postHtml += '<div class="videos-list-item">';
                    postHtml += '<a href="javascript:void(0)">';
                    postHtml += '<div class="video_date">';
                    postHtml += '<i class="fa fa-calendar"></i>&nbsp;'+new Date(vedios_arr[i].posted_date).toDateString("yyyy-MM-dd");
                    postHtml += '</div>';
                    if(vedios_arr[i].vedio_type == 'youtube')
                    {
                        postHtml += '<img src="'+vedios_arr[i].image_url+'" data-toggle="modal" data-target="#vedioModal" data-url="'+vedios_arr[i].vedio_url+'" class="border-rounded vedio-modal">';
                    }
                    else if(vedios_arr[i].vedio_type == 'dailymotion')
                    {
                        postHtml += '<img src="'+vedios_arr[i].image_url+'" data-toggle="modal" data-target="#vedioModal" data-url="'+vedios_arr[i].vedio_url+'"  class="border-rounded vedio-modal">';
                    }
                    else if(vedios_arr[i].vedio_type == 'vimeo')
                    {
                        postHtml += '<img src="'+vedios_arr[i].image_url+'" data-toggle="modal" data-target="#vedioModal" data-url="'+vedios_arr[i].vedio_url+'" class="border-rounded vedio-modal">';
                    }
                    postHtml += '</a>';
                    postHtml += '<div class="font-size-11 text-muted" style="margin-top: 5px;">';
                    postHtml += '<div class="post_vedio_author">';
                    postHtml += vedios_arr[i].title;
                    postHtml += '</div>';
                    postHtml += '<div class="vedio_detail">';
                    postHtml += '<a href="'+profile_url+'"><i class="fa fa-user"></i>&nbsp;'+vedios_arr[i].user_name+'</a>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-video-camera"></i>&nbsp;'+vedios_arr[i].vedio_type.charAt(0).toUpperCase()+vedios_arr[i].vedio_type.slice(1);
                    postHtml += '</div>';
                    postHtml += '</div>';
                    postHtml += '</div>';
                    postHtml += '</div>';

                }
            }

            if(json.hasOwnProperty('posts'))
            {
                var posts = json.posts;
                var additional_info = json.additional_info;
                if(Object.keys(posts).length > 0)
                {
                    $('#article_count').text(Object.keys(posts).length);
                    for (var key in posts) 
                    {
                        if(posts[key].post_type == 'text')
                        {
                            var profile_url = "{{ route('fan.view.talent.profile',['']) }}/"+posts[key].user_id;
                            postHtml += '<div class="panel">';
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
                            postHtml += '<p>By <a href="'+profile_url+'">'+posts[key].user_name+'</a></p>';
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
                            postHtml += '</div>';
                        }
                    }
                }
                $('#posts').html(postHtml);
            }

        });
    }

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