<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="stylesheet" type="text/css" href="new.css">
	<title>Inventory Manager</title>
	<meta http-equiv = "refresh" content = "0.5; url = inventory.php" />
</head>
<body>
<script src="inventory.js"></script>
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
  if (isset($_GET['itemName'])) {
	  $name = $_GET['itemName'];
  }
  if (isset($_GET['itemBrand'])) {
	  $brand = $_GET['itemBrand'];
  }
  if (isset($_GET['itemColor'])) {
	  $color = $_GET['itemColor'];
  }
  if (isset($_GET['itemPrice'])) {
	  $price = $_GET['itemPrice'];
  }
  if (isset($_GET['itemQuantity'])) {
	  $quantity = $_GET['itemQuantity'];
  }
  if (isset($_GET['itemMaxQuantity'])) {
	  $maxQuantity = $_GET['itemMaxQuantity'];
  }
  
  $add = $conn->query("INSERT INTO inventory(productID, itemName, itemBrand, itemColor, itemPrice, itemQuantity, itemMaxQuantity) VALUES('$id','$name','$brand','$color','$price','$quantity','$maxQuantity')");
	

  // Closing the connection that we created
  $conn->close();

?>
<p class="content">
	Updating...
</p>
</body>
</html>