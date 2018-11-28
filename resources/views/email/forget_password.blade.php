<!DOCTYPE html>
<html lang="en-US">
   <head>
          <meta charset="utf-8">
    </head>
    <body>
    	  <h3>Hi {{ ucfirst($name) }}</h3>
        <h4>Your forget password request has been recieved</h4>
        <div style="width: 100%">
          <p>
            <span style="width: 20%"><strong> New Password: </strong></span>
            <span style="width: 80%"> {{ $password }}  </span>
          </p>
          <p>
            <span style="width: 20%"><strong> <a href="{{ $reset_url }}">Click here</a>&nbsp;to reset your password </strong></span>
          </p>
        </div>
    </body>
</html>