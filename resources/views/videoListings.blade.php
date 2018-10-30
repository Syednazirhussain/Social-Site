

@if(count($listings) > '0')



    <div class="row">

        <div class="col-md-4">
            <p>

                <?php     
                if(isset($_GET['page'])) {

                    $page  =  $_GET['page'];

                    $pagee = $page; // 2
                    $start_row = $resultsPerPage * ($pagee - 1);  // 10  

                    $j = $start_row;

                    $j+= $resultsPerPage;  // 10 

                ?>   

                    Showing <?php echo ++$start_row;  ?> to <?php echo $j;  ?> out of <?php  
                    echo COUNT($listings); ?> videos

                <?php } else { $start_row =  1; ?>    

                    Showing <?php echo $start_row;  ?> to <?php echo $resultsPerPage;  ?> out of <?php  
                    echo COUNT($listings); ?> videos    

                <?php  }   ?>

            </p>
        </div>              

        <div class="col-md-4 col-md-offset-4">
            <ul class = "pagination pagination-sm" style="float: right; margin: -15px 0">

                {!! ($listings->render()) !!}

            </ul>
        </div>

    </div>

    <input type="hidden" name="status" id="status" value="{{ $status }}">



    <ul class="row video-list-thumbs " style="margin: 0; padding: 0">

        <!-- VIDEO LISTINGS  -->
        @foreach($listings as $listing)

        <li class="col-sm-6 col-md-3" style="padding: 10px 10px;">
            
            <a href="{{ route('video-description', array($listing->video_id)) }}">

                <?php   if ($listing->type == 'youtube')    {   

                    $url = $listing->embed_link;

                        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                            $video_id = $match[1];
                        }

                ?>  
                    <!-- utube video thumbnail -->
                    <img src="https://img.youtube.com/vi/<?php echo $video_id; ?>/sddefault.jpg" class="img-responsive" style="height: 190px; width: 100%;">
                    
                    <!-- utube video player -->
                    <!-- <iframe width="100%" height="190" src="https://www.youtube.com/embed/<?php echo $video_id; ?>" frameborder="0" allowfullscreen></iframe> -->
                    
                <?php   } elseif ($listing->type == 'vimeo') { 

                    $vimeo = $listing->embed_link; 
                    $vimeoGetID = (int) substr(parse_url($vimeo, PHP_URL_PATH), 1);
                    $url = 'http://vimeo.com/api/v2/video/'.$vimeoGetID.'.php';
                    $contents = @file_get_contents($url);
                    $array = @unserialize(trim($contents));

                ?>

                    <!-- vimeo video thumbnail -->
                    <img src="<?php echo $array[0]['thumbnail_large']; ?>" class="img-responsive" style="height: 190px; width: 100%;">
                    
                
                <?php   } elseif ($listing->type == 'dailymotion') { 

                    $url = $listing->embed_link;

                    $lastSegment = basename(parse_url($url, PHP_URL_PATH));

                    $url = explode("_", $lastSegment); 

                ?>

                    <!-- dailymotion video thumbnail -->
                    <img src="http://www.dailymotion.com/thumbnail/video/<?php echo $url[0]; ?>" class="img-responsive" style="height: 190px; width: 100%;">

                    <!-- <iframe frameborder="0" width="100%" height="190" src="//www.dailymotion.com/embed/video/<?php //echo strtok(basename($url), '_'); ?>" allowfullscreen></iframe> -->

                <?php   } ?>
                        
                <h5 class="business-listing" style="margin-bottom: 0;">{{ ucfirst($listing->name) }}</h5>
                <span class="glyphicon glyphicon-play-circle"></span>
                <!-- <span class="duration">03:15</span> -->
            </a> 


            <p  style="font-size: 12px; margin: 0 !important;"><a href="{{ route('user-business-home', array($listing->user_id)) }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ ucfirst($listing->user->name) }}</a></p>
            <p  style="font-size: 12px; margin: 0 !important;">
                <span>{{  App\Models\Video::timeAgo( $listing->created_at )  }}</span>  
                <span style="float: right;">{{$listing->views}} Views</span>
            </p>

            @if ( Auth::user()->user_id == $userInfo->user_id )
            <p class="business-category-txt" >
              <a href="{{ route('video-edit', array($listing->video_id)) }}"><i class="fa fa-pencil-square-o fa-lg" title="edit"></i></a>
              <a href="" class="delete-icon" style="margin-left: 5px; color: red" data-toggle="modal" data-id="{{ $listing->video_id }}" data-target="#deleteModal"><i class="fa fa-trash fa-lg" title="delete"></i> </a>
            </p>
            @endif

        </li>
        @endforeach

    </ul>




         <!-- Delete Modal -->
          <div class="modal fade" id="deleteModal" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <center><h1 class="modal-title"> <i class="fa fa-exclamation-triangle" style="color: gold;"></i></h1></center>
                
                  <center><h2 style="color: #000; font-size: 30px;">Do you want to delete this <span style="color: #0061a1">Video?</span></h2></center>
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

        <div class="col-md-4">
            <p>

                <?php     
                if(isset($_GET['page'])) {

                    $page  =  $_GET['page'];

                    $pagee = $page; // 2
                    $start_row = $resultsPerPage * ($pagee - 1);  // 10  

                    $j = $start_row;

                    $j+= $resultsPerPage;  // 10 

                ?>   

                    Showing <?php echo ++$start_row;  ?> to <?php echo $j;  ?> out of <?php  
                    echo COUNT($listings); ?> videos

                <?php } else { $start_row =  1; ?>    

                    Showing <?php echo $start_row;  ?> to <?php echo $resultsPerPage;  ?> out of <?php  
                    echo COUNT($listings); ?> videos    

                <?php  }   ?>

            </p>
        </div>              

        <div class="col-md-4 col-md-offset-4">
            <ul class = "pagination pagination-sm" style="float: right; margin: -15px 0">

                {!! ($listings->render()) !!}

            </ul>
        </div>

    </div>



    @else

    <h1 style="text-align: center; color: #dddddd">No Video Available</h1>

    @endif
        

    <script>
      
        $('.delete-icon').on('click', function(){
          dataid = $(this).attr('data-id');

          url = "{{ route('video-delete', array("")) }}/"+dataid;

          $('#modal-delete-btn').attr('href', url);

        });

    </script>