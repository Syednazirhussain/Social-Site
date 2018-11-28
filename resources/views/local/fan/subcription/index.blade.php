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
</style>

@endsection

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
                @if(Session::has('errorMsg'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ Session::get('errorMsg') }}</strong> 
                    </div>
                @endif
                @if(Session::has('successMsg'))
                  <div class="alert alert-success alert-dismissable" style="text-align: center;">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <h4 class="m-t-0 m-b-0"><strong><i class="fa fa-check-circle fa-lg"></i>&nbsp;&nbsp;{{ Session::get('successMsg') }}</strong></h4>
                  </div>
                @endif
                <div class="single-pricing featured">
                    <span>PayPal</span>
                    <h1>
                        <span>$</span>
                        @if(isset($amount)){{ round($amount,0)}}@endif
                        <span>/mo</span>
                    </h1>
                    <div class="clearfix">
                        <ul>
                            <li><i class="fa fa-paper-plane"></i> Post an articles</li>
                            <li><i class="fa fa-video-camera"></i> Upload videos</li>
                            <li><i class="fa fa-image"></i> Upload photos</li>
                        </ul>
                    </div>
                    <form action="{{ route('fan.subcription.request') }}" method="POST" id="subcription">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user_id" value="@if(isset($user_id)){{ $user_id }}@endif">
                        <input type="hidden" name="planCode" value="@if(isset($planCode)){{ $planCode }}@endif">
                        <input class="btn btn-primary" id="subcribe" type="submit" value="Subcribe">               
                    </form>
<!--                     <a href="javascript:void(0)">Subcribe</a> -->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')

<script type="text/javascript">
    

    $('#subcription').submit(function(e){

        $('#subcribe').prop('disabled',true);

        $(this).submit();

        e.preventDefault();

    });

</script>

@endsection