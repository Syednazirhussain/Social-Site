@extends('local.default')

@section('css')

<style type="text/css">
    .recent-work-wrap img {
        height: 250px;
    }
    .img_bx {
        height: 200px;
    }
</style>

@endsection


@section('content')

    <div class="page-title" style='background-image: url("{{ asset("/theme/images/page-title.png") }}")'>
        <h1 class="banner-heading">Discover</h1>
    </div>

    <section id="recent-works">
        <div class="container">
            <div class="center fadeInDown">
                <h2>Latest Pictures</h2>
            </div>
            <div class="row">
                @if(isset($images))
                    @foreach($images as $image)
                        <div class="col-xs-12 col-sm-6 col-md-4 single-work">
                            <div class="recent-work-wrap">
                                <img class="img-responsive" src="{{ asset('storage/posts/'.$image) }}" alt="">
                                <div class="overlay">
                                    <div class="recent-work-inner">
                                        <a class="preview" href="{{ asset('storage/posts/'.$image) }}" rel="prettyPhoto"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>


    <section>
        <div class="container">
            <div class="center fadeInDown">
                <h2>Latest Videos</h2>
            </div>
            <ul class="list-unstyled video-list-thumbs row">


                @if(isset($vedios))
                    @foreach($vedios as $vedio)
                        <li class="col-md-4 col-sm-4 col-xs-6">
                            <a href="{{ $vedio['vedio_url'] }}" title="{{ $vedio['title'] }}">
                                <div style="background: url({{ $vedio['image_url'] }});background-size: 100%;background-position: center;background-repeat: no-repeat;" class="img_bx">                                   
                                </div>
                                <h2 class="heading_clr">{{ $vedio['title'] }}</h2>
                                <span class="glyphicon glyphicon-play-circle"></span>
                                <span class="duration">{{ $vedio['vedio_type'] }}</span>
                            </a>
                        </li>
                    @endforeach
                @endif

            </ul>
        </div>
    </section>




@endsection