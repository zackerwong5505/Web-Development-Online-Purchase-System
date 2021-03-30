<?php
session_start();
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Biscuit Cookies Warehouse</a>
    </div>
 
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar">
      <li><a href="index.php">Home</a></li>
    </ul>
   	
 <ul class="nav navbar-nav navbar-right">
      	 
      
   	 <?php
      if (isset($_SESSION['u_username'])){

        echo '	 
        
         
         <form class="navbar-form navbar-left" action="include/inc.logout.php" method="post">

         <div class="form-group">
      	 
          <input type="submit" name="submit" value="Log Out" class="form-control">
          <label>Welcome </strong> '.$_SESSION['u_name'].'</label>
        </div>
         </form>
      	 <li class="dropdown">

          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="products.php">Products</a></li>
            <li><a href="customers.php">Customers</a></li>
            <li><a href="staffs.php">Staffs</a></li>
            <li><a href="orders.php">Orders</a></li>

          </ul>
          
        </li>
        ';
      }
      else{
        echo' 
        <form class="navbar-form navbar-left" action="include/inc.signin.php" method="post">
     		 <div class="form-group">
       			 <label>Username: </label>
       			 <input type="text" class="form-control" placeholder="Username" name="username">
       			 <label>Password: </label>
       			 <input type="password" class="form-control" placeholder="Password" name="password">
       			  <input type="submit" class="form-control" name="submit" value="Log in">
      		</div>
      	</form>

     	';
      }

     ?>

     </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>