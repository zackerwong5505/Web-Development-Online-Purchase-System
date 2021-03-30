<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
      $stmt = $conn->prepare("INSERT INTO tbl_products_a161129_pt2(id, name, price, brand, types,
        description, weight,quantity) VALUES(:pid, :name, :price, :brand,
        :types, :description, :weight ,:quantity)");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':types', $types, PDO::PARAM_STR);
      $stmt->bindParam(':description', $description, PDO::PARAM_STR);
      $stmt->bindParam(':weight', $weight, PDO::PARAM_STR);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $brand =  $_POST['brand'];
    $types = $_POST['types'];
    $description = $_POST['description'];
    $weight = $_POST['weight'];
    $quantity = $_POST['quantity'];
     
    $stmt->execute();
    echo'<script>alert("Successfully created")</script>';
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Update
if (isset($_POST['update'])) {
// 	for ($x = 1; $x <= 42; $x++){
//    $stmt = $conn->prepare("UPDATE tbl_products_a161129_pt2 SET id = 'P00'+:z
//         WHERE id = :z");
//     $stmt->bindParam(':z', $x, PDO::PARAM_STR);
//    $stmt->execute();
// }
  try {
 
      $stmt = $conn->prepare("UPDATE tbl_products_a161129_pt2 SET id = :pid,
        name = :name, price = :price, brand = :brand,
        types = :types, description = :description, weight = :weight, quantity = :quantity
        WHERE id = :oldpid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':types', $types, PDO::PARAM_STR);
      $stmt->bindParam(':description', $description, PDO::PARAM_STR);
      $stmt->bindParam(':weight', $weight, PDO::PARAM_STR);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR); 
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $brand =  $_POST['brand'];
    $types = $_POST['types'];
    $description = $_POST['description'];
    $weight = $_POST['weight'];
    $quantity = $_POST['quantity'];
    $oldpid = $_POST['oldpid'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
      $stmt = $conn->prepare("DELETE FROM tbl_products_a161129_pt2 WHERE id = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
 
  try {
 
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a161129_pt2 WHERE id = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}



if(isset($_POST['search']))
{
     try {
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM tbl_products_a161129_pt2 WHERE name LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query,$servername,$username,$password,$dbname);
   //    $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
   //    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
   //    $stmt->bindParam(':price', $price, PDO::PARAM_INT);
   //    $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
   //    $stmt->bindParam(':types', $types, PDO::PARAM_STR);
   //    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
   //    $stmt->bindParam(':weight', $weight, PDO::PARAM_STR);
   //    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
   //    $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR); 
   //  $pid = $_POST['pid'];
   //  $name = $_POST['name'];
   //  $price = $_POST['price'];
   //  $brand =  $_POST['brand'];
   //  $types = $_POST['types'];
   //  $description = $_POST['description'];
   //  $weight = $_POST['weight'];
   //  $quantity = $_POST['quantity'];
   //  $oldpid = $_POST['oldpid'];
     
   //  $stmt->execute();
   // $search_result = filterTable($stmt);
   //  header("Location: products.php");
  }
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
    
}
 else {
    $query = "SELECT * FROM tbl_products_a161129_pt2";
    $search_result = filterTable($query,$servername,$username,$password,$dbname);

}


// function to connect and execute the query
function filterTable($query,$servername,$username,$password,$dbname)
{   
    $connect = mysqli_connect($servername,$username,$password,$dbname);
    
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

 
  $conn = null;

?>