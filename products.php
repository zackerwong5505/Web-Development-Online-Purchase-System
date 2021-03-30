

<?php
 
  include_once 'products_crud.php';

       
  $brand=array(
    array("name"=>"LOTTE"),
    array("name"=>"Julies"),
    array("name"=>"Munchys"),
    array("name"=>"Hup Seng")
  );
  $types=array(
    array("name"=>"Chocolate"),
    array("name"=>"Biscuits"),
    array("name"=>"Soft cakes"),
    array("name"=>"Wafer Rolls"),
    array("name"=>"Sandwich Biscuits"),    
    array("name"=>"Crackers"),  
    array("name"=>"Assorted Biscuits")
  );
?>

<!DOCTYPE html>
<html>
<head>
   <title>Biscuit Cookies Ordering System : Products</title>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
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
        <h2>Create New Product</h2>
      </div>
    <form action="products.php" method="post" class="form-horizontal">
      <div class="form-group">
        <label for="productid" class="col-sm-3 control-label">ID</label>
          <div class="col-sm-9">
            <input name="pid" type="text" placeholder="Product ID" class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['id']; ?>" required> 
          </div>
        </div>
      <div class="form-group">
        <label for="productname" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
            <input name="name" type="text" placeholder="Product Name" class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['name']; ?>" required> 
          </div>
      </div>
      <div class="form-group">
        <label for="productlabel" class="col-sm-3 control-label">Price</label>
          <div class="col-sm-9">
            <input name="price" type="text" placeholder="Product Price" class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['price']; ?>" required>
          </div>
      </div>
      <div class="form-group">
          <label for="productbrand" class="col-sm-3 control-label">Brand</label>
          <div class="col-sm-9">
            <select name="brand" class="form-control"  required>       
              <option value="">Please Select</option>
              <?php
            foreach($brand as $brand){  

                if ( isset($_GET['edit']) && $brand['name']==$editrow["brand"])
                  echo "<option value='". $brand['name']. "' selected>". $brand['name'] ."</option>";
                else
                  echo "<option value='". $brand['name']. "'>". $brand['name'] ."</option>";
                }
            ?>        
            </select>
          </div>
      </div>

      <div class="form-group">
        <label for="producttype" class="col-sm-3 control-label">Type</label>
          <div class="col-sm-9">
            <select name="types" class="form-control" required>
              <option value="">Please Select</option>
            <?php
            foreach($types as $types){       
                if ( isset($_GET['edit']) && $types['name']==$editrow["types"])
                  echo "<option value='". $types['name']. "' selected>". $types['name'] ."</option>";
                else
                  echo "<option value='". $types['name']. "'>". $types['name'] ."</option>";
                }
            ?>        
            </select>
         </div>
      </div>
      <div class="form-group">
          <label for="productdescription" class="col-sm-3 control-label" required>Description</label>
          <div class="col-sm-9">
      <textarea placeholder="Product Description" class="form-control" name="description" rows="4" cols="30"><?php if(isset($_GET['edit'])) echo $editrow['description']; ?></textarea><br>
  </div>
</div>
      <div class="form-group">
          <label for="productweight" class="col-sm-3 control-label">Weight</label>
          <div class="col-sm-9">
       <input type="text" placeholder="Product Weight" class="form-control" name="weight" min="1" max="1000" value="<?php if(isset($_GET['edit'])) echo $editrow['weight']; ?>" required>
     </div>
   </div>
       <div class="form-group">
          <label for="productquantity"  class="col-sm-3 control-label">Quantity</label>
          <div class="col-sm-9">
      <input name="quantity" placeholder="Product Quantity" type="text" class="form-control" value="<?php if(isset($_GET['edit'])) echo $editrow['quantity']; ?>" required> <br>
    </div>
  </div>
  <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
       <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldpid" value="<?php echo $editrow['id']; ?>">
      <button type="submit" class="btn btn-default" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
      <?php } else { ?>
      <button type="submit" class="btn btn-default" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
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
        <h2>Products List</h2>
      </div>
      <form action="products.php" method="post">
      <input type="text" name="valueToSearch" placeholder="Search for names.." title="Type in a name">
      <input type="submit" name="search" value="search">
     <?php
     if(isset($_POST['search'])){
      ?>
      <table border="1" class="table table-striped table-bordered" id="myTable">
      <tr class="header">
        <th>Product ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Brand</th>
        <th>Types</th>
        <th>Weight</th>
        <th></th>
      </tr>
    
      <?php
      // Read
      
      
        
      while($readrow = mysqli_fetch_array($search_result)){
      ?>   
      <tr>
        <td><?php echo $readrow['id']; ?></td>
        <td><?php echo $readrow['name']; ?></td>
        <td><?php echo $readrow['price']; ?></td>
        <td><?php echo $readrow['brand']; ?></td>
        <td><?php echo $readrow['types']; ?></td>
        <td><?php echo $readrow['weight']; ?></td>
        <td>

          <a href="products_details.php?pid=<?php echo $readrow['id']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
          <a href="products.php?edit=<?php echo $readrow['id']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
          <a href="products.php?delete=<?php echo $readrow['id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>

    </table>
    <?php
      }else {        
        ?>
        <table border="1" class="table table-striped table-bordered" id="myTable">
      <tr class="header">
        <th>Product ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Brand</th>
        <th>Types</th>
        <th>Weight</th>
        <th></th>
      </tr>
    
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
         $stmt = $conn->prepare("SELECT * FROM tbl_products_a161129_pt2 LIMIT $start_from, $per_page");
        
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
        <td><?php echo $readrow['name']; ?></td>
        <td><?php echo $readrow['price']; ?></td>
        <td><?php echo $readrow['brand']; ?></td>
        <td><?php echo $readrow['types']; ?></td>
        <td><?php echo $readrow['weight']; ?></td>
        <td>

          <a href="products_details.php?pid=<?php echo $readrow['id']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
          <a href="products.php?edit=<?php echo $readrow['id']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
          <a href="products.php?delete=<?php echo $readrow['id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
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
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a161129_pt2");
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
            <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
      </form>
    <?php }?>

   <!--  <table border="1" class="table table-striped table-bordered" id="myTable">
      <tr class="header">
        <th>Product ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Brand</th>
        <th>Types</th>
        <th>Weight</th>
        <th></th>
      </tr>
    
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
         $stmt = $conn->prepare("SELECT * FROM tbl_products_a161129_pt2 LIMIT $start_from, $per_page");
        
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
        <td><?php echo $readrow['name']; ?></td>
        <td><?php echo $readrow['price']; ?></td>
        <td><?php echo $readrow['brand']; ?></td>
        <td><?php echo $readrow['types']; ?></td>
        <td><?php echo $readrow['weight']; ?></td>
        <td>

          <a href="products_details.php?pid=<?php echo $readrow['id']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
          <a href="products.php?edit=<?php echo $readrow['id']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
          <a href="products.php?delete=<?php echo $readrow['id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
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
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a161129_pt2");
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
            <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
 -->
 
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

<!-- <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script> -->
</html>