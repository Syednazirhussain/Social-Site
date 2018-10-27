@extends('admin.default')

@section('content')

     <div class="px-content">
        <div class="page-header">
            <h1>
                <span class="text-muted font-weight-light">
                    <a href="{{ route('admin.postCategories.index') }}">
                        <i class="fa fa-file-image-o"></i>&nbsp;Post Categories                        
                    </a>
                </span>
                &nbsp;/&nbsp;
                <a href="{{ route('admin.postCategories.edit', [$postCategory->id]) }}">{{ ucwords($postCategory->name) }}</a>
            </h1> 
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">{{ $postCategory->name }}</div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin.postCategories.update', [$postCategory->id]) }}" method="POST" id="post_category">
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