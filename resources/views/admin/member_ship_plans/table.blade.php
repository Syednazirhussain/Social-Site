<table class="table table-responsive" id="datatables">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($memberShipPlans as $memberShipPlan)
        <tr>
            <td>{!! $memberShipPlan->name !!}</td>
            <td>{!! $memberShipPlan->price !!}</td>
            <td>
                @if($memberShipPlan->status == 'active')
                    <span class="label label-success">{{ $memberShipPlan->status }}</span>
                @else
                    <span class="label label-primary">{{ $memberShipPlan->status }}</span>
                @endif
            </td>
            <td width="100px" class="center text-center padding-t-20">
                <form method="post" action="{{ route('admin.memberShipPlans.destroy', [$memberShipPlan->id]) }}" accept-charset="UTF-8">
                    <input name="_method" type="hidden" value="DELETE">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"> 
                    <a href="{{ route('admin.memberShipPlans.edit', [$memberShipPlan->id]) }}"><i class="fa fa-edit fa-lg text-info icon-set"></i></a>
                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>