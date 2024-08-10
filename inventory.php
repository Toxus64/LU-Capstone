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
  
  $url = 'localhost:8080/' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  $empty = false;
  
  if (isset($_GET['delete'])) {
	  if($_GET['delete'] == true) {
		$id = $_GET['id'];
		$delete = $conn->query("DELETE FROM inventory WHERE productID = '$id'");
		header('Location: inventory.php');
	  }
  } elseif (isset($_GET['query'])) {
    
	  if($_GET['query'] == true) {
		$critereaRaw = substr($url, strrpos($url, '&') + 1);
		$critereaRaw2 = str_replace("%20", " ", $critereaRaw);
		$criterea = str_replace("%22", "\"", $critereaRaw2);
		$q = mysqli_query($conn, "SELECT * FROM inventory WHERE " . $criterea);
		$results = $conn->query("SELECT * FROM inventory WHERE " . $criterea);
		$result = mysqli_fetch_assoc($q);
		
		if (!$result){
			$empty = true;
		} else {
			$x = 0;
			while($row = mysqli_fetch_array($results)) {
			  $y = 0;
			  $data[$x][$y] = $row['productID'];
			  $y++;
			  $data[$x][$y] = $row['itemName'];
			  $y++;
			  $data[$x][$y] = $row['itemBrand'];
			  $y++;
			  $data[$x][$y] = $row['itemColor'];
			  $y++;
			  $data[$x][$y] = $row['itemPrice'];
			  $y++;
			  $data[$x][$y] = $row['itemQuantity'];
			  $y++;
			  $data[$x][$y] = $row['itemMaxQuantity'];
			  $x = $x + 1;
			}
		}
	}
  } else {
  $sql = "SELECT * FROM inventory";
  $result = $conn->query($sql);
  
   $x = 0;
	while($row = mysqli_fetch_array($result)) {
	  $y = 0;
      $data[$x][$y] = $row['productID'];
	  $y++;
	  $data[$x][$y] = $row['itemName'];
	  $y++;
	  $data[$x][$y] = $row['itemBrand'];
	  $y++;
	  $data[$x][$y] = $row['itemColor'];
	  $y++;
	  $data[$x][$y] = $row['itemPrice'];
	  $y++;
	  $data[$x][$y] = $row['itemQuantity'];
	  $y++;
	  $data[$x][$y] = $row['itemMaxQuantity'];
	  $x = $x + 1;
	}
  }
	
  // Closing the connection that we created
  //$conn->close();

?>
	<div class="content">
		<h2 class="center"> Inventory Management</h2>
		<form class="center">
			<fieldset>
				<legend>Inventory</legend>
				<div style="max-height:500px; overflow:auto">
					<table id="inventoryTable">
						<thead>
							<tr>
								<th><i>Item ID</i></th> <!-- 0 -->
								<th><i>Item Name</i></th> <!-- 1 -->
								<th><i>Item Brand</i></th> <!-- 2 -->
								<th><i>Item Color</i></th> <!-- 3 -->
								<th><i>Item Price</i></th> <!-- 4 -->
								<th><i>Item Quantity</i></th> <!-- 5 -->
								<th><i>Item Max Quantity</i></th> <!-- 6 -->
							</tr>
						</thead>
						<tbody>
						<?php if(!$empty) {
								foreach($data as $column):
								$rows = explode("/n", $column[0]);
								$cell0 = $column[0];
								$cell1 = $column[1];
								$cell2 = $column[2];
								$cell3 = $column[3];							
								$cell4 = $column[4];
								$cell5 = $column[5];
								$cell6 = $column[6];
							?>
							<?php foreach($rows as $row): ?>
							<tr onclick="highlight(this);">
								<td><?php echo$cell0 ;?></td> <!-- productID -->
								<td><?php echo$cell1 ;?></td> <!-- itemName -->
								<td><?php echo$cell2 ;?></td> <!-- itemBrand -->
								<td><?php echo$cell3 ;?></td> <!-- itemColor -->
								<td>$<?php echo$cell4 ;?></td> <!-- itemPrice -->
								<td><?php echo$cell5 ;?></td> <!-- itemQuantity -->
								<td><?php echo$cell6 ;?></td> <!-- itemMaxQuantity -->
							</tr>
							<?php endforeach;
						endforeach; } else {
							echo "<td colspan='7'><h2>Nothing Found!</h2></td>";
						}?>
						</tbody>
					</table>
				</div>
				<br>

				<button type="button" onClick="deleteItem()" class="navButton">Remove Item</button>

				<button type="button" onClick="modifyItem()" class="navButton">Modify Item</button> 
				
				<button type="button" onClick="addItem()" class="navButton">Add Item</button> 
				
				<button type="button" onClick="searchItem()" class="navButton">Search</button> 
				<br><br>
				<a href="index.php" class="navButton"><b>Back</b></a>
			</fieldset>
		</form>
	</div>
</body>
</html>