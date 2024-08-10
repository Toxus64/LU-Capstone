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
  
  if (isset($_GET['id'])) {
	  $id = $_GET['id'];
	  $result = $conn->query("SELECT * from orders WHERE orderID = '$id'");
  } else {
	echo ("Error! This shouldn't have happened!");  
  }
  
    if (isset($_GET['remove'])) {
	  if($_GET['remove'] == true) {
		$id = $_GET['id'];
		$productID = $_GET['productID'];
		$result = $conn->query("SELECT * from orders WHERE orderID = '$id'");
		
		$x = 0;
		while($row = mysqli_fetch_array($result)) {
		    $y = 0;
			$data[$x][$y] = $row['orderID'];
			$y++;
			$data[$x][$y] = $row['orderCustomer'];
			$y++;
			$data[$x][$y] = $row['orderItems'];
			$y++;
			$data[$x][$y] = $row['orderAddress'];
			$y++;
			$data[$x][$y] = $row['orderStatus'];
			$x = $x + 1;
		}
		
		$x = 0;
		$newArray[0] = "";
		foreach(explode(" ",$data[0][2]) as $items[0]):
		
		foreach($items as $item):
			if ($item != $productID){
			 $newArray[$x] = $item;
			}
		endforeach;
		$x++;		
		endforeach;
			
		$data[0][2] = implode(" ",$newArray);
		$QueryChange = $data[0][2];
		
		$change = $conn->query("UPDATE orders SET orderItems = '$QueryChange' WHERE orderID = '$id'");
	  }
	}
  
   $x = 0;
	while($row = mysqli_fetch_array($result)) {
	  $y = 0;
		$data[$x][$y] = $row['orderID'];
		$y++;
		$data[$x][$y] = $row['orderCustomer'];
		$y++;
		$data[$x][$y] = $row['orderItems'];
		$y++;
		$data[$x][$y] = $row['orderAddress'];
		$y++;
		$data[$x][$y] = $row['orderStatus'];
		$x = $x + 1;
	}
	
	$empty = false;
  // Closing the connection that we created
  //$conn->close();

?>
	<div class="content">
		<h2 class="center"> Order Management</h2>
		<form class="center">
			<fieldset>
				<legend>Modify Order</legend>
				<div style="max-height:500px; overflow:auto">
					<table id="orderTable" style="width:20%;display: inline-block;">
						<tbody>
							<label for="orderID">Order ID:</label>
							<input type="text" class="modifyItem" id="orderID" name="orderID" value="<?php echo $data[0][0]?>" readonly required><br>
							
							<label for="orderCustomer">Customer ID:</label>
							<input type="text" class="modifyItem" id="orderCustomer" name="orderCustomer" value="<?php echo $data[0][1]?>" readonly required><br>
				
							<label for="orderItems">Items in Order</label><br>
									<?php if(!$empty) {
									foreach(explode(" ",$data[0][2],5) as $rows[0]):
									?>
									<?php foreach($rows as $row): ?>
									<tr onclick="highlight(this);">
										<td><?php if($row != ""){echo $row;}?></td>
									</tr>
									<?php endforeach;
									endforeach; } else {
									echo "<td colspan='1'><h2>Nothing Found!</h2></td>";
										}?>
						</tbody>
					</table><br>
							<button type="button" onClick="removeFromOrder(<?php echo $id?>)" class="navButton">Remove from Order</button><br>
							
							<label for="orderAddress">Order Address:</label>
							<input type="text" class="modifyItem" id="orderAddress" name="orderAddress" value="<?php echo $data[0][3]?>" size="40" required><br>
							
							<label for="orderStatus">Order Status:</label>
							<input type="text" class="modifyItem" id="orderStatus" value="<?php echo $data[0][4]?>" name="orderStatus" required><br>
				</div>
				<br>

				<button type="button" onClick="backOrder(<?php echo $id?>)" class="navButton">Back</button>

				<button type="button" onClick="changeItem(document.getElementById('productID').value, document.getElementById('itemName').value, document.getElementById('itemBrand').value, document.getElementById('itemColor').value, document.getElementById('itemPrice').value, document.getElementById('itemQuantity').value, document.getElementById('itemMaxQuantity').value)"  class="navButton">Confirm</button> <br><br>
			</fieldset>
		</form>
	</div>
</body>
</html>