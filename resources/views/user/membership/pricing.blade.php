@extends('user.dashboard_layout')

@section('content')

<div class="page-title" style='background-image: url("{{ asset("/theme/images/page-title.png") }}")'>
    <h1>Membership Plans</h1>
</div>

<section class="pricing">

<!--     <div class="large-title text-center">        
        <h2>Pricing Table</h2>
        <p>All users on MySpace will know that there are millions of people out there. Every day <br> besides so many people joining this community.</p>
    </div> --> 

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <div class="single-pricing">
                    <span>Start Up</span>
                    <h1>
                        <span>$</span>
                        19
                        <span>/mo</span>
                    </h1>
                    <div class="clearfix">
                        <ul>
                            <li><i class="fa fa-pie-chart"></i> 5 Gb Disk Space</li>
                            <li><i class="fa fa-paper-plane"></i> 1GB Dadicated Ram</li>
                        </ul>
                    </div>
                    <a href="javascript:void(0)">BUY</a>
                </div>
                <div class="single-pricing featured">
                    <span>PayPal</span>
                    <h1>
                        <span>$</span>
                        49
                        <span>/mo</span>
                    </h1>
                    <div class="clearfix">
                        <ul>
                            <li><i class="fa fa-pie-chart"></i> 5 Gb Disk Space</li>
                            <li><i class="fa fa-paper-plane"></i> 1GB Dadicated Ram</li>
                            <li><i class="fa fa-cloud"></i> 1GB Dadicated Ram</li>
                        </ul>
                    </div>
                    <a href="{{ route('user.membership.payment') }}">Subcribe</a>
                </div>
                <div class="single-pricing">
                    <span>Premium</span>
                    <h1>
                        <span>$</span>
                        99
                        <span>/mo</span>
                    </h1>
                    <div class="clearfix">
                        <ul>
                            <li><i class="fa fa-pie-chart"></i> 5 Gb Disk Space</li>
                            <li><i class="fa fa-paper-plane"></i> 1GB Dadicated Ram</li>
                        </ul>
                    </div>
                    <a href="javascript:void(0)">BUY</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection