@extends('admin.default')

@section('content')

<div class="px-content">
	<div class="page-header">
	    <div class="row">
	      <div class="col-md-4 text-xs-center text-md-left text-nowrap">
	        <h1><i class="page-header-icon  ion-ios-home"></i>Dashboard</h1>
	      </div>
	      <hr class="page-wide-block visible-xs visible-sm">
	    </div>
	</div>
   	<div class="row">

      <div class="col-md-3">
        <div class="box bg-info darken">
          <div class="box-cell p-x-3 p-y-1">
            <div class="font-weight-semibold font-size-12">USERS</div>
            <div class="font-weight-bold font-size-20">@if(isset($users)){{ $users }}@endif</div>
            <i class="box-bg-icon middle right font-size-52 ion-ios-people"></i>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="box bg-danger darken">
          <div class="box-cell p-x-3 p-y-1">
            <div class="font-weight-semibold font-size-12">POSTS</div>
            <div class="font-weight-bold font-size-20">@if(isset($posts)){{ $posts }}@endif</div>
            <i class="box-bg-icon middle right font-size-52 ion-ios-box"></i>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="box bg-warning darken">
          <div class="box-cell p-x-3 p-y-1">
            <div class="font-weight-semibold font-size-12">IMAGES</div>
            <div class="font-weight-bold font-size-20">@if(isset($images)){{ $images }}@endif</div>
            <i class="box-bg-icon middle right font-size-52 fa fa-picture-o"></i>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="box bg-success darken">
          <div class="box-cell p-x-3 p-y-1">
            <div class="font-weight-semibold font-size-12">VIDEOS</div>
            <div class="font-weight-bold font-size-20">@if(isset($videos)){{ $videos }}@endif</div>
            <i class="box-bg-icon middle right font-size-52 fa fa-video-camera"></i>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection