@extends('admin.default')

@section('content')

    <div class="px-content">
        <div class="page-header">
            <h1><span class="text-muted font-weight-light"><i class="ionicons ion-person-stalker"></i> Users </span></h1>
        </div>

        <div class="panel">
            <div class="panel-body">

        @include('flash::message')

                @can('User Managment')
                    <div class="text-right m-b-3">
                        <a href="{!! route('admin.users.create') !!}" class="btn btn-primary"><i class="fa fa-plus"></i> Add User</a>
                    </div>
                @endcan

                <div class="table-primary">
                    @include('admin.users.table')
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
            $('#datatables_wrapper .table-caption').text('Users');
            $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
        });
    </script>

@endsection




