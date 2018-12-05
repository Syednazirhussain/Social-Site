<!DOCTYPE html>
<html lang="en-US">
   <head>
          <meta charset="utf-8">
    </head>
    <body>
    	  <h3>Hi {{ ucfirst($name) }}</h3>
        <h4>Your become a talent</h4>
        <div style="width: 100%">
          <p>
            <span>Your subcription has been extented from {{ date('Y-m-d') }} to {{ $extented_date }}</span>
          </p>
        </div>
    </body>
</html>
