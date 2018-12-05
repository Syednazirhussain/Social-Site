@extends('local.default')

@section('content')

<div class="page-title" style='background-image: url("{{ asset("/theme/images/page-title.png") }}")'>
   <h1 class="banner-heading">Shows</h1>
</div>
<section id="portfolio">
   <div class="container">
      <div class="center">
         <h2>Local Shows</h2>
      </div>

<!--       <ul class="portfolio-filter text-center">
         <li><a class="btn btn-default active" href="javascript:void(0)" data-filter="*">Today</a></li>
         <li><a class="btn btn-default" href="javascript:void(0)" data-filter=".bootstrap">Tomorrow</a></li>
         <li><a class="btn btn-default" href="javascript:void(0)" data-filter=".html">Weekend</a></li>
      </ul> -->

      <div class="row">
         <div class="portfolio-items">

            @if(isset($events))
               @foreach($events as $event)

                  <div class="portfolio-item apps col-xs-12 col-sm-4 col-md-3 single-work">
                     <div class="media services-wrap fadeInDown">
                        <div class="pull-left">
                           <img class="img-responsive show-img" src="{{ asset('storage/users/'.$event->user->image) }}">
                        </div>
                        <div class="media-body">
                           <h3 class="media-heading">{{ $event->user->name }}</h3>
                           <p class="show-p">
                              {{ $event->title }}
                           </p>
                           <p class="show-p">{{ \Carbon\Carbon::parse($event->start)->format('F d, Y') }}</p>
                        </div>
                     </div>
                  </div>                  

               @endforeach
            @endif



         </div>
      </div>
   </div>
</section>


@endsection