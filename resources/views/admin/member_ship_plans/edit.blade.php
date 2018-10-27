@extends('admin.default')

@section('content')

     <div class="px-content">
        <div class="page-header">
            <h1>
                <span class="text-muted font-weight-light">
                    <a href="{{ route('admin.posts.index') }}">
                        <i class="fa fa-file-image-o"></i>&nbsp;Posts                        
                    </a>
                </span>
                &nbsp;/&nbsp;
                <a href="{{ route('admin.memberShipPlans.edit', [$memberShipPlan->id]) }}">{{ ucwords($memberShipPlan->name) }}</a>
            </h1> 
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">{{ $memberShipPlan->name }}</div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.memberShipPlans.update', [$memberShipPlan->id]) }}" method="POST" id="post">
                            @include('admin.member_ship_plans.fields')
                        </form>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
