<?php
  include_once 'database.php';
?>

<!DOCTYPE html>
<html>
<head>
   <title>Biscuit Cookies Ordering System : Product Details</title>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
  <center>
     <?php include_once 'nav_bar.php'; ?>
    
     <?php
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_products_a161129_pt2 WHERE id = :pid");
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $pid = $_GET['pid'];
      $stmt->execute();
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
   <div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 well well-sm text-center">
      <?php if ($readrow['id'] == "" ) {
        echo "No image";
      }
      else { ?>
      <img src="products/<?php echo $readrow['id'] ?>.jpg" class="img-fluid img-thumbnail">
      <?php } ?>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-4">
      <div class="panel panel-default">
      <div class="panel-heading"><strong>Product Details</strong></div>
      <div class="panel-body">
          Below are specifications of the product.
      </div>
      <table class="table">
        <tr>
          <td class="col-xs-4 col-sm-4 col-md-4"><strong>Product ID</strong></td>
          <td><?php echo $readrow['id'] ?></td>
        </tr>
        <tr>
          <td><strong>Name</strong></td>
          <td><?php echo $readrow['name'] ?></td>
        </tr>
        <tr>
          <td><strong>Price</strong></td>
          <td>RM <?php echo $readrow['price'] ?></td>
        </tr>
        <tr>
          <td><strong>Brand</strong></td>
          <td><?php echo $readrow['brand'] ?></td>
        </tr>
        <tr>
          <td><strong>Types</strong></td>
          <td><?php echo $readrow['types'] ?></td>
        </tr>
        <tr>
          <td><strong>Description</strong></td>
          <td><?php echo $readrow['description'] ?></td>
        </tr>
        <tr>
          <td><strong>Weight</strong></td>
          <td><?php echo $readrow['weight'] ?></td>
        </tr>
        <tr>
          <td><strong>Quantity</strong></td>
          <td><?php echo $readrow['quantity'] ?></td>
        </tr>
      </table>
      </div>
    </div>
  </div>
</div>


 <!--    Product ID: <?php echo $readrow['id'] ?> <br>
    Name: <?php echo $readrow['name'] ?> <br>
    Price: RM <?php echo $readrow['price'] ?> <br>
    Brand: <?php echo $readrow['brand'] ?> <br>
    Type: <?php echo $readrow['types'] ?> <br>
    Description: <?php echo $readrow['description'] ?> <br>
    Weight: <?php echo $readrow['weight'] ?> <br>
    Quantity: <?php echo $readrow['quantity'] ?> <br>
    <img src="products/<?php echo $readrow['id'] ?>.jpg" width="50%" height="50%"> -->




  </center>
</body>