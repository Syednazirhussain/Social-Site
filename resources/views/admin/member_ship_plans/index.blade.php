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
            </h1>
        </div>
        <div class="panel">
            <div class="panel-body">
                @include('flash::message')
                <div class="text-right m-b-3">
                    <a href="{!! route('admin.memberShipPlans.create') !!}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add Member Ship
                    </a>
                </div>
                <div class="table-primary">
                    @include('admin.member_ship_plans.table')
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script type="text/javascript">
        // -------------------------------------------------------------------------
        // Initialize DataTables
        $(function () {
            $('#datatables').dataTable();
            $('#datatables_wrapper .table-caption').text('Member Ship Plans');
            $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
        });
    </script>

@endsection

