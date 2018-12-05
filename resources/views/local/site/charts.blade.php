@extends('local.default')

@section('content')

<div class="page-title" style='background-image: url("{{ asset("/theme/images/page-title.png") }}")'>
   <h1 class="banner-heading">Charts</h1>
</div>
<section id="services" class="service-item">
   <div class="container">
      <div class="center fadeInDown">
         <h2>Chart Lists</h2>
      </div>

      <div class="row">
      	@if(isset($users))
      		@foreach($users as $user)
			    <div class="col-sm-6 col-md-6">
			        <div class="media services-wrap fadeInDown">
			            <div class="pull-left">
			                  <img class="img-responsive" style="width: 150px;height: 100px" src="{{ asset('storage/users/'.$user->image) }}">
			            </div>
			            <div class="media-body chart-pad">
			                  <h3 class="media-heading">{{ $user->name }}</h3>
			                  <div class="team-social mr-top">
			                  	@if(isset($additionalInfo))
			                  		@foreach($additionalInfo as $info)
			                  			@if($info->facebook != null && $info->user_id == $user->id)
			                  				<a class="fa fa-facebook clr" href="{{$info->facebook}}"></a>
			                  			@endif
			                  			@if($info->instagram != null && $info->user_id == $user->id)
			                  				<a class="fa fa-instagram clr" href="{{$info->instagram}}"></a>
			                  			@endif
			                  			@if($info->linkdin != null && $info->user_id == $user->id)
			                  				<a class="fa fa-linkedin clr" href="{{$info->linkdin}}"></a>
			                  			@endif
			                  			@if($info->twitter != null && $info->user_id == $user->id)
			                  				<a class="fa fa-twitter clr" href="{{$info->twitter}}"></a>
			                  			@endif
			                  		@endforeach
			                  	@endif
			                  </div>
			            </div>
			        </div>
			    </div>
      		@endforeach
      	@endif
		</div>

   </div>
</section>

@if(isset($users))
<section>
   <div class="row">
      <div class="col-md-12 text-center">
      	    {{ $users->links('vendor.pagination.default') }}
      </div>
   </div>
</section>
@endif




@endsection