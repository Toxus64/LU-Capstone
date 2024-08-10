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
  
  	$customerData = "";
	$id = "";
	$customerID = "";
	
	$empty = true;
	$items = "";
	
  if (isset($_GET['id'])) {
	  $id = $_GET['id'];
	  $result = $conn->query("SELECT orderID from rentalorders WHERE orderID = '$id'");
	  
	$x = 0;
	$data[0][0] = null;
	while($row = mysqli_fetch_array($result)) {
	  $y = 0;
      $data[$x][$y] = $row['orderID'];
	}
	
	if ($data[0][0]) { // If number is in use already, get a new one.
		echo '<script type="text/javascript">','generateOrderID();','</script>';
	}
  }

  if (isset($_GET['customerID'])) {
	  $customerID = $_GET['customerID'];
  }


  if (isset($_GET['items'])) {
	  $itemID = $_GET['items'];
	  $result = $conn->query("SELECT itemID from rentalinventory WHERE itemID = '$itemID'");
	  
	  	$x = 0;
	$data[0][0] = null;
	$empty = false;
	while($row = mysqli_fetch_array($result)) {
	  $items = $row[0];
	}
  }

  if (isset($_GET['itemID'])) {
	  $itemID = $_GET['itemID'];
	  $result = $conn->query("SELECT itemID from rentalinventory WHERE itemID = '$itemID'");
	  
	  	$x = 0;
	$data[0][0] = null;
	$empty = false;
	while($row = mysqli_fetch_array($result)) {
	  $item = $row[0];
	}
  }
  
  $itemHere = "";
  // Closing the connection that we created
  //$conn->close();

?>
	<div class="content">
		<h2 class="center">Rental Order Management</h2>
		<form class="center">
			<fieldset>
				<legend>Create Rental Order</legend>
				<div style="max-height:500px; overflow:auto">
					<table id="orderTable" style="width:20%;display: inline-block;">
						<tbody>
							<label for="orderID">Order ID:</label>
							<input type="text" class="modifyItem" id="orderID" name="orderID" value="<?php echo $id?>" readonly required>
							<button type="button" onClick="generateOrderID()" class="navButton">Generate Order ID</button><br>
							
							<label for="customerID">Customer ID:</label>
							<input type="text" class="modifyItem" id="customerID" name="customerID" value="<?php echo $customerID?>" required>
							<button type="button" onClick="getCustomerInfo(<?php echo $id?>, getElementById('customerID').value)" class="navButton">Apply Customer</button><br>
				
							<label for="orderItems">Items in Order</label><br>
									<?php if(!$empty) {
									foreach(explode(" ",$items,5) as $rows[0]):
									?>
									<?php foreach($rows as $row): ?>
									<tr onclick="highlight(this);">
										<td class="orderItems"><?php if($row != ""){echo $row; if($itemHere == ""){$itemHere = $row;}else{$itemHere = $itemHere . ',' . $row;}}?></td>
									</tr>
									<?php endforeach;
									endforeach; }?>
									
									
									<?php if(!$empty) {
									foreach(explode(" ",$item,5) as $rows[0]):
									?>
									<?php foreach($rows as $row): ?>
									<tr onclick="highlight(this);">
										<td class="orderItems"><?php if($row != ""){echo $row; if($itemHere == ""){$itemHere = $row;}else{$itemHere = $itemHere . ',' . $row;}}?></td>
									</tr>
									<?php endforeach;
									endforeach; } else {
									echo "<td colspan='1'><h2>Nothing Found!</h2></td>";
									}?>
						</tbody>
					</table><br>
							<button type="button" onClick="removeFromOrder(<?php echo $id?>)" class="navButton">Remove from Order</button><br>
							<button type="button" onClick="addToOrder(<?php echo $id?>,<?php echo $customerID?>,<?php if($itemHere == ""){echo $empty;}else{echo $itemHere;}?>,prompt('Please enter the item ID'))" class="navButton">Add to Order</button><br>
							
							<label for="eventDate">Event Date:</label>
							<input type="date" class="modifyItem" id="eventDate" name="eventDate" value="" required><br>
							
							<label for="returnDate">Return Date:</label>
							<input type="date" class="modifyItem" id="returnDate" name="returnDate" value="" required><br>
							
							<label for="orderStatus">Order Status:</label>
							<input type="text" class="modifyItem" id="orderStatus" value="PENDING" name="orderStatus" required readonly><br>
				</div>
				<br>

				<button type="button" onClick="back()" class="navButton">Back</button>

				<button type="button" onClick="createRentalOrder(document.getElementById('orderID').value, document.getElementById('customerID').value, getItems(document.getElementsByClassName('orderItems')), document.getElementById('eventDate').value, document.getElementById('returnDate').value, document.getElementById('orderStatus').value)"  class="navButton">Confirm</button> <br><br>
			</fieldset>
		</form>
	</div>
</body>
</html>