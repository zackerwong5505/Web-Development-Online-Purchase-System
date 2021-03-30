<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Biscuit Cookies Ordering System</title>
    <!-- Bootstrap -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    html {
        width: 100%;
        height: 100%;
        background: url(logo.jpg) center center no-repeat;
        min-height: 100%;
    }
    </style>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

<body>
    <?php include_once 'nav_bar.php'; 
  ?>
    <div class="container">
       <h2>Staff log in</h2>
        <form class="form-horizontal" action="include/inc.signin.php" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Username:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Username" name="username">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="submit">Log in</button>
                </div>
            </div>
    </div>
    </div>
    </form>
</body>

</html>