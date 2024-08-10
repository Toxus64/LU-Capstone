<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="stylesheet" type="text/css" href="new.css">
	<title>Inventory Manager</title>
	<meta http-equiv = "refresh" content = "0.5; url = searchOrder.php" />
</head>
<body>
<script src="order.js"></script>
<?php
  $servername = "localhost";
  $username = "root";
  $password = "password";
  $dbname = "masterdatabase";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  // Checking the connection that we just made
  if ($conn->connect_error){
      die($conn->connect_error);
  }
  
  if (isset($_GET['id'])) {
	  $id = $_GET['id'];
  }
  if (isset($_GET['customerID'])) {
	  $custID = $_GET['customerID'];
  }
  if (isset($_GET['orderItems'])) {
	  $orderItemsRaw = $_GET['orderItems'];
	  $orderItems = str_replace("%"," ",$orderItemsRaw);
  }
  if (isset($_GET['orderAddress'])) {
	  $addressRaw = $_GET['orderAddress'];
	  $address = str_replace("%"," ",$addressRaw);
  }
  if (isset($_GET['orderStatus'])) {
	  $status = $_GET['orderStatus'];
  }
  $add = $conn->query("INSERT INTO orders(orderID, orderCustomer, orderItems, orderAddress, orderStatus) VALUES('$id','$custID','$orderItems','$address','$status')");
	

  // Closing the connection that we created
  $conn->close();

?>
<p class="content">
	Updating...
</p>
</body>
</html>