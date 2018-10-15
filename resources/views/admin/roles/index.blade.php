@extends('admin.default')

@section('content')

    <div class="px-content">
        <div class="page-header">
            <h1><span class="text-muted font-weight-light">
                <i class="fa fa-user"></i> Users </span>
            </h1>
        </div>

        <div class="panel">
            <div class="panel-body">

        @include('flash::message')

                <div class="text-right m-b-3">
                    <a href="{!! route('admin.roles.create') !!}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Role</a>
                </div>

                <div class="table-primary">
                    @include('admin.roles.table')
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
            $('#datatables_wrapper .table-caption').text('Roles');
            $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
        });
    </script>

@endsection


