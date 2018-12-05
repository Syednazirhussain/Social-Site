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

    body>section {
        padding: 102px 0 !important;
    }

    .section{
        padding-bottom: 20px;
    }

</style>

@endsection

@section('content')

<div class="page-title" style='background-image: url("{{ asset("/theme/images/page-title.png") }}")'>
    <h1>Subcription Information</h1>
</div>

<section class="pricing">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
                <span class="section">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-5">
                                <span class="label label-primary"><i class="fa fa-calendar"></i>&nbsp;Renewal Date</span>
                                <span class="text-center">@if(isset($subscription)){{ \Carbon\Carbon::parse($subscription->renewal_date)->format('F d, Y') }}@endif</span>
                            </div>
                            <div class="col-md-5">
                                <span class="label label-primary"><i class="fa fa-calendar"></i>&nbsp;Renewed Date</span>
                                <span class="text-center">@if(isset($subscription)){{ \Carbon\Carbon::parse($subscription->renewed_date)->format('F d, Y') }}@endif</span>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('subcription.renew.request') }}" class="btn btn-primary">Renew Subcription</a>
                            </div>
                        </div>
                    </div>
                </span>
            </div>
            <div class="col-md-12">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Transaction Date</th>
                            <th>Transaction Status</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($subscriptionOrders))
                            @foreach($subscriptionOrders as $subscriptionOrder)
                                <tr>
                                    <td>{{ $subscriptionOrder->transaction_id }}</td>
                                    <td>{{ $subscriptionOrder->created_at }}</td>
                                    @if($subscriptionOrder->status == 'Paid')
                                        <td><span class="label label-success">{{ $subscriptionOrder->status }}</span></td>
                                    @else
                                        <td><span class="label label-warning">{{ $subscriptionOrder->status }}</span></td>
                                    @endif
                                    <td>{{ $subscriptionOrder->amount }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
</section>

@endsection

