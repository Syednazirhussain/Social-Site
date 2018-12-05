@extends('local.default')

@section('content')

<div class="page-title" style='background-image: url("{{ asset("/theme/images/page-title.png") }}")'>
    <h1 class="banner-heading">Pricing</h1>
</div>


<section class="pricing">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5 text-center">

                <div class="single-pricing featured">
                    <span>Free</span>
                    <h1>
                        <span>$</span>
                        0.0
                        <span>/mo</span>
                    </h1>
                    <div class="clearfix">
                        <ul>
                            <li><i class="fa fa-star"></i>&nbsp;Follow Talents</li>
                        </ul>
                    </div>
                </div>
            </div>
            @if(isset($memberShipPlan))
                <div class="col-md-5 text-center">
                    <div class="single-pricing featured">
                        <span>{{ $memberShipPlan->name }}</span>
                        <h1>
                            <span>$</span>
                            {{ round($memberShipPlan->price,0) }}
                            <span>/mo</span>
                        </h1>
                        <div class="clearfix">
                            <ul>
                                <li><i class="fa fa-paper-plane"></i> Post an articles</li>
                                <li><i class="fa fa-video-camera"></i> Upload videos</li>
                                <li><i class="fa fa-image"></i> Upload photos</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-1"></div>
        </div>
    </div>
</section>




@endsection