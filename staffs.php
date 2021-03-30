<?php
include_once 'staffs_crud.php'

?>
<!DOCTYPE html>
<html>
<head>
   <title>Biscuit Cookies Ordering System : Staffs</title>
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
      <div class="pemail-header">
        <h2>Add New Staff</h2>
      </div>
  
    <form action="staffs.php" method="post" class="form-horizontal">
       <div class="form-group">
        <label for="productid" class="col-sm-3 control-label">ID</label>
          <div class="col-sm-9">
      <input name="id"  placeholder="Staff ID" class="form-control" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['id']; ?>" required> 
    </div>
  </div>

     <div class="form-group">
        <label for="productid" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
      <input name="sname"  placeholder="Staff Name"type="text" class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['sname']; ?>" required> 
    </div>
  </div>
       <div class="form-group">
          <label for="productcond" class="col-sm-3 control-label">Gender</label>
          <div class="col-sm-9">
          <div class="radio">
            <label>
              <input name="gender" type="radio" value="Male" <?php if(isset($_GET['edit']) && $editrow['gender']=="Male") echo "checked"; ?> required> Male
            </label>
          </div>
            <div class="radio">
            <label>
              <input name="gender" type="radio" value="Female" <?php if(isset($_GET['edit']) && $editrow['gender']=="Female") echo "checked"; ?>> Female 
            </label>
          </div>
    </div>
    </div>
  
      <div class="form-group">
        <label for="productid" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-9">
      <input name="email"  placeholder="Staff email" type="email" class="form-control" type="number" value="<?php if(isset($_GET['edit'])) echo $editrow['email']; ?>" required> <br>
      </div>
    </div>
     <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldsid" value="<?php echo $editrow['id']; ?>">
      <button type="submit" name="update" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Update</button>
      <?php } else { ?>
      <button type="submit" name="create" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true">Create</button>
      <?php } ?>
      <button type="reset" class="btn btn-default"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Clear</button>
    </div>
  </div>
    </form>
  </div>
</div>
    
   <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
    <div class="pemail-header">
       <h2>Customer List</h2>
      </div>
    <table border="1" class="table table-striped table-bordered">
      <tr>
        <td>Staff ID</td>
        <td>Name</td>
        <td>Gender</td>
        <td>email</td>
       
        <td></td>
      </tr>
      <?php
      // Read
          $per_pemail = 10;
      if (isset($_GET["pemail"]))
        $pemail = $_GET["pemail"];
      else
        $pemail = 1;
      $start_from = ($pemail-1) * $per_pemail;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a161129_pt2 LIMIT $start_from, $per_pemail");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessemail();
      }
      foreach($result as $readrow) {
      ?>
    
      <tr>
       <td><?php echo $readrow['id']; ?></td>
        <td><?php echo $readrow['sname']; ?></td>
       
        <td><?php echo $readrow['gender']; ?></td>
        
        <td><?php echo $readrow['email']; ?></td>
        <td>
          <a href="staffs.php?edit=<?php echo $readrow['id']; ?>" class="btn btn-success btn-xs" role="button" role="button">Edit</a>
          <a href="staffs.php?delete=<?php echo $readrow['id']; ?>" onclick="return confirm('Are you sure to delete?' );" class="btn btn-danger btn-xs" role="button" >Delete</a>
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>
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
            $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a161129_pt2");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessemail();
          }
          $total_pemails = ceil($total_records / $per_pemail);
          ?>
          <?php if ($pemail==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?pemail=<?php echo $pemail-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pemails; $i++)
            if ($i == $pemail)
              echo "<li class=\"active\"><a href=\"staffs.php?pemail=$i\">$i</a></li>";
            else
              echo "<li><a href=\"staffs.php?pemail=$i\">$i</a></li>";
          ?>
          <?php if ($pemail==$total_pemails) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?pemail=<?php echo $pemail+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>

</body>
</html>