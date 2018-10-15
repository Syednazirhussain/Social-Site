<table class="table table-responsive" id="datatables">
    <thead>
        <tr>
            <th>Name</th>
            <th width="100px">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($permissions as $permission)
        <tr>
            <td>{!! $permission->name !!}</td>
            <td width="100px" class="center text-center padding-t-20">
                <form method="post" action="{{ route('admin.permissions.destroy', [$permission->id]) }}" accept-charset="UTF-8">
                    <input name="_method" type="hidden" value="DELETE">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"> 
                    <a href="{{ route('admin.permissions.edit', [$permission->id]) }}"><i class="fa fa-edit fa-lg text-info icon-set"></i></a>
                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>