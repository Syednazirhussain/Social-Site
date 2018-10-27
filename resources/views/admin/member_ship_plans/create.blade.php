@extends('admin.default')

@section('content')
     <div class="px-content">
        <div class="page-header">
            <h1>
                <a href="{{ route('admin.memberShipPlans.index') }}">
                    <span class="text-muted font-weight-light">
                        <i class="fa fa-calendar-minus-o"></i>&nbsp;Member Ship Plans&nbsp;
                    </span>
                </a>
                &nbsp;/&nbsp;
                <a href="{{ route('admin.memberShipPlans.create') }}">
                    Add
                </a>
            </h1>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">Add Member Ship</div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.memberShipPlans.store') }}" method="POST" id="membership">
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

