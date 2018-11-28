@extends('local.dashboard_layout')

@section('css')

<style type="text/css">


    .navbar-inverse .navbar-nav>li>a{
        padding: 10px 17px;
        margin: 0px 17px;
    }

    .navbar-inverse .navbar-nav>li>a:hover{
        padding: 10px 17px;
        margin: 0px 17px;
    }
</style>



@endsection

@section('content')

<div class="page-title" style='background-image: url("{{ asset("/theme/images/page-title.png") }}")'>
   <!--  <h1>Membership Plans</h1> -->
</div>

<section class="pricing">

    <div class="large-title text-center">        
        <h2>Thank you to subcribe our platform</h2>
        <p>All users on Creatifny will know that there are millions of people out there. Every day <br> besides so many people joining this community.</p>
    </div> 


</section>

@endsection
