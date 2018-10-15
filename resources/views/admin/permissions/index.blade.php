@extends('admin.default')

@section('content')

    <div class="px-content">
        <div class="page-header">
            <h1><span class="text-muted font-weight-light">
                <i class="fa fa-hand-o-right"></i>&nbsp;Permissions&nbsp;/</span>
            </h1>
        </div>

        <div class="panel">
            <div class="panel-body">

        @include('flash::message')

                <div class="text-right m-b-3">
                    <a href="{!! route('admin.permissions.create') !!}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add Permission
                    </a>
                </div>

                <div class="table-primary">
                    @include('admin.permissions.table')
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
            $('#datatables_wrapper .table-caption').text('Permissions');
            $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
        });
    </script>

@endsection


