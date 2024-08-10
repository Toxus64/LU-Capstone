<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="stylesheet" type="text/css" href="new.css">
	<title>Inventory Manager</title>
</head>
<body>
<script src="order.js"></script>
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
	  $result = $conn->query("SELECT orderID from orders WHERE orderID = '$id'");
	  
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
	  $result = $conn->query("SELECT customerAddress from customerInfo WHERE customerID = '$customerID'");
	  
	  	$x = 0;
	$data[0][0] = null;
	while($row = mysqli_fetch_array($result)) {
	  $customerData = $row[0];
	}
	
  }

  if (isset($_GET['items'])) {
	  $productID = $_GET['items'];
	  $result = $conn->query("SELECT productID from inventory WHERE productID = '$productID'");
	  
	  	$x = 0;
	$data[0][0] = null;
	$empty = false;
	while($row = mysqli_fetch_array($result)) {
	  $items = $row[0];
	}
  }

  if (isset($_GET['productID'])) {
	  $productID = $_GET['productID'];
	  $result = $conn->query("SELECT productID from inventory WHERE productID = '$productID'");
	  
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
		<h2 class="center"> Order Management</h2>
		<form class="center">
			<fieldset>
				<legend>Create Order</legend>
				<div style="max-height:500px; overflow:auto">
					<table id="orderTable" style="width:20%;display: inline-block;">
						<tbody>
							<label for="orderID">Order ID:</label>
							<input type="text" class="modifyItem" id="orderID" name="orderID" value="<?php echo $id?>" readonly required>
							<button type="button" onClick="generateOrderID()" class="navButton">Generate Order ID</button><br>
							
							<label for="orderCustomer">Customer ID:</label>
							<input type="text" class="modifyItem" id="orderCustomer" name="orderCustomer" value="<?php echo $customerID?>" required>
							<button type="button" onClick="getCustomerInfo(<?php echo $id?>, getElementById('orderCustomer').value)" class="navButton">Grab Customer Info</button><br>
				
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
							<button type="button" onClick="addToOrder(<?php echo $id?>,<?php echo $customerID?>,<?php if($itemHere == ""){echo $empty;}else{echo $itemHere;}?>,prompt('Please enter the product ID'))" class="navButton">Add to Order</button><br>
							
							<label for="orderAddress">Order Address:</label>
							<input type="text" class="modifyItem" id="orderAddress" name="orderAddress" value="<?php echo $customerData?>" size="40" required readonly><br>
							
							<label for="orderStatus">Order Status:</label>
							<input type="text" class="modifyItem" id="orderStatus" value="PENDING" name="orderStatus" required readonly><br>
				</div>
				<br>

				<button type="button" onClick="backOrder(<?php echo $id?>)" class="navButton">Back</button>

				<button type="button" onClick="createOrder(document.getElementById('orderID').value, document.getElementById('orderCustomer').value, getItems(document.getElementsByClassName('orderItems')), document.getElementById('orderAddress').value, document.getElementById('orderStatus').value)"  class="navButton">Confirm</button> <br><br>
			</fieldset>
		</form>
	</div>
</body>
</html>