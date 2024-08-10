<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="stylesheet" type="text/css" href="new.css">
	<title>Inventory Manager</title>
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
  if (isset($_GET['id'])) {
	  $id = $_GET['id'];
	  $result = $conn->query("SELECT customerID from customerInfo WHERE customerID = '$id'");
	  
	$x = 0;
	$data[0][0] = null;
	while($row = mysqli_fetch_array($result)) {
	  $y = 0;
      $data[$x][$y] = $row['customerID'];
	}
	
	if ($data[0][0]) { // If number is in use already, get a new one.
		echo '<script type="text/javascript">','generateCustomerID();','</script>';
	}
  }
  
  // Closing the connection that we created
  //$conn->close();

?>
	<div class="content">
		<h2 class="center"> Customer Management</h2>
		<form class="center">
			<fieldset>
				<legend>Add New Customer</legend>
				<div style="max-height:500px; overflow:auto">
					<table id="customerTable">
						<tbody>
							<label for="customerID">Customer ID:</label>
							<input type="text" class="modifyItem" id="customerID" name="customerID" value="<?php echo $id?>" readonly>
							<button type="button" onClick="generateCustomerID()" class="navButton">Generate Customer ID</button><br>
							
							<label for="customerFirstName">First Name:</label>
							<input type="text" class="modifyItem" id="customerFirstName" name="customerFirstName" value="" required>
				
							<label for="customerLastName">Last Name:</label>
							<input type="text" class="modifyItem" id="customerLastName" name="customerLastName" value="" required><br>
							
							<label for="customerPhone">Phone:</label>
							<input type="tel" class="modifyItem" id="customerPhone" name="customerPhone" value="" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="###-###-####" oninput="this.reportValidity()" required><br>
							
							<label for="customerAddress">Address: &nbsp;</label>
							<input type="text" class="modifyItem" id="customerAddress" name="customerAddress" value="" size="45" required><br>
							
							<label for="customerAddress2">Address 2:</label>
							<input type="text" class="modifyItem" id="customerAddress2" name="customerAddress2" value="" size="45"><br>
							
							<label for="customerCity">City:</label>
							<input type="text" class="modifyItem" id="customerCity" value="" name="customerCity" required>

							<label for="customerState">State:</label>
							<input type="text" class="modifyItem" id="customerState" name="customerState" value="" minlength="2" maxlength="2" size="3"  style="text-transform:uppercase"required><br>
							
							<label for="customerZipcode">Zipcode:</label>
							<input type="number" class="modifyItem" id="customerZipcode" name="customerZipcode" value="" minlength="5" maxlength="5" size="6" required>
						</tbody>
					</table>
				</div>
				<br>

				<button type="button" onClick="back()" class="navButton">Back</button>

				<button type="button" onClick="addNewCustomer(document.getElementById('customerID').value, document.getElementById('customerFirstName').value, document.getElementById('customerLastName').value, document.getElementById('customerPhone').value, document.getElementById('customerAddress').value, document.getElementById('customerAddress2').value, document.getElementById('customerCity').value, document.getElementById('customerState').value, document.getElementById('customerZipcode').value,)"  class="navButton">Confirm</button> <br><br>
			</fieldset>
		</form>
	</div>
</body>
</html>