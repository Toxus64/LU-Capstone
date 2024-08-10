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
	  $result = $conn->query("SELECT * from customerInfo WHERE customerID = '$id'");
	  
	$x = 0;
	$data[0][0] = null;
	while($row = mysqli_fetch_array($result)) {
			$y = 0;
			$data[$x][$y] = $row['customerID']; // 0
			$y++;
			$data[$x][$y] = $row['customerFirstName']; // 1
			$y++;
			$data[$x][$y] = $row['customerLastName']; // 2
			$y++;
			$data[$x][$y] = $row['customerPhone']; // 3
			$y++;
			$data[$x][$y] = $row['customerAddress']; // 4
			$y++;
			$data[$x][$y] = $row['customerAddress2']; // 5
			$y++;
			$data[$x][$y] = $row['customerCity']; // 6
			$y++;
			$data[$x][$y] = $row['customerState']; // 7
			$y++;
			$data[$x][$y] = $row['customerZipcode']; // 8
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
				<legend>Modify Customer</legend>
				<div style="max-height:500px; overflow:auto">
					<table id="customerTable">
						<tbody>
							<label for="customerID">Customer ID:</label>
							<input type="text" class="modifyItem" id="customerID" name="customerID" value="<?php echo $data[0][0]?>" readonly><br>
							
							<label for="customerFirstName">First Name:</label>
							<input type="text" class="modifyItem" id="customerFirstName" name="customerFirstName" value="<?php echo $data[0][1]?>" required>
				
							<label for="customerLastName">Last Name:</label>
							<input type="text" class="modifyItem" id="customerLastName" name="customerLastName" value="<?php echo $data[0][2]?>" required><br>
							
							<label for="customerPhone">Phone:</label>
							<input type="tel" class="modifyItem" id="customerPhone" name="customerPhone" value="<?php echo $data[0][3]?>" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="###-###-####" oninput="this.reportValidity()" required><br>
							
							<label for="customerAddress">Address: &nbsp;</label>
							<input type="text" class="modifyItem" id="customerAddress" name="customerAddress" value="<?php echo $data[0][4]?>" size="45" required><br>
							
							<label for="customerAddress2">Address 2:</label>
							<input type="text" class="modifyItem" id="customerAddress2" name="customerAddress2" value="<?php echo $data[0][5]?>" size="45"><br>
							
							<label for="customerCity">City:</label>
							<input type="text" class="modifyItem" id="customerCity" value="<?php echo $data[0][6]?>" name="customerCity" required>

							<label for="customerState">State:</label>
							<input type="text" class="modifyItem" id="customerState" name="customerState" value="<?php echo $data[0][7]?>" minlength="2" maxlength="2" size="3"  style="text-transform:uppercase"required><br>
							
							<label for="customerZipcode">Zipcode:</label>
							<input type="number" class="modifyItem" id="customerZipcode" name="customerZipcode" value="<?php echo $data[0][8]?>" minlength="5" maxlength="5" size="6" required>
						</tbody>
					</table>
				</div>
				<br>

				<button type="button" onClick="back()" class="navButton">Back</button>

				<button type="button" onClick="modifyCustomerInfo(document.getElementById('customerID').value, document.getElementById('customerFirstName').value, document.getElementById('customerLastName').value, document.getElementById('customerPhone').value, document.getElementById('customerAddress').value, document.getElementById('customerAddress2').value, document.getElementById('customerCity').value, document.getElementById('customerState').value, document.getElementById('customerZipcode').value,)"  class="navButton">Confirm</button> <br><br>
			</fieldset>
		</form>
	</div>
</body>
</html>