<meta name="csrf-token" content="{{ csrf_token() }}">
<h2>
    <i class="fa fa-user-plus"></i>
    <span class="label label-default">Register</span>
</h2>
<form action="{{ route('user.signup') }}" method="POST" id="signup" class="form-horizontal">
    <input type="hidden" id="rtoken" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label class="control-label" for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="ex. Shreey Wezki">
    </div>
    <div class="form-group">
        <label class="control-label" for="phone">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control" placeholder="ex. 03xxxxxxxxx">
    </div>
    <div class="form-group">
        <label class="control-label" for="remail">Email</label>
        <input type="text" name="remail" id="remail" class="form-control" placeholder="ex. shreey_wezki@example.com">
    </div>
    <div class="form-group">
        <label class="control-label" for="rpassword">Password</label>
        <input type="password" name="password" id="rpassword" class="form-control" placeholder="xxxxxxx">
    </div>
    <input type="submit" class="btn btn-primary" value="Register" />
</form>
@if($errors->any())
    <div class="alert alert-danger" style="margin-top: 15px">
        <strong>Whoops!</strong> There were some problems with your input.
        <br/>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


