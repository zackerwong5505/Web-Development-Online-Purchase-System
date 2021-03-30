
<?php
session_start();
include_once 'database.php';
if (!isset($_SESSION['u_username'])){
    header("Location: ../mypt4");
    exit();
  }
?>
<?php
try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT * FROM tbl_orders_a161129_pt2, tbl_staffs_a161129_pt2,
tbl_customers_a161129_pt2, tbl_orders_details_a161129_pt2 WHERE
tbl_orders_a161129_pt2.staff = tbl_staffs_a161129_pt2.id AND
tbl_orders_a161129_pt2.customer = tbl_customers_a161129_pt2.id AND
tbl_orders_a161129_pt2.oid = tbl_orders_details_a161129_pt2.orderid AND
tbl_orders_a161129_pt2.oid = :oid");
$stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
$oid = $_GET['oid'];
$stmt->execute();
$readrow = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
echo "Error: " . $e->getMessage();
}
$conn = null;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Biscuit Cookies Ordering System : Invoice</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="row">
			<div class="col-xs-6 text-center">
				<br>
				<img src="logo.jpg" width="30%" height="30%">
			</div>
			<div class="col-xs-6 text-right">
				<h1>INVOICE</h1>
				<h5>Order: <?php echo $readrow['oid'] ?></h5>
				<h5>Date: <?php echo $readrow['date'] ?></h5>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-5">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>From: My Bike Sdn. Bhd.</h4>
					</div>
					<div class="panel-body">
						<p>
							Biscuit Cookies Warehouse Sdn. Bhd. <br>
							123, Jalan Tongkan Pecah <br>
							Tongkang Pecah <br>
							83430 <br>
							Johor <br>
						</p>
					</div>
				</div>
			</div>
			<div class="col-xs-5 col-xs-offset-2 text-right">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>To : <?php echo $readrow['cname'] ?></h4>
					</div>
					<div class="panel-body">
						<p>
							Address 1 <br>
							Address 2 <br>
							Postcode City <br>
							State <br>
						</p>
					</div>
				</div>
			</div>
		</div>
		<table border="1" class="table table-bordered">
			<tr>
				<th>No</th>
				<th>Product</th>
				<th>Quantity</th>
				<th>Price(RM)/Unit</th>
				<th>Total(RM)</th>
			</tr>
			<?php
			$grandtotal = 0;
			$counter = 1;
			try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a161129_pt2,
			tbl_products_a161129_pt2 where
			tbl_orders_details_a161129_pt2.productid = tbl_products_a161129_pt2.id AND
			orderid = :oid");
			$stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
			$oid = $_GET['oid'];
			$stmt->execute();
			$result = $stmt->fetchAll();
			}
			catch(PDOException $e){
			echo "Error: " . $e->getMessage();
			}
			foreach($result as $detailrow) {
			?>
			<tr>
				<td><?php echo $counter; ?></td>
				<td><?php echo $detailrow['name']; ?></td>
				<td><?php echo $detailrow['orderquantity']; ?></td>
				<td><?php echo $detailrow['price']; ?></td>
				<td><?php echo $detailrow['price']*$detailrow['orderquantity']; ?></td>
			</tr>
			<?php
			$grandtotal = $grandtotal + $detailrow['price']*$detailrow['orderquantity'];
			$counter++;
			} // while
			$conn = null;
			?>
			<tr>
				<td colspan="4" align="right">Grand Total</td>
				<td><?php echo $grandtotal ?></td>
			</tr>
		</table>
		<div class="row">
  <div class="col-xs-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Bank Details</h4>
      </div>
      <div class="panel-body">
        <p>Your Name</p>
        <p>Bank Name</p>
        <p>SWIFT : </p>
        <p>Account Number : </p>
        <p>IBAN : </p>
      </div>
    </div>
    </div>
  <div class="col-xs-7">
    <div class="span7">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Contact Details</h4>
        </div>
        <div class="panel-body">
          <p> Staff: <?php echo $readrow['sname'] ?> </p>
          <p> Email: <?php echo $readrow['email'] ?> </p>
          <p><br></p>
          <p><br></p>
          <p>Computer-generated invoice. No signature is required.</p>
        </div>
      </div>
    </div>
  </div>
</div>
	</body>
</html>