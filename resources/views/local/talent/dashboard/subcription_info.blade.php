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

</style>

@endsection

@section('content')

<div class="page-title" style='background-image: url("{{ asset("/theme/images/page-title.png") }}")'>
    <h1>Subcription Information</h1>
</div>

<section class="pricing">
    <div class="row">
        <div class="container">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Transaction Date</th>
                        <th>Transaction Status</th>
                        <th>Total Amount</th>
                        <th>Next Due Date</th>
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
                                <td>{{ \Carbon\Carbon::parse($subscriptionOrder->created_at)->addMonths(1)->format('F d, Y') }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div> 
</section>

@endsection

