@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Member Ship Plan
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('admin.member_ship_plans.show_fields')
                    <a href="{!! route('admin.memberShipPlans.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
