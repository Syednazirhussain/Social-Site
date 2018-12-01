@extends('local.default')


@section('content')

<div class="page-title" style='background-image: url("{{ asset("/theme/images/page-title.png") }}")'>
    <h1>Verify Email</h1>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">

<section id="contact-page">
    <div class="container"> 
        <div class="row contact-wrap"> 

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

            <div class="col-sm-12 col-md-4 col-md-offset-4 form-containner">
              <form action="{{ route('user.password.request') }}" method="POST" class="form-horizontal" id="forgetPassword">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary">Send</button> 
              </form>
            </div>

        </div>
    </div>
</section>

@endsection


