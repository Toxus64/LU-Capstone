<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="stylesheet" type="text/css" href="new.css">
	<title>Inventory Manager</title>
	<meta http-equiv = "refresh" content = "0.5; url = inventoryRental.php" />
</head>
<body>
<script src="rental.js"></script>
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
  if (isset($_GET['itemBrand'])) {
	  $brand = $_GET['itemBrand'];
  }
  if (isset($_GET['itemType'])) {
	  $type = $_GET['itemType'];
  }
  if (isset($_GET['itemSize'])) {
	  $size = $_GET['itemSize'];
  }
  if (isset($_GET['itemQuantity'])) {
	  $quantity = $_GET['itemQuantity'];
  }
  
  $update = $conn->query("UPDATE rentalinventory SET itemBrand = '$brand', itemSize = '$size', itemType = '$type', itemQuantity = '$quantity' WHERE itemID = '$id'");
	

  // Closing the connection that we created
  $conn->close();

?>
<p class="content">
	Updating...
</p>
</body>
</html>