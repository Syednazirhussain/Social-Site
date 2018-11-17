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
                                    <!-- <a class="btn-slide white animation animated-item-3" href="javascript:void(0)">Get Started</a> -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--/.item-->

                <div class="item" style='background-image: url("{{ asset("/theme/images/slider/artist1.jpg") }}")'>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1">DIY shouldn't mean you're all alone</h1>
                                    <div class="animation animated-item-2">
                                        Build your career with Creatifny easy-to-use services and exclusive industry access.
                                    </div>
                                    <!-- <a class="btn-slide white animation animated-item-3" href="javascript:void(0)">Learn More</a>
                                    <a class="btn-slide animation animated-item-3" href="javascript:void(0)">Get Started</a> -->
                                    <a class="btn-slide animation animated-item-3" href="javascript:void(0)">Join For Free</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!--/.item-->

            </div>
            <!--/.carousel-inner-->
        </div>
        <!--/.carousel-->
        <a class="prev hidden-xs hidden-sm" href="#main-slider" data-slide="prev">
            <i class="fa fa-chevron-left"></i>
        </a>
        <a class="next hidden-xs hidden-sm" href="#main-slider" data-slide="next">
            <i class="fa fa-chevron-right"></i>
        </a>
    </section>
    <!--/#main-slider-->

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
                    <!--/.col-md-3-->
                    <div class="col-md-3 col-sm-4 fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <div class="icon">
                                <i class="fa fa-check"></i>
                            </div>
                            <h2>Powerful Services</h2>
                            <p>If you are looking for a new way to promote your business that</p>
                        </div>
                    </div>
                    <!--/.col-md-3-->
                    <div class="col-md-3 col-sm-4 fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <div class="icon">
                                <i class="fa fa-bullhorn"></i>
                            </div>
                            <h2>Innovative A&R</h2>
                            <p>Okay, you’ve decided you want to make money with Affiliate</p>
                        </div>
                    </div>
                    <!--/.col-md-3-->
                    <div class="col-md-3 col-sm-4 fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <div class="icon">
                                <i class="fa fa-arrows"></i>
                            </div>
                            <h2>Right opportunities</h2>
                            <p>A Pocket PC is a handheld computer, which features many</p>
                        </div>
                    </div>
                    <!--/.col-md-3-->
                </div>
                <!--/.services-->
            </div>
            <!--/.row-->
        </div>
        <!--/.container-->
    </section>
    <!--/#feature-->

    <section id="testimonial" class="bg_clr">
        <div class="container">
            <div class="center fadeInDown">
                <h2 class="heading_clr">Popular Artists</h2>
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>
            <div class="testimonial-slider owl-carousel">
                <div class="single-slide">
                    <div class="slide-img">
                        <img src="{{ asset('/theme/images/client1.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <!-- <img src="images/review.png" alt=""> -->
                        <p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price.</p>
                        <h4>- Charlotte Daniels</h4>
                        <a href="javascript:void(0)" class="btn btn-primary">Follow</a>
                    </div>
                </div>
                <div class="single-slide">
                    <div class="slide-img">
                        <img src="{{ asset('/theme/images/client2.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <!-- <img src="images/review.png" alt=""> -->
                        <p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price.</p>
                        <h4>- Charlotte Daniels</h4>
                        <a href="javascript:void(0)" class="btn btn-primary">Follow</a>
                    </div>
                </div>
                <div class="single-slide">
                    <div class="slide-img">
                        <img src="{{ asset('/theme/images/client3.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <!-- <img src="images/review.png" alt=""> -->
                        <p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price.</p>
                        <h4>- Charlotte Daniels</h4>
                        <a href="javascript:void(0)" class="btn btn-primary">Follow</a>
                    </div>
                </div>
                <div class="single-slide">
                    <div class="slide-img">
                        <img src="{{ asset('/theme/images/client2.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <!-- <img src="images/review.png" alt=""> -->
                        <p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price.</p>
                        <h4>- Charlotte Daniels</h4>
                        <a href="javascript:void(0)" class="btn btn-primary">Follow</a>
                    </div>
                </div>
                <div class="single-slide">
                    <div class="slide-img">
                        <img src="{{ asset('/theme/images/client1.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <!-- <img src="images/review.png" alt=""> -->
                        <p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price.</p>
                        <h4>- Charlotte Daniels</h4>
                        <a href="javascript:void(0)" class="btn btn-primary">Follow</a>
                    </div>
                </div>
                <div class="single-slide">
                    <div class="slide-img">
                        <img src="{{ asset('/theme/images/client3.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <!-- <img src="images/review.png" alt=""> -->
                        <p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price.</p>
                        <h4>- Charlotte Daniels</h4>
                        <a href="javascript:void(0)" class="btn btn-primary">Follow</a>
                    </div>
                </div>
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
            <!--/.row-->
        </div>
        <!--/.container-->
    </section>
    <!--/#services-->

    <section id="team-area" class="bg_clr">
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
                            <!-- <div class="team-social">
                                <a class="fa fa-facebook" href="javascript:void(0)"></a>
                                <a class="fa fa-twitter" href="javascript:void(0)"></a>
                                <a class="fa fa-linkedin" href="javascript:void(0)"></a>
                                <a class="fa fa-pinterest" href="javascript:void(0)"></a>
                            </div> -->
                            
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
                            <!-- <div class="team-social">
                                <a class="fa fa-facebook" href="javascript:void(0)"></a>
                                <a class="fa fa-twitter" href="javascript:void(0)"></a>
                                <a class="fa fa-linkedin" href="javascript:void(0)"></a>
                                <a class="fa fa-pinterest" href="javascript:void(0)"></a>
                            </div> -->
                            
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
                            <!-- <div class="team-social">
                                <a class="fa fa-facebook" href="javascript:void(0)"></a>
                                <a class="fa fa-twitter" href="javascript:void(0)"></a>
                                <a class="fa fa-linkedin" href="javascript:void(0)"></a>
                                <a class="fa fa-pinterest" href="javascript:void(0)"></a>
                            </div> -->
                            
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
                            <!-- <div class="team-social">
                                <a class="fa fa-facebook" href="javascript:void(0)"></a>
                                <a class="fa fa-twitter" href="javascript:void(0)"></a>
                                <a class="fa fa-linkedin" href="javascript:void(0)"></a>
                                <a class="fa fa-pinterest" href="javascript:void(0)"></a>
                            </div> -->
                            
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
                            <!-- <div class="team-social">
                                <a class="fa fa-facebook" href="javascript:void(0)"></a>
                                <a class="fa fa-twitter" href="javascript:void(0)"></a>
                                <a class="fa fa-linkedin" href="javascript:void(0)"></a>
                                <a class="fa fa-pinterest" href="javascript:void(0)"></a>
                            </div> -->
                            
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
                            <!-- <div class="team-social">
                                <a class="fa fa-facebook" href="javascript:void(0)"></a>
                                <a class="fa fa-twitter" href="javascript:void(0)"></a>
                                <a class="fa fa-linkedin" href="javascript:void(0)"></a>
                                <a class="fa fa-pinterest" href="javascript:void(0)"></a>
                            </div> -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="services" class="service-item">
        <div class="container">
            <!-- <div class="center fadeInDown">
                <h2>Our Service</h2>
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div> -->

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
                            <!-- <img class="img-responsive" src="images/services/ux.svg"> -->
                        </div>
                        <div class="media-body pull-right">
                            <a href="javascript:void(0)" class="btn btn-primary btn_font">Start Today</a>
                        </div>
                    </div>
                </div>


            </div>
            <!--/.row-->
        </div>
        <!--/.container-->
    </section>
    <!--/#services-->




    <section id="bottom" class="bg_clr">
        <div class="container fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="row">
                <div class="col-md-2">
                    <a href="javascript:void(0)" class="footer-logo">
                        <img src="{{ asset('/theme/images/logo1.png') }}" alt="logo">
                    </a>
                    <div>
                    <ul class="display_flex">
                        <li class="margin_icons"><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                        <li class="margin_icons"><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                        <li class="margin_icons"><a href="javascript:void(0)"><i class="fa fa-linkedin"></i></a></li>
                        <li class="margin_icons"><a href="javascript:void(0)"><i class="fa fa-dribbble"></i></a></li>
                        <li class="margin_icons"><a href="javascript:void(0)"><i class="fa fa-skype"></i></a></li>
                    </ul>
                    </div>


                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="widget">
                                <h3 class="heading_clr">Creatifny</h3>
                                <ul>
                                    <li><a href="index.html">About</a></li>
                                    <li><a href="#team-area">Blog</a></li>
                                    
                                    
                                    <li><a href="forgot-password.html">Forgot Password</a></li>
                                    <li><a href="contact-us.html">Contact us</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--/.col-md-3-->

                        <div class="col-md-3 col-sm-6">
                            <div class="widget">
                                <h3 class="heading_clr">Artist Membership</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">Overview</a></li>
                                    <li><a href="pricing.html">Pricing</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                        <!--/.col-md-3-->

                        <div class="col-md-3 col-sm-6">
                            <div class="widget">
                                <h3 class="heading_clr">Artist Chart</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">John Doe</a></li>
                                    <li><a href="javascript:void(0)">Henry Robert</a></li>
                                    <li><a href="javascript:void(0)">Peter</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--/.col-md-3-->

                        <div class="col-md-3 col-sm-6">
                            <div class="widget">
                                <h3 class="heading_clr">Policies</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">Copyright</a></li>
                                    <li><a href="javascript:void(0)">Terms of use</a></li>
                                    <li><a href="javascript:void(0)">Privacy policy</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--/.col-md-3-->
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!--/#bottom-->



@endsection


