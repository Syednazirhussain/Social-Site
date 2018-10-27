<table class="table table-responsive" id="datatables">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Member Ship</th>
            <th>Role</th>
            @can('User Managment')
            <th>Action</th>
            @endcan
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>
                @if($user->image != null)
                    <img class="img-thumbnail" src="<?php echo asset("storage/users/".$user->image); ?>" title="{{ $user->name }}" style="width: 75px; height:75px;"> 
                @else
                    <img class="img-thumbnail" src="<?php echo asset("storage/users/default.png"); ?>" style="width: 75px; height:75px;"> 
                @endif
            </td>
            <td>{!! $user->name !!}</td>
            <td>{!! $user->email !!}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ ucfirst($user->plan_code) }}</td>
            <td>
                @if(isset($userRole[$user->name]))
                    <span class="label label-primary">{{ $userRole[$user->name] }}</span>
                @endif
            </td>
            @can('User Managment')
                @if(isset($userRole[$user->name]) && $userRole[$user->name] != 'Admin')
                    <td width="100px" class="center text-center padding-t-20">
                        <form method="post" action="{{ route('admin.users.destroy', [$user->id]) }}" accept-charset="UTF-8">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">                     
                            <a href="{{ route('admin.users.edit', [$user->id]) }}"><i class="fa fa-edit fa-lg text-info icon-set"></i></a>                      
                            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                @endif
            @endcan
        </tr>
    @endforeach
    </tbody>
</table>