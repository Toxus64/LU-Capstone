<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="stylesheet" type="text/css" href="new.css">
	<title>Inventory Manager</title>
	<meta http-equiv = "refresh" content = "0.5; url = searchCustomer.php" />
</head>
<body>
<script src="customer.js"></script>
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
  if (isset($_GET['customerFirstName'])) {
	  $fname = $_GET['customerFirstName'];
  }
  if (isset($_GET['customerLastName'])) {
	  $lname = $_GET['customerLastName'];
  }
  if (isset($_GET['customerPhone'])) {
	  $phone = $_GET['customerPhone'];
  }
  if (isset($_GET['customerAddress'])) {
	  $address = $_GET['customerAddress'];
  }
  if (isset($_GET['customerAddress2'])) {
	  $address2 = $_GET['customerAddress2'];
  }
  if (isset($_GET['customerCity'])) {
	  $city = $_GET['customerCity'];
  }
  if (isset($_GET['customerState'])) {
	  $state = $_GET['customerState'];
  }
  if (isset($_GET['customerZipcode'])) {
	  $zipcode = $_GET['customerZipcode'];
  }  
  $add = $conn->query("INSERT INTO customerInfo(customerID, customerFirstName, customerLastName, customerPhone, customerAddress, customerAddress2, customerCity, customerState, customerZipcode) VALUES('$id','$fname','$lname','$phone','$address','$address2','$city','$state','$zipcode')");
	

  // Closing the connection that we created
  $conn->close();

?>
<p class="content">
	Updating...
</p>
</body>
</html>