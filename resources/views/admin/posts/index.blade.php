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
            </h1>
        </div>

        <div class="panel">
            <div class="panel-body">

        @include('flash::message')

                <div class="text-right m-b-3">
                    <a href="{!! route('admin.posts.create') !!}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add Post
                    </a>
                </div>

                <div class="table-primary">
                    @include('admin.posts.table')
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script type="text/javascript">
        $(function () {
            $('#datatables').dataTable();
            $('#datatables_wrapper .table-caption').text('Posts');
            $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
        });
    </script>
@endsection


