<table class="table table-responsive" id="datatables">
    <thead>
        <tr>
<!--             <th>Image</th>
            <th>Title</th> -->
<!--             <th>Post Type</th> -->
            <th>User</th>
            <th>Category</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
<!--             <td>
                if(post->image != null)
                    <img class="img-thumbnail" src="storage/posts/" title="post->title" style="width: 75px; height:75px;"> 
                else
                    <img class="img-thumbnail" src="storage/posts/default.png" style="width: 75px; height:75px;">
                endif
            </td>
            <td>post->title</td> -->
<!--             <td>post->post_type</td> -->
            <td>{!! $post->user->name !!}</td>
            <td>{!! $post->postCategory->name !!}</td>
            <td>
                @if($post->status == 'active')
                    <span class="label label-success">{{ $post->status }}</span>
                @else
                    <span class="label label-danger">{{ $post->status }}</span>
                @endif
            </td>
            <td width="100px" class="center text-center padding-t-20">
                <form method="post" action="{{ route('admin.posts.destroy', [$post->id]) }}" accept-charset="UTF-8">
                    <input name="_method" type="hidden" value="DELETE">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"> 
                    <a href="{{ route('admin.posts.edit', [$post->id]) }}"><i class="fa fa-edit fa-lg text-info icon-set"></i></a>
                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>