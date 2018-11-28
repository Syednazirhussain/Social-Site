 <h2>
    <i class="fa fa-user"></i>
    <span class="label label-default">Login</span>
</h2>
<form action="{{ route('user.authenticate') }}" method="POST" id="login" class="form-horizontal">
    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label class="control-label" for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control" placeholder="ex. shreey_wezki@example.com">
    </div>
    <div class="form-group">
        <label class="control-label" for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="xxxxxxx">
    </div>
    <div>
        <a href="{{ route('user.forget.password') }}">Forget password</a>        
    </div>
    <div>
        <input type="submit" class="btn btn-primary" value="Login" />        
    </div>
</form>
