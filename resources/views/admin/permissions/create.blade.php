@extends('admin.default')

@section('content')
     <div class="px-content">
        <div class="page-header">
            <h1><span class="text-muted font-weight-light">
                <i class="fa fa-user"></i>&nbsp;User&nbsp;/&nbsp;Permission&nbsp;/</span>&nbsp;Add</h1>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">Add Permission</div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.permissions.store') }}" method="POST" id="permission">
                            @include('admin.permissions.fields')
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

