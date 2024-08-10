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
  
  if (isset($_GET['id'])) {
	  $id = $_GET['id'];
	  $result = $conn->query("SELECT * from rentalinventory WHERE itemID = '$id'");
  } else {
	echo ("Error! This shouldn't have happened!");  
  }
  
   $x = 0;
	while($row = mysqli_fetch_array($result)) {
			  $y = 0;
			  $data[$x][$y] = $row['itemID'];
			  $y++;
			  $data[$x][$y] = $row['itemBrand'];
			  $y++;
			  $data[$x][$y] = $row['itemType'];
			  $y++;
			  $data[$x][$y] = $row['itemSize'];
			  $y++;
			  $data[$x][$y] = $row['itemQuantity'];
			  $y++;
			  $x = $x + 1;
	}
	
	
  // Closing the connection that we created
  //$conn->close();

?>
	<div class="content">
		<h2 class="center"> Rental Inventory Management</h2>
		<form class="center">
			<fieldset>
				<legend>Modify Rental Item</legend>
				<div style="max-height:500px; overflow:auto">
					<table id="inventoryTable">
						<tbody>
							<label for="itemID">Item ID:</label>
							<input type="text" class="modifyItem" id="itemID" name="itemID" value="<?php echo $data[0][0]?>" readonly><br>
							
							<label for="itemBrand">Item Brand:</label>
							<input type="text" class="modifyItem" id="itemBrand" name="itemBrand" value="<?php echo $data[0][1]?>" style="text-transform:uppercase" size="2" minlength="2" maxlength="2" readonly>
				
							<label for="itemType">Item Type:</label>
							<input type="text" class="modifyItem" id="itemType" name="itemType" value="<?php echo $data[0][2]?>" readonly><br>
							
							<label for="itemSize">Item Size:</label>
							<input type="text" class="modifyItem" id="itemSize" name="itemSize" value="<?php echo $data[0][3]?>" style="text-transform:uppercase" size="8" readonly>

							<label for="itemQuantity">Item Quantity:</label>
							<input type="number" class="modifyItem" id="itemQuantity" name="itemQuantity" value="<?php echo $data[0][4]?>" minlength="1" maxlength="4" size="4" required>
						</tbody>
					</table>
				</div>
				<br>

				<button type="button" onClick="backRentalInventory()" class="navButton">Back</button>

				<button type="button" onClick="changeRentalItem(document.getElementById('itemID').value, document.getElementById('itemBrand').value, document.getElementById('itemType').value, document.getElementById('itemSize').value, document.getElementById('itemQuantity').value)"  class="navButton">Confirm</button> <br><br>
			</fieldset>
		</form>
	</div>
</body>
</html>