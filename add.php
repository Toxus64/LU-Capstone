<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="stylesheet" type="text/css" href="new.css">
	<title>Inventory Manager</title>
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

  $id = null;
  if (isset($_GET['id'])) {
	  $id = $_GET['id'];
	  $result = $conn->query("SELECT productID from inventory WHERE productID = '$id'");
	  
	$x = 0;
	$data[0][0] = null;
	while($row = mysqli_fetch_array($result)) {
	  $y = 0;
      $data[$x][$y] = $row['productID'];
	}
	
	if ($data[0][0]) { // If number is in use already, get a new one.
		echo '<script type="text/javascript">','generateProductID();','</script>';
	}
  }
  
  // Closing the connection that we created
  //$conn->close();

?>
	<div class="content">
		<h2 class="center"> Inventory Management</h2>
		<form class="center">
			<fieldset>
				<legend>Add New Item</legend>
				<div style="max-height:500px; overflow:auto">
					<table id="inventoryTable">
						<tbody>
							<label for="productID">Item ID:</label>
							<input type="text" class="modifyItem" id="productID" name="productID" value="<?php echo $id?>" readonly>
							<button type="button" onClick="generateProductID()" class="navButton">Generate Item ID</button><br>
							
							<label for="itemName">Item Name:</label>
							<input type="text" class="modifyItem" id="itemName" name="itemName" value="" required>
				
							<label for="itemBrand">Item Brand:</label>
							<input type="text" class="modifyItem" id="itemBrand" name="itemBrand" value="" style="text-transform:uppercase" size="2" minlength="2" maxlength="2" required>
							
							<label for="itemColor">Item Color:</label>
							<input type="text" class="modifyItem" id="itemColor" name="itemColor" value="" style="text-transform:uppercase" size="8" required><br>
							
							<div class="currency">
							<label for="itemPrice">Item Price:</label>
							<input type="number" class="modifyItem" id="itemPrice" value="" name="itemPrice" step=".01" min="0" id="itemPrice" required><br>
							</div>

							<label for="itemQuantity">Item Quantity:</label>
							<input type="number" class="modifyItem" id="itemQuantity" name="itemQuantity" value="" minlength="1" maxlength="4" size="4" required>
							
							<label for="itemMaxQuantity">Item Max Quantity:</label>
							<input type="number" class="modifyItem" id="itemMaxQuantity" name="itemMaxQuantity" value="" minlength="1" maxlength="4" size="4" required>
						</tbody>
					</table>
				</div>
				<br>

				<button type="button" onClick="backInventory()" class="navButton">Back</button>

				<button type="button" onClick="addNewItem(document.getElementById('productID').value, document.getElementById('itemName').value, document.getElementById('itemBrand').value, document.getElementById('itemColor').value, document.getElementById('itemPrice').value, document.getElementById('itemQuantity').value, document.getElementById('itemMaxQuantity').value)"  class="navButton">Confirm</button> <br><br>
			</fieldset>
		</form>
	</div>
</body>
</html>