<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="stylesheet" type="text/css" href="new.css">
	<title>Inventory Manager</title>
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

  $id = null;
  if (isset($_GET['id'])) {
	  $id = $_GET['id'];
	  $result = $conn->query("SELECT itemID from rentalinventory WHERE itemID = '$id'");
	  
	$x = 0;
	$data[0][0] = null;
	while($row = mysqli_fetch_array($result)) {
	  $y = 0;
      $data[$x][$y] = $row['itemID'];
	}
	
	if ($data[0][0]) { // If number is in use already, get a new one.
		echo '<script type="text/javascript">','generateitemID();','</script>';
	}
  }
  
  // Closing the connection that we created
  //$conn->close();

?>
	<div class="content">
		<h2 class="center">Rental Inventory Management</h2>
		<form class="center">
			<fieldset>
				<legend>Add New Rental Item</legend height:500px; overflow:auto">
					<table id="inventoryTable">
						<tbody>
							<label for="itemID">Item ID:</label>
							<input type="text" class="modifyItem" id="itemID" name="itemID" value="<?php echo $id?>" readonly>
							<button type="button" onClick="generateitemID()" class="navButton">Generate Item ID</button><br>
				
							<label for="itemBrand">Item Brand:</label>
							<input type="text" class="modifyItem" id="itemBrand" name="itemBrand" value="" style="text-transform:uppercase" size="2" minlength="2" maxlength="2" required>
							
							<label for="itemType">Item Type:</label>
							<input type="text" class="modifyItem" id="itemType" name="itemType" value="" size="8" required><br>
							
							<label for="itemSize">Item Size:</label>
							<input type="text" class="modifyItem" id="itemSize" value="" name="itemSize" required><br>

							<label for="itemQuantity">Item Quantity:</label>
							<input type="number" class="modifyItem" id="itemQuantity" name="itemQuantity" value="" minlength="1" maxlength="4" size="4" required>
						</tbody>
					</table>
				</div>
				<br>

				<button type="button" onClick="backRentalInventory()" class="navButton">Back</button>

				<button type="button" onClick="addNewRentalItem(document.getElementById('itemID').value, document.getElementById('itemBrand').value, document.getElementById('itemType').value, document.getElementById('itemSize').value, document.getElementById('itemQuantity').value)"  class="navButton">Confirm</button> <br><br>
			</fieldset>
		</form>
	</div>
</body>
</html>