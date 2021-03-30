<?php
  include_once 'orders_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Biscuit Cookies Ordering System : Orders</title>
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
        <h2>Add New Order</h2>
      </div>
  
    <form action="orders.php" method="post" class="form-horizontal">
      <div class="form-group">
        <label for="productid" class="col-sm-3 control-label">Order ID</label>
          <div class="col-sm-9">
       <input name="oid" type="text" class="form-control" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['oid']; ?>"> 
     </div>
   </div>
      <div class="form-group">
        <label for="productid" class="col-sm-3 control-label">Order Date</label>
          <div class="col-sm-9">
      <input name="orderdate" type="text" class="form-control" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['date']; ?>">
     </div>
   </div>
      <div class="form-group">
        <label for="productid" class="col-sm-3 control-label">Staff</label>
          <div class="col-sm-9">
      <select name="sid" class="form-control">
         <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a161129_pt2");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $staffrow) {
      ?>
        <?php if((isset($_GET['edit'])) && ($editrow['id']==$staffrow['id'])) { ?>
          <option value="<?php echo $staffrow['id']; ?>" selected ><?php echo $staffrow['sname'];?></option>
        <?php } else { ?>
          <option value="<?php echo $staffrow['id']; ?>"><?php echo $staffrow['sname'];?></option>
        <?php } ?>
      <?php
      } // while
      $conn = null;
      ?> 
      </select> <br>
    </div>
  </div>

      <div class="form-group">
        <label for="productid" class="col-sm-3 control-label">Customer</label>
          <div class="col-sm-9">
      <select name="cid" class="form-control">
      <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_customers_a161129_pt2");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $custrow) {
      ?>
        <?php if((isset($_GET['edit'])) && ($editrow['id']==$custrow['id'])) { ?>
          <option value="<?php echo $custrow['id']; ?>" selected><?php echo $custrow['cname'];?></option>
        <?php } else { ?>
          <option value="<?php echo $custrow['id']; ?>"><?php echo $custrow['cname'];?></option>
        <?php } ?>
      <?php
      } // while
      $conn = null;
      ?> 
      </select>
    </div>
  </div>
      <?php if (isset($_GET['edit'])) { ?>
      <button type="submit" name="update"  class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Update</button>
      <?php } else { ?>
      <button type="submit" name="create" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Create</button>
      <?php } ?>
      <button type="reset" class="btn btn-default"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Clear</button>
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
        <td>Order ID</td>
        <td>Order Date</td>
        <td>Staff</td>
        <td>Customer</td>
        <td></td>
      </tr>
      <?php
         $per_page = 10;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_orders_a161129_pt2, tbl_staffs_a161129_pt2, tbl_customers_a161129_pt2 WHERE ";
        $sql = $sql."tbl_orders_a161129_pt2.staff = tbl_staffs_a161129_pt2.id and ";
        $sql = $sql."tbl_orders_a161129_pt2.customer = tbl_customers_a161129_pt2.id";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $orderrow) {
      ?>
      <tr>
        <td><?php echo $orderrow['oid']; ?></td>
        <td><?php echo $orderrow['date']; ?></td>
        <td><?php echo $orderrow['sname'] ?></td>
        <td><?php echo $orderrow['cname'] ?></td>
        <td>
          <a href="orders_details.php?oid=<?php echo $orderrow['oid']; ?>" class="btn btn-warning btn-xs" role="button" >Details</a>
          <a href="orders.php?edit=<?php echo $orderrow['oid']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
          <a href="orders.php?delete=<?php echo $orderrow['oid']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button" >Delete</a>
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>
    </table>
  </div>
</div>
</body>
</html>