<?php
  include_once 'customers_crud.php';
?>
<!DOCTYPE html>
<html>
<head>
   <title>Biscuit Cookies Ordering System : Customers</title>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
   <?php include_once 'nav_bar.php';
if (!isset($_SESSION['u_username'])){
    header("Location: ../mypt4");
    exit();
  }
    ?>
 
   <div class="container-fluid">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Add New Customer</h2>
      </div>
    <form action="customers.php" method="post" class="form-horizontal">
      <div class="form-group">
        <label for="productid" class="col-sm-3 control-label">ID</label>
          <div class="col-sm-9">
      <input name="id" class="form-control" placeholder="Customer ID" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['id']; ?>" required> 
    </div>
  </div>
      <div class="form-group">
        <label for="productid" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
      <input name="cname" class="form-control" placeholder="Customer Name" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['cname']; ?>" required>
      </div>
    </div>
     <div class="form-group">
        <label for="productid" class="col-sm-3 control-label">Address</label>
          <div class="col-sm-9">
      <textarea placeholder="Customer Address" class="form-control" row="4" cols="40" name="address"><?php if(isset($_GET['edit'])) echo $editrow['address']; ?></textarea>
    </div>
  </div>
       <div class="form-group">
        <label for="productid" class="col-sm-3 control-label">Phone Number</label>
          <div class="col-sm-9">
      <input name="phone" placeholder="Customer Phone Number"  class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['phone']; ?>" required> <br>
    </div>
  </div>
     <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldcid" value="<?php echo $editrow['id']; ?>">
      <button type="submit"class="btn btn-default" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Update</button>
      <?php } else { ?>
      <button type="submit"class="btn btn-default" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Create</button>
      <?php } ?>
      <button type="reset" class="btn btn-default"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Clear</button>
    </div>
  </div>
    </form> 

  </div>
</div>
   <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
    <div class="page-header">
       <h2>Customer List</h2>
      </div>
    <table border="1" class="table table-striped table-bordered">

      <tr>
        <td>Customer ID</td>
        <td>Name</td>     
        <td>Address</td>
        <td>Phone Number</td>
        <td></td>
      </tr>
      <tr>
        <?php
      // Read
         $per_page = 10;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_customers_a161129_pt2 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <tr>
        <td><?php echo $readrow['id']; ?></td>
        <td><?php echo $readrow['cname']; ?></td>
       
        <td><?php echo $readrow['address']; ?></td>
        <td><?php echo $readrow['phone']; ?></td>
        <td>
          <a href="customers.php?edit=<?php echo $readrow['id']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
          <a href="customers.php?delete=<?php echo $readrow['id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button" >Delete</a>
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>
    </table>
  </tr>
</table>
</div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_customers_a161129_pt2");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="customers.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"staffs.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"staffs.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="customers.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>

</body>
</html>