@extends('local.default')

@section('content')

    <section id="main-slider" class="no-margin">
        <div class="carousel slide">
            <ol class="carousel-indicators">
                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                <li data-target="#main-slider" data-slide-to="1"></li>
                <li data-target="#main-slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active" style='background-image: url("{{ asset("/theme/images/slider/artist15.png") }}")'>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1">DIY shouldn't mean you're all alone</h1>
                                    <div class="animation animated-item-2">
                                        Build your career with Creatifny easy-to-use services and exclusive industry access.
                                    </div>
                                    <a class="btn-slide animation animated-item-3" href="{{ route('user.login') }}">Join For Free</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="item" style='background-image: url("{{ asset("/theme/images/slider/artist1.jpg") }}")'>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1">DIY shouldn't mean you're all alone</h1>
                                    <div class="animation animated-item-2">
                                        Build your career with Creatifny easy-to-use services and exclusive industry access.
                                    </div>
                                    <a class="btn-slide animation animated-item-3" href="javascript:void(0)">Join For Free</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="prev hidden-xs hidden-sm" href="#main-slider" data-slide="prev">
            <i class="fa fa-chevron-left"></i>
        </a>
        <a class="next hidden-xs hidden-sm" href="#main-slider" data-slide="next">
            <i class="fa fa-chevron-right"></i>
        </a>
    </section>


    <section id="feature">
        <div class="container">
            <div class="center fadeInDown">
                <h2>What makes Creatifny different?</h2>
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>

            <div class="row">
                <div class="features">
                    <div class="col-md-3 col-sm-4 fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <div class="icon">
                                <i class="fa fa-rocket"></i>
                            </div>
                            <h2>Opportunities</h2>
                            <p>Having a baby can be a nerve wracking experience for new</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <div class="icon">
                                <i class="fa fa-check"></i>
                            </div>
                            <h2>Powerful Services</h2>
                            <p>If you are looking for a new way to promote your business that</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <div class="icon">
                                <i class="fa fa-bullhorn"></i>
                            </div>
                            <h2>Innovative A&R</h2>
                            <p>Okay, you’ve decided you want to make money with Affiliate</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <div class="icon">
                                <i class="fa fa-arrows"></i>
                            </div>
                            <h2>Right opportunities</h2>
                            <p>A Pocket PC is a handheld computer, which features many</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonial" class="bg_clr">
        <div class="container">
            <div class="center fadeInDown">
                <h2 class="heading_clr">Popular Artists</h2>
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>
            <div class="testimonial-slider owl-carousel">
                @if(isset($users))
                    @foreach($users as $user)
                    <div class="single-slide">
                        <div class="slide-img">
                            <img src="{{ asset('storage/users/'.$user->image) }}" style="width: 150px;height: 100px">
                        </div>
                        <div class="content">
                            <h4>{{ $user->name }}</h4>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    

    <section id="services middle"class="skill-area service-item" style='background-image: url("{{ asset("/theme/images/fan16.png") }}"); background-attachment: fixed; '>
        <div class="container">
            <div class="center fadeInDown">
                <h2 class="more_fans_clr">More fans. More gigs. More money. Less effort.</h2>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="{{ asset('/theme/images/services/ux.svg') }}">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Opportunities</h3>
                            <p>Hydroderm is the highly desired anti-aging cream on</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="{{ asset('/theme/images/services/web.svg') }}">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Promote It</h3>
                            <p>Hydroderm is the highly desired anti-aging cream on</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="{{ asset('/theme/images/services/motion.svg') }}">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Digital Distribution</h3>
                            <p>Hydroderm is the highly desired anti-aging cream on</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="{{ asset('/theme/images/services/mobile-ui.svg') }}">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Site Builder</h3>
                            <p>Hydroderm is the highly desired anti-aging cream on</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="{{ asset('/theme/images/services/web-app.svg') }}">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Fan Reach</h3>
                            <p>Hydroderm is the highly desired anti-aging cream on</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="{{ asset('/theme/images/services/mobile-ui.svg') }}">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Crowd Review</h3>
                            <p>Hydroderm is the highly desired anti-aging cream on</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<!--     <section id="team-area" class="bg_clr">
        <div class="container">
            <div class="center fadeInDown">
                <h2 class="heading_clr">Blogs</h2>
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 single-team">
                    <div class="inner">
                        <div class="team-img">
                            <img src="{{ asset('/theme/images/artist6.png') }}" alt="">
                        </div>
                        <div class="team-content">
                            <h4>Jeffery Poole</h4>
                            <span class="desg"><Strong>Title</Strong></span>
                            <p>Creative Band Costumes To Rock This Halloween...</p>
                            <a href="javascript:void(0)" class="btn btn-primary">Read More</a>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 single-team">
                    <div class="inner">
                        <div class="team-img">
                            <img src="{{ asset('/theme/images/artist7.png') }}" alt="">
                        </div>
                        <div class="team-content">
                            <h4>Isabelle Dean</h4>
                            <span class="desg"><Strong>Title</Strong></span>
                            <p>Creative Band Costumes To Rock This Halloween...</p>
                            <a href="javascript:void(0)" class="btn btn-primary">Read More</a>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 single-team">
                    <div class="inner">
                        <div class="team-img">
                            <img src="{{ asset('/theme/images/artist8.png') }}" alt="">
                        </div>
                        <div class="team-content">
                            <h4>Mike Kennedy</h4>
                            <span class="desg"><Strong>Title</Strong></span>
                            <p>Creative Band Costumes To Rock This Halloween...</p>
                            <a href="javascript:void(0)" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 single-team">
                    <div class="inner">
                        <div class="team-img">
                            <img src="{{ asset('/theme/images/artist10.png') }}" alt="">
                        </div>
                        <div class="team-content">
                            <h4>Edwin Gross</h4>
                            <span class="desg"><Strong>Title</Strong></span>
                            <p>Creative Band Costumes To Rock This Halloween...</p>
                            <a href="javascript:void(0)" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 single-team">
                    <div class="inner">
                        <div class="team-img">
                            <img src="{{ asset('/theme/images/artist9.png') }}" alt="">
                        </div>
                        <div class="team-content">
                            <h4>Mable Schwartz</h4>
                            <span class="desg"><Strong>Title</Strong></span>
                            <p>Creative Band Costumes To Rock This Halloween...</p>
                            <a href="javascript:void(0)" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 single-team">
                    <div class="inner">
                        <div class="team-img">
                            <img src="{{ asset('/theme/images/artist11.png') }}" alt="">
                        </div>
                        <div class="team-content">
                            <h4>Adele Washington</h4>
                            <span class="desg"><Strong>Title</Strong></span>
                            <p>Creative Band Costumes To Rock This Halloween...</p>
                            <a href="javascript:void(0)" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->


    <section id="services" class="service-item">
        <div class="container">
            <div class="row">

                <div class="col-sm-6 col-md-6">
                    <div class="media services-wrap fadeInDown">
                        <div class="pull-left">
                            <!-- <img class="img-responsive" src="images/services/ux.svg"> -->
                        </div>
                        <div class="media-body">
                            <h2 class="media-heading head_font">Start With Creatifny</h2>
                            <p>Hydroderm is the highly desired anti-aging cream on</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="media services-wrap fadeInDown">
                        <div class="pull-left">

                            <img class="img-responsive" src="{{ asset('/theme/images/services/ux.svg') }}">
                            
                        </div>
                        <div class="media-body pull-right">
                            <a href="{{ route('user.login') }}" class="btn btn-primary btn_font">Start Today</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





@endsection


