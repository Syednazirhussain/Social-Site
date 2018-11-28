<!DOCTYPE html>
<html lang="en-US">
   <head>
          <meta charset="utf-8">
    </head>
    <body>
    	  <h3>Hi {{ ucfirst($name) }}</h3>
        <div style="width: 100%">
          <?php echo htmlspecialchars_decode($text ,ENT_NOQUOTES); ?>
        </div>
    </body>
</html>