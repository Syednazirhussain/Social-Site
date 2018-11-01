@extends('theme2.default')
@section('content')

<meta property="og:title" content="{{ ucfirst($video->name) }}" />
<meta property="og:video" content='



            <?php   if ($video->type == 'youtube') { 
                $url = $video->embed_link;
                if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                    $video_id = $match[1];
                }
                ?>
            <iframe class="video-detail-iframe" src="https://www.youtube.com/embed/<?php echo $video_id; ?>" frameborder="0" allowfullscreen></iframe>
            <?php } elseif ($video->type == 'vimeo') { 
                $vimeo = 'https://vimeo.com/29474908';
                $getVimeoId = (int) substr(parse_url($vimeo, PHP_URL_PATH), 1);
                
                ?>
            <iframe class="video-detail-iframe" src="https://player.vimeo.com/video/<?php echo $getVimeoId; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            <?php } elseif ($video->type == 'dailymotion') { 
                $url = $video->embed_link;
                $lastSegment = basename(parse_url($url, PHP_URL_PATH));
                
                ?>
            <iframe class="video-detail-iframe" frameborder="0" src="//www.dailymotion.com/embed/video/<?php echo strtok(basename($url), '_'); ?>" allowfullscreen></iframe>
            <?php } ?>



' />


<meta property="og:description" content="{{ $video->description }}" />

<section id="sec-3">
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        @if (Auth::user())
        @if ( Auth::user()->user_id == $video->user_id )
        <li><a href="{{ route('user-business-home', array(Auth::user()->user_id) ) }}">{{ ucfirst(Auth::user()->name) }}</a></li>
        <li><a href="{{ route('video-display', array(Auth::user()->user_id) ) }}">My Videos</a></li>
        <li class="active">{{ ucfirst($video->name) }}</li>
        @else
        <li><a href="{{ route('user-business-home', array($video->user_id)) }}">{{ ucfirst($video->user->name) }}</a></li>
        <li><a href="{{ route('video-display', array($video->user_id)) }}">{{ ucfirst($video->user->name) }}'s Videos</a></li>
        <li class="active">{{ ucfirst($video->name) }}</li>
        @endif
        @else
        <li><a href="{{ route('user-business-home') }}">Home</a></li>
        <li><a href="{{ route('video-category') }}">Product Categories</a></li>
        <li><a href="{{ route('video-category-listings', array($video->video_cat_id)) }}">{{ $video->category->title }}</a></li>
        <li class="active">{{ ucfirst($video->name) }}</li>
        @endif
    </ol>
    <div class="row">
        <div class="col-md-8" style="margin-top: 28px">
            


            <?php   if ($video->type == 'youtube') { 
                $url = $video->embed_link;
                if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                    $video_id = $match[1];
                }
                ?>
            <iframe class="video-detail-iframe" src="https://www.youtube.com/embed/<?php echo $video_id; ?>" frameborder="0" allowfullscreen></iframe>
            <?php } elseif ($video->type == 'vimeo') { 
                $vimeo = 'https://vimeo.com/29474908';
                $getVimeoId = (int) substr(parse_url($vimeo, PHP_URL_PATH), 1);
                
                ?>
            <iframe class="video-detail-iframe" src="https://player.vimeo.com/video/<?php echo $getVimeoId; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            <?php } elseif ($video->type == 'dailymotion') { 
                $url = $video->embed_link;
                $lastSegment = basename(parse_url($url, PHP_URL_PATH));
                
                ?>
            <iframe class="video-detail-iframe" frameborder="0" src="//www.dailymotion.com/embed/video/<?php echo strtok(basename($url), '_'); ?>" allowfullscreen></iframe>
            <?php } ?>



            <div class="row row-verticle-align" style="margin-top: 10px;">
                <div class="col-sm-9 col-md-9">
                    <p>Posted by <strong><a href="{{ route('user-business-home', array($video->user_id)) }}"><i class="fa fa-user-circle-o"></i> {{ ucfirst($video->user->name) }}</a></strong>, {{  App\Models\Video::timeAgo( $video->created_at )  }} <i class="fa fa-long-arrow-right"></i> <strong><a href="{{ route('video-category-listings', array($video->video_cat_id)) }}">{{ $video->category->title }}</a></strong></p>
                </div>
                <!-- col-sm-9 col-md-9 -->

                <div class="col-sm-3 col-md-3">
                    <span class="label label-primary float-right font-16" style="border-radius: 15px 0 0 15px;">{{$video->views}} views</span>
                </div>
                <!-- col-sm-3 col-md-3 -->
            </div>
            <!-- row -->

            <span class="anchor-black"><div class="addthis_inline_share_toolbox_8id3"></div></span> 
            <span class="anchor-black"><a href="" data-toggle="modal" data-target="#myModal3"><i class="fa fa-flag color-blue"></i> Report</a></span>



    <!-- Modal Report START-->
    <div class="modal fade" id="myModal3" role="dialog">
        <div class="modal-dialog" id="glass-effect-mod">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Help Us Understand What's Happening </h3>
                </div>
                <div class="modal-body">
                    <h1 id="report-msg" style="text-align: center; color: #ccc; display: none;">Your complain has been sent to the site administrator..<br> Thank you..</h1>
                    <center><img id="report-loader-img" style="display: none;" src="{{ asset('public/frontend/theme2/images/hourglass.gif') }}"></center>
                    <form action="" method="POST" id="report-form">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="entity_id" id="entity_id" value="{{ $video->video_id }}">                        
                        <input type="hidden" name="entity_type" id="entity_type" value="Video">                        
                        <input type="hidden" name="report_type" id="report_type" value="">                        
                        <input type="hidden" name="detail" id="detail" value="">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>What's going on?</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-2"><input type="radio" name="report_type" id="report_type" value="offensive"> Offensive or abusive content</div>
                            <div class="col-md-10 col-md-offset-2"><input type="radio" name="report_type" id="report_type" value="copyrights"> Contains copyrighted material</div>
                            <div class="col-md-10 col-md-offset-2"><input type="radio" name="report_type" id="report_type" value="personal"> Contains another person’s personal info</div>
                            <div class="col-md-10 col-md-offset-2"><input type="radio" name="report_type" id="report_type" value="spam"> Its Spam</div>
                            <div class="col-md-10 col-md-offset-2"><input type="radio" name="report_type" id="report_type" value="others" checked=""> Others</div>
                            <br><br>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group"><span class="input-group-addon form-pre"><i class="glyphicon glyphicon-comment"></i></span>
                                    <textarea name="detail" id="detail" rows="5" class="form-control" placeholder="Tell us what's going on... between 20-1000 characters"></textarea>
                                </div>
                                <div class="field-error"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button id="report-btn" type="submit" class="btn btn-search btn-block" style="margin-top: 10px; height:45px;"><span style="font-size: 18px;">Submit Report <i class="fa fa-angle-double-right"></i></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $("#report-form").validate({
            
                rules: {
            
                    detail: {
                        required: true,
                        rangelength: [20, 1000]
                    }
            
                },
            
                errorPlacement: function(error, element) {
                                error.appendTo( element.parent("div").next("div"));
                },
            
                messages: {
            
                    detail: {
            
                        required: "Complain message is required.",
                        rangelength: "Complain message should be in between 20 to 1000 characters in length."
            
                    }
                },
                submitHandler: function(){
            
                    entity_id = $('#entity_id').val();
                    entity_type = $('#entity_type').val();
                    report_type = $('input[name=report_type]:checked').val();
                    detail = $('textarea#detail').val();
            
                    $.ajax({
                            url: "{{ route('report-business', [$video->video_id]) }}",
                            type: "POST",
                            data: { entity_id: entity_id, entity_type: entity_type, report_type: report_type, detail: detail, _token: "{{ csrf_token() }}" },
                            dataType: 'json',
                            cache: "false",
                            beforeSend: function() {
                                $('#report-btn').text('Processing..');
                                $('#report-btn').attr('disabled', 'disabled');
                                $('#report-loader-img').show();
                              },
                            complete: function() {
                                $('#report-loader-img').hide();
                                $('#report-form').hide();
                                $('#report-btn').hide();
                                $('#report-msg').show();
                            }
            
                        }).done(function(r) {
            
                            if (r.success == 1) {
            
                                $('#report-loader-img').hide();
                                $('#report-form').hide();
                                $('#report-btn').hide();
                                $('#report-msg').show();
                               
                            } else {
                               // $('#feedback-error-msg').show();
                            }
            
                        });
            
                } // end submit handler
            }); 
            
        </script>
    </div>
    <!-- Modal Report END-->
    



            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <center>
                                <h1 class="modal-title"> <i class="fa fa-exclamation-triangle" style="color: gold;"></i></h1>
                            </center>
                            <center>
                                <h2 style="color: #000; font-size: 30px;">Do you want to delete this <span style="color: #0061a1">Video?</span></h2>
                            </center>
                            <br>
                            <div style="text-align: center;">
                                <a href="" class="btn btn-default" id="modal-delete-btn" style="background-color: red; color: #fff;">Delete</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Delete Modal -->

            <div class="row">
                <div class="col-sm-9 col-md-9">
                    
                </div>
            </div>

            <div class="row row-verticle-align">
                <div class="col-sm-9 col-md-9">
                    <h4><strong>{{ ucfirst($video->name) }}</strong></h4>

                    @if(Auth::id() == $video->user_id)
                    <p class="business-category-txt" >
                        <a href="{{ route('video-edit', array($video->video_id)) }}"><i class="fa fa-pencil-square-o fa-lg" title="edit"></i></a>
                        <a href="" class="delete-icon" style="margin-left: 5px; color: red" data-toggle="modal" data-id="{{ $video->video_id }}" data-target="#deleteModal"><i class="fa fa-trash fa-lg" title="delete"></i> </a>
                    </p>
                    @endif
                    <ul class="product-detail-tag">
                        <li>
                            <ul class="prod-tag-ul">
                                @foreach($tags as $tag)
                                <li class="prod-tag-li">
                                    <i class="fa fa-tag"></i> {{ $tag }}
                                </li>
                                @endforeach 
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- col-sm-9 col-md-9 -->
                @if (Auth::user())
                <input type="hidden" id="v_like" name="v_like" value="">
                <input type="hidden" id="v_dislike" name="v_dislike" value="">
                <div class="col-sm-3 col-md-3">
                    <a href="" type="button" id="dislike" class="btn btn-primary btn3d " style="float: right;"><span class="glyphicon glyphicon-thumbs-down"></span>&nbsp;&nbsp;{{ $videoDislikeCount }}</a>
                    <a href="" type="button" id="like" class="btn btn-primary btn3d" style="float: right;"><span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;&nbsp;{{ $videoLikeCount }}</a>
                </div>
                <!-- col-sm-3 col-md-3 -->
                @endif
                <script>
                    $('#like').on('click', function(e){
                        $('#v_like').val('1');
                        $('#v_dislike').val('0');
                    });
                    
                    $('#dislike').on('click', function(e){
                        $('#v_like').val('0');
                        $('#v_dislike').val('1');
                    });
                    
                </script>
                <script>
                    $('#like').on('click', function(e) {
                    
                      e.preventDefault();
                    
                      v_like    = $('#v_like').val();
                      v_dislike = $('#v_dislike').val();
                    
                      alert (v_like);
                      alert (v_dislike);
                    
                    
                      $.ajax({
                    
                          url: "{{ route('video-hits', array($video->video_id)) }}",
                          data: { v_like: v_like, v_dislike: v_dislike, _token: '{{ csrf_token() }}' },
                          dataType: 'json',
                          type: "POST",
                          cache: "false",
                          beforeSend: function() { 
                                        $('#like').attr('disabled', 'disabled');
                                      } 
                    
                       }).done(function(r) {
                          
                        if (result.success == 1) {
                            alert('request completed');
                        } else {
                            alert('request ERROR');
                        }
                         
                    
                       });
                        
                    });
                    
                    
                    $('#dislike').on('click', function(e) {
                    
                      e.preventDefault();
                    
                      v_like    = $('#v_like').val();
                      v_dislike = $('#v_dislike').val();
                    
                      alert (v_like);
                      alert (v_dislike);
                    
                    
                      $.ajax({
                    
                          url: "{{ route('video-hits', array($video->video_id)) }}",
                          data: { v_like: v_like, v_dislike: v_dislike, _token: '{{ csrf_token() }}' },
                          dataType: 'json',
                          type: "POST",
                          cache: "false",
                          beforeSend: function() { 
                                        $('#dislike').attr('disabled', 'disabled');
                                      } 
                    
                       }).done(function(r) {
                          
                        if (result.success == 1) {
                            alert('request completed');
                        } else {
                            alert('request ERROR');
                        }
                         
                    
                       });
                        
                    });
                    
                </script>
            </div>
            <!-- row row-verticle-align -->
            <p class="business-detail-txt">{{ $video->description }}</p>
            @if (Auth::user())
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-success alert-dismissable" id="success-alert" style="display: none;"">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Your comment will be appear soon..</strong>
                    </div>
                    <form action="" id="video_comment_form" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="comment" id="textarea2" value="">
                        <input type="hidden" name="video_id" id="video_id" value="{{ $video->video_id }}">
                        <div class="input-group">
                            <textarea id="textarea2" class="form-control comment-textarea" name="comment" placeholder="Leave Comment..." rows="4" cols="100%"></textarea>
                        </div>
                        <div class="field-error"></div>
                        <button id="btn-comment" type="submit" class="btn btn-search" style="margin: 10px; float: right;">Comment</button>
                    </form>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-4">
                    <h4><strong>Comments ({{ $videoCommentsCount }})</strong></h4>
                </div>
                <div class="col-md-8">
                    <ul class = "pagination pagination-sm" style="float: right; margin-top: -10px;">
                        {!! str_replace('/?', '?', $videoComments->render()) !!}
                    </ul>
                </div>
            </div>
            @foreach($videoComments as $videoComment)
            <input type="hidden" id="parent_comment_id" name="parent_comment_id" value="">
            <div class="row comment-box">
                <div class="col-md-1"><img class="img-circle" src="{{asset('public/frontend/theme2/images/nopic.png')}}"></div>
                <div class="col-md-11">
                    <p style="margin: 0;"><strong><a href="{{ route('user-business-home', array($videoComment->user->user_id)) }}">{{ ucfirst($videoComment->user->name) }}</a></strong> <span style="float: right; font-size: 12px;">{{ $videoComment->created_at->format('F d, Y - h:i A') }}</span></p>
                    <p>{{ $videoComment->comment }}</p>
                    <p><a class="reply" id="parent_comment_id" href="" data-attr="{{ $videoComment->comment_id }}" ><i class="fa fa-reply"></i> Reply</a></p>
                </div>
            </div>
            <?php  
                $childComments = App\Models\VideoComment::where('parent_comment_id', $videoComment->comment_id)->get();
                ?> 
            @foreach($childComments as $childComment)
            <div class="row comment-box" style="margin: 5px !important;">
                <div style="width: 90%; float: right; ">
                    <div class="col-md-1"><img class="img-circle" src="{{asset('public/frontend/theme2/images/nopic.png')}}"></div>
                    <div class="col-md-11">
                        <p style="margin: 0;"><strong><a href="{{ route('user-business-home', array($childComment->user->user_id)) }}">{{ ucfirst($childComment->user->name) }}</a></strong> <span style="float: right; font-size: 12px;">{{ $childComment->created_at->format('F d, Y - h:i A') }}</span></p>
                        <p>{{ $childComment->comment }}</p>
                        <p><a class="reply" data-attr="{{ $videoComment->comment_id }}" id="top2" role="button" href=""><i class="fa fa-reply"></i> Reply</a></p>
                    </div>
                </div>
            </div>
            @endforeach
            @endforeach
            <div class="row">
                <div class="col-md-12">
                    <ul class = "pagination pagination-sm" style="float: right;">
                        {!! str_replace('/?', '?', $videoComments->render()) !!}
                    </ul>
                </div>
            </div>
        </div>
        <!-- col-md-8 -->
        <script type="text/javascript">
            $('.reply').on('click', function(e){
                commentReply = $(this).attr('data-attr');
               // alert(commentReply);
               // return false;
                $('#parent_comment_id').val(commentReply);
            
                $('html, body').animate({
                      scrollTop: $(".comment-textarea").offset().top - 200
                }, 800);       
            
                $(".comment-textarea").focus();
            });
        </script>
        <script>
            $(document).ready(function(e) {
            
                $("#video_comment_form").validate({
            
                  rules: {
            
                    comment: {
                        required: true,
                        rangelength: [5, 500],
                    }
            
                  },
            
                  errorPlacement: function(error, element) {
                                        error.appendTo( element.parent("div").next("div"));
                  },
                  messages: {
            
                    comment: {
            
                      required: "Comment is required.",
                      rangelength: "Comment should be in between 5 to 500 characters in length."
            
                     },
            
                    },
            
                    submitHandler: function() {
            
            
            
                        comment = $('textarea#textarea2').val();
                        video_id = $('#video_id').val();
                        parent_comment_id = $('#parent_comment_id').val();
            
                        if(parent_comment_id == "") {
                           parent_comment_id = '0';  
                        }
            
                      
            
                        // return false;
            
                        $.ajax({
                                url: "{{ route('video-comment-save', array($video->video_id)) }}",
                                type: "POST",
                                data: { comment: comment, video_id: video_id, _token: "{{ csrf_token() }}", parent_comment_id: parent_comment_id },
                                dataType: 'json',
                                cache: "false",
                                beforeSend: function() {
                                    $('#btn-comment').text('Processing..');
                                    $('#btn-comment').attr('disabled', 'disabled');
                                    $("#success-alert").hide();
                                  }
                            }).done(function(result) {
            
                                if (result.success == 1) {
                                    
                                    $('#btn-comment').text('Comment..');
                                    $('#btn-comment').removeAttr('disabled');
            
                                    $("#success-alert").alert();
                                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
                                        $("#success-alert").slideUp(500);
                                    }); 
            
                                    $('#parent_comment_id').val('0');
                                    $('#textarea2').val('');
            
                                } else {
            
                                    alert('There is no response from server..');
            
                                }
            
                            });
            
                    } // end submit handler
                
                }); 
            
            
            });
             
        </script>
        <div class="col-md-4">
            <div class="col-sm-6 col-md-10 col-md-offset-1 ">
                <h4><strong>Related Videos</strong></h4>
            </div>
            <ul class="row video-list-thumbs" style="margin: 0; padding: 0">
                <!-- VIDEO LISTINGS  -->
                @foreach($relatedVideos as $relatedVideo)
                <?php
                    ?>
                <li class="col-sm-6 col-md-10 col-md-offset-1 " style="padding: 10px 10px;">
                    <a href="{{ route('video-description', array($relatedVideo->video_id)) }}">
                        <?php   if ($relatedVideo->type == 'youtube')    {   
                            $url = $relatedVideo->embed_link;
                            
                                if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                                    $video_id = $match[1];
                                }
                            
                            ?>  
                        <!-- utube video thumbnail -->
                        <img src="https://img.youtube.com/vi/<?php echo $video_id; ?>/sddefault.jpg" class="img-responsive" style="height: 190px; width: 100%;">
                        <!-- utube video player -->
                        <!-- <iframe width="100%" height="190" src="https://www.youtube.com/embed/<?php echo $video_id; ?>" frameborder="0" allowfullscreen></iframe> -->
                        <?php   } elseif ($relatedVideo->type == 'vimeo') { 
                            $vimeo = $relatedVideo->embed_link; 
                            $vimeoGetID = (int) substr(parse_url($vimeo, PHP_URL_PATH), 1);
                            $url = 'http://vimeo.com/api/v2/video/'.$vimeoGetID.'.php';
                            $contents = @file_get_contents($url);
                            $array = @unserialize(trim($contents));
                            
                            ?>
                        <!-- vimeo video thumbnail -->
                        <img src="<?php echo $array[0]['thumbnail_large']; ?>" class="img-responsive" style="height: 190px; width: 100%;">
                        <?php   } elseif ($relatedVideo->type == 'dailymotion') { 
                            $url = $relatedVideo->embed_link;
                            
                            $lastSegment = basename(parse_url($url, PHP_URL_PATH));
                            
                            $url = explode("_", $lastSegment); 
                            
                            ?>
                        <!-- dailymotion video thumbnail -->
                        <img src="http://www.dailymotion.com/thumbnail/video/<?php echo $url[0]; ?>" class="img-responsive" style="height: 190px; width: 100%;">
                        <!-- <iframe frameborder="0" width="100%" height="190" src="//www.dailymotion.com/embed/video/<?php //echo strtok(basename($url), '_'); ?>" allowfullscreen></iframe> -->
                        <?php   } ?>
                        <h5 class="business-listing" style="margin-bottom: 0;">{{ ucfirst($relatedVideo->name) }}</h5>
                        <span class="glyphicon glyphicon-play-circle"></span>
                        <!-- <span class="duration">03:15</span> -->
                    </a>
                    <p  style="font-size: 12px; margin: 0 !important;"><a href="{{ route('user-business-home', array($relatedVideo->user_id)) }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ ucfirst($relatedVideo->user->name) }}</a></p>
                    <p  style="font-size: 12px; margin: 0 !important;">
                        <span>{{  App\Models\Video::timeAgo( $relatedVideo->created_at )  }}</span>  
                        <span style="float: right;"> {{$relatedVideo->views}} Views</span>
                    </p>
                </li>
                @endforeach
            </ul>
        </div>
        <!-- col-md-4 -->
    </div>
    <!-- row -->
</section>
<script>
    $('.delete-icon').on('click', function(){
      dataid = $(this).attr('data-id');
    
      url = "{{ route('video-delete', array("")) }}/"+dataid;
    
      $('#modal-delete-btn').attr('href', url);
    
    });
    
</script>




<!-- Go to www.addthis.com/dashboard to customize your tools --> 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58832e09508b89e7"></script> 



@endsection