@extends('local.default')

@section('content')

<div class="page-title" style='background-image: url("{{ asset("/theme/images/page-title.png") }}")'>
    <h1 class="banner-heading">Grow twice as fast at a <br> fraction of the cost</h1>
    <p class="text-center banner-p">Everything you need, all in one place, with simple pricing.</p>

     <div class="text-center">
         <a href="{{ route('user.login') }}" class="btn btn-primary btn-lg">Join For Free</a>
     </div>

</div>


<section id="about-us">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="about-img">
                    <img src="{{ asset('/theme/images/about-1.jpg') }}">
                </div>
            </div>
            <div class="col-md-5">
                <div class="about-content">
                    <h2 class="heading-size">Reach millions of fans</h2>
                    <p>Promote your music on the world's most popular music sites and keep fans engaged with simple email and social messaging.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="about-us">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="about-content">
                    <h2 class="heading-size">Be heard and get paid</h2>
                    <p>Easily distribute your tracks to major digital platforms or sell them directly to fans.</p>
                </div>
            </div>
            <div class="col-md-6 pull-right">
                <div class="about-img">
                    <img src="{{ asset('/theme/images/about-2.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about-us">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="about-img">
                    <img src="{{ asset('/theme/images/about-3.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-md-5">
                <div class="about-content">
                    <h2 class="heading-size">Share your music like a pro</h2>
                    <p>Create a mobile-friendly website in just a few clicks, then freshen up your Facebook page with our free app, and share your content anywhere online with customizable widgets.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="about-us">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="about-content">
                    <h2 class="heading-size">Jumpstart your career</h2>
                    <p>Get your momentum going with unbiased fan feedback on your songs, and local and national gig listings.</p>
                </div>
            </div>
            <div class="col-md-6 pull-right">
                <div class="about-img">
                    <img src="{{ asset('/theme/images/about-4.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>


<section id="partner">
    <div class="container">
        <div class="center fadeInDown">
            <h2>Land your dream gig</h2>
            <p class="lead">Get unprecedented access to the industry with hundreds of chances for you to take the <br> next step in your career.</p>
        </div>
        <div class="partners">
            <ul>
                <li>
                    <a href="javascript:void(0)">
                    	<img src="{{ asset('/theme/images/partners/brand-1.png') }}"  class="img-responsive fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                    	<img src="{{ asset('/theme/images/partners/brand-2.png') }}"  class="img-responsive fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                    	<img src="{{ asset('/theme/images/partners/brand-3.png') }}"  class="img-responsive fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms">
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                    	<img  src="{{ asset('/theme/images/partners/brand-4.png') }}" class="img-responsive fadeInDown" data-wow-duration="1000ms" data-wow-delay="1200ms">
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                    	<img  src="{{ asset('/theme/images/partners/brand-5.png') }}" class="img-responsive fadeInDown" data-wow-duration="1000ms" data-wow-delay="1500ms">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>




<section id="partner1">
    <div class="container">
        <div class="center fadeInDown">
            <h3 class="lead heading_clr gradient-section">The team at Creatifny has been a real game changer. I'm getting exposure<br>and opportunities that I never would have before.</h3>
            <p class="heading_clr">
                <img src="{{ asset('/theme/images/img-gradient.png') }}" class="gradient-img">KaiL Baxley, R&B/Soul Swagger/Indie Rock</p>
        </div>
    </div>
</section>

<section id="services" class="service-item">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-8">
                <div class="media services-wrap hvr-clr fadeInDown">
                    <div class="pull-left">
                    </div>
                    <div class="media-body">
                <h2 class="media-heading btm-font">Start growing your career the right way</h2>

                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="media services-wrap hvr-clr fadeInDown">
                    <div class="pull-left">
                    </div>
                    <div class="media-body pull-right">
                        <a href="{{ route('user.login') }}">
                            <button class="fill animated-btn">Join for Free</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection