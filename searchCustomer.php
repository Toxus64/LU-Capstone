<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="stylesheet" type="text/css" href="new.css">
	<title>Customer Manager</title>
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

  $id = null;
  if (isset($_GET['delete'])) {
	  if($_GET['delete'] == true) {
		$id = $_GET['id'];
		$delete = $conn->query("DELETE FROM customerInfo WHERE customerID = '$id'");
		header('Location: customer.php');
	  }
  } elseif (isset($_GET['query'])) {
    
	  if($_GET['query'] == true) {
		$critereaRaw = substr($url, strrpos($url, '&') + 1);
		$critereaRaw2 = str_replace("%20", " ", $critereaRaw);
		$criterea = str_replace("%22", "\"", $critereaRaw2);
		$q = mysqli_query($conn, "SELECT * FROM customerInfo WHERE " . $criterea);
		$results = $conn->query("SELECT * FROM customerInfo WHERE " . $criterea);
		$result = mysqli_fetch_assoc($q);
		
		if (!$result){
			$empty = true;
		} else {
			$x = 0;
			while($row = mysqli_fetch_array($results)) {
			  $y = 0;
				$data[$x][$y] = $row['customerID'];
				$y++;
				$data[$x][$y] = $row['customerFirstName'];
				$y++;
				$data[$x][$y] = $row['customerLastName'];
				$y++;
				$data[$x][$y] = $row['customerPhone'];
				$y++;
				$data[$x][$y] = $row['customerAddress'];
				$y++;
				$data[$x][$y] = $row['customerAddress2'];
				$y++;
				$data[$x][$y] = $row['customerCity'];
				$y++;
				$data[$x][$y] = $row['customerState'];
				$y++;
				$data[$x][$y] = $row['customerZipcode'];
				$x = $x + 1;
			}
		}
	}
  } else {
  $sql = "SELECT * FROM customerInfo";
  $result = $conn->query($sql);
  
   $x = 0;
	while($row = mysqli_fetch_array($result)) {
	  $y = 0;
		$data[$x][$y] = $row['customerID'];
		$y++;
		$data[$x][$y] = $row['customerFirstName'];
		$y++;
		$data[$x][$y] = $row['customerLastName'];
		$y++;
		$data[$x][$y] = $row['customerPhone'];
		$y++;
		$data[$x][$y] = $row['customerAddress'];
		$y++;
		$data[$x][$y] = $row['customerAddress2'];
		$y++;
		$data[$x][$y] = $row['customerCity'];
		$y++;
		$data[$x][$y] = $row['customerState'];
		$y++;
		$data[$x][$y] = $row['customerZipcode'];
		$x = $x + 1;
	}
  }
  
  // Closing the connection that we created
  //$conn->close();

?>
	<div class="content">
		<h2 class="center"> Customer Management</h2>
		<form class="center">
			<fieldset>
				<legend>Search</legend>
				<div style="max-height:500px; overflow:auto">
					<table id="customerTable">
						<tbody>
							<label for="customerID">Customer ID:</label>
							<input type="text" class="modifyItem" id="customerID" name="customerID" value=""><br>
							
							<label for="customerPhone">Phone Number:</label>
							<input type="text" class="modifyItem" id="customerPhone" name="customerPhone" value="">
						</tbody>
					</table>
				</div>
				<br>

				<button type="button" onClick="back()" class="navButton">Back</button>

				<button type="button" onClick="searchForCustomer(document.getElementById('customerID').value, document.getElementById('customerPhone').value)"  class="navButton">Search</button>
				
				<button type="button" onClick="addCustomer()" class="navButton">Add New Customer</button> 
			</fieldset>
		</form>
	</div>
</body>
</html>