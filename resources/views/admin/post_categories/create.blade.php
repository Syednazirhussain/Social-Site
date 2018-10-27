@extends('admin.default')

@section('content')
     <div class="px-content">
        <div class="page-header">
            <h1>
                <span class="text-muted font-weight-light">
                    <a href="{{ route('admin.postCategories.index') }}">
                        <i class="fa fa-file-image-o"></i>&nbsp;Post Category
                    </a>
                </span>&nbsp;/&nbsp;
                <a href="{{ route('admin.postCategories.create') }}">Add</a> 
            </h1>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">Add Post Category</div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.postCategories.store') }}" method="POST" id="post_category">
                            @include('admin.post_categories.fields')
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

