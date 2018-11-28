@extends('admin.default')

@section('content')
     <div class="px-content">
        <div class="page-header">
            <h1><span class="text-muted font-weight-light"><i class="ionicons ion-plus"></i> User / </span>Add</h1>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('flash::message')
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">Add User</div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.users.store') }}" method="POST" id="userForm"  enctype="multipart/form-data">
                        
                            @include('admin.users.fields')

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
