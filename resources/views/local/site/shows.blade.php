@extends('local.default')

@section('css')

<style type="text/css">

    .event-list {
      list-style: none;
      font-family: "Open Sans","Helvetica Neue",Helvetica,Arial,sans-serif;
      margin: 0 0 35px 0px;
      padding: 0px;
   }
   .event-list > li {
      background-color: rgb(255, 255, 255);
      padding: 0px;
      margin: 0px 0px 20px;
   }
   .event-list > li > time {
      display: inline-block;
      width: 100%;
      color: rgb(255, 255, 255);
      background-color: rgb(58, 158, 224);
      padding: 5px;
      text-align: center;
      text-transform: uppercase;
   }
   .event-list > li:nth-child(even) > time {
      background-color: rgb(165, 82, 167);
   }
   .event-list > li > time > span {
      display: none;
   }
   .event-list > li > time > .day {
      padding: 12px 0px 5px 0px;
    display: block;
    font-size: 32pt;
    line-height: 1;
    font-weight: 400;
   }
   .event-list > li time > .month {
      padding: 0px 0px;
       display: block;
       font-size: 10pt;
       font-weight: 500;
       line-height: 1;
   }
   .event-list > li time > .year {
       padding: 5px 0px 8px 0px;
       display: block;
       font-size: 22pt;
       font-weight: 600;
       line-height: 1;
       color: #1b79b6;
       letter-spacing: 0px;
   }
   .event-list > li > img {
      width: 100%;
   }
   .event-list > li > .info {
      padding-top: 30px;
      text-align: center;
   }
   .event-list > li > .info > .title {
      text-transform: capitalize;
    font-size: 17pt;
    font-weight: 200;
    margin: 0 0 -5px 0px;
   }
   .event-list > li > .info > .desc {
          font-size: 9pt;
    font-weight: 700;
    margin: 0px;
    text-transform: uppercase;
    color: #3a9ee0;
   }
   .event-list > li > .info > ul,
   .event-list > li > .social > ul {
      display: table;
      list-style: none;
      margin: 10px 0px 0px;
      padding: 0px;
      width: 100%;
      text-align: center;
      
   }
   .event-list > li > .social > ul {
      margin: 0px;
   }
   .event-list > li > .info > ul > li,
   .event-list > li > .social > ul > li {
      display: table-cell;
      cursor: pointer;
      color: rgb(30, 30, 30);
      font-size: 11pt;
      font-weight: 300;
        padding: 3px 0px;
   }
    .event-list > li > .info > ul > li > a {
      display: block;
      width: 100%;
      color: rgb(30, 30, 30);
      text-decoration: none;
   } 
    .event-list > li > .social > ul > li {    
        padding: 0px;
    }
    .event-list > li > .social > ul > li > a {
        padding: 3px 0px;
   } 
   .event-list > li > .info > ul > li:hover,
   .event-list > li > .social > ul > li:hover {
      color: rgb(30, 30, 30);
      background-color: rgb(200, 200, 200);
   }
   .edit a,
   .confirm a,
   .delete a {
      display: block;
      width: 100%;
      color: rgb(75, 110, 168) !important;
   }
   .confirm a {
      color: rgb(79, 213, 248) !important;
   }
   .delete a {
      color: rgb(221, 75, 57) !important;
   }
   .edit:hover a {
      color: rgb(255, 255, 255) !important;
      background-color: rgb(75, 110, 168) !important;
   }
   .confirm:hover a {
      color: rgb(255, 255, 255) !important;
      background-color: rgb(79, 213, 248) !important;
   }
   .delete:hover a {
      color: rgb(255, 255, 255) !important;
      background-color: rgb(221, 75, 57) !important;
   }

   @media (min-width: 768px) {
      .event-list > li {
         position: relative;
         display: block;
         width: 100%;
         height: 120px;
         padding: 0px;
      }
      .event-list > li > time,
      .event-list > li > img  {
         display: inline-block;
      }
      .event-list > li > time,
      .event-list > li > img {
         width: 120px;
         float: left;
      }
      .event-list > li > .info {
         background-color: rgb(248, 248, 248);
         overflow: hidden;
      }
      .event-list > li > time,
      .event-list > li > img {
         width: 120px;
         height: 120px;
         padding: 0px;
         margin: 0px;
      }
      .event-list > li > .info {
         position: relative;
         height: 120px;
         text-align: left;
         padding-right: 40px;
      }  
      .event-list > li > .info > .title, 
      .event-list > li > .info > .desc {
         padding: 5px 20px;
      }
      .event-list > li > .info > ul {
         position: absolute;
         left: 0px;
         bottom: 0px;
      }
      .event-list > li > .social {
         position: absolute;
         top: 0px;
         right: 0px;
         display: block;
         width: 40px;
      }
        .event-list > li > .social > ul {
            border-left: 1px solid rgb(230, 230, 230);
        }
      .event-list > li > .social > ul > li {       
         display: block;
            padding: 0px;
      }
      .event-list > li > .social > ul > li > a {
         display: block;
         width: 40px;
         padding: 10px 0px 9px;
      }
   }
</style>

@endsection



@section('content')

<div class="page-title" style='background-image: url("{{ asset("/theme/images/page-title.png") }}")'>
   <h1 class="banner-heading">Shows</h1>
</div>




<section id="portfolio">
   <div class="container">
      <div class="row">
            @if(isset($events))
               @foreach($events as $event)
                  <div class="col-xs-12 col-sm-12 col-md-6">
                     <ul class="event-list">
                        <li>
                           <time>
                              <span class="day">{{ \Carbon\Carbon::parse($event->start)->format('d') }}</span>
                              <span class="month">{{ \Carbon\Carbon::parse($event->start)->format('F') }}</span>
                              <span class="year">{{ \Carbon\Carbon::parse($event->start)->format('Y') }}</span>
                           </time>
                           <img src="{{ asset('storage/users/'.$event->user->image) }}"/>
                           <div class="info">
                              <h2 class="title">{{ $event->title }}</h2>
                              <p class="desc">{{ $event->user->name }}</p>
                           </div>
                        </li>
                     </ul>
                  </div>
               @endforeach
            @endif
      </div>
   </div>



</section>


@endsection