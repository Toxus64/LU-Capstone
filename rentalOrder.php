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
  
  $url = 'localhost:8080/' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  $empty = true;
  
  if (isset($_GET['cancel'])) {
	  if($_GET['cancel'] == true) {
		$id = $_GET['id'];
		$critera = str_replace("%27", "", $id);
		$delete = $conn->query("UPDATE rentalorders SET orderStatus = 'CANCELED' WHERE orderID = '$critera'");
		header("Location: rentalOrder.php?query=true&orderID='$id'");
	  }
  } elseif (isset($_GET['query'])) {
    
	  if($_GET['query'] == true) {
		$critereaRaw = substr($url, strrpos($url, '&') + 1);
		$critereaRaw2 = str_replace("%27", " ", $critereaRaw);
		$criterea = str_replace("%22", "\"", $critereaRaw2);
		$q = mysqli_query($conn, "SELECT * FROM rentalorders WHERE " . $criterea);
		$results = $conn->query("SELECT * FROM rentalorders WHERE " . $criterea);
		$result = mysqli_fetch_assoc($q);
		
		if (!$result){
			$empty = true;
		} else {
			$x = 0;
			$empty = false;
			while($row = mysqli_fetch_array($results)) {
			  $y = 0;
			  $data[$x][$y] = $row['orderID'];
		      $y++;
			  $data[$x][$y] = $row['customerID'];
			  $y++;
			  $data[$x][$y] = $row['orderItems'];
			  $y++;
			  $data[$x][$y] = $row['eventDate'];
			  $y++;
			  $data[$x][$y] = $row['returnDate'];
			  $y++;
			  $data[$x][$y] = $row['orderStatus'];
			  $x = $x + 1;
			}
		}
	}
 }
	
  // Closing the connection that we created
  //$conn->close();

?>
	<div class="content">
		<h2 class="center">Rental Order Management</h2>
		<form class="center">
			<fieldset>
				<legend>Rental Order Management</legend>
				<div style="max-height:500px; overflow:auto">
					<table id="orderTable">
						<thead>
							<tr>
								<th><i>Order ID</i></th> <!-- 0 -->
								<th><i>Customer ID</i></th> <!-- 1 -->
								<th><i>Order Items</i></th> <!-- 2 -->
								<th><i>Event Date</i></th> <!-- 3 -->
								<th><i>Return Date</i></th> <!-- 4 -->
								<th><i>Order Status</i></th> <!-- 5 -->
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
							?>
							<?php foreach($rows as $row): ?>
							<tr onclick="highlight(this);">
								<td><?php echo$cell0 ;?></td> <!-- orderID -->
								<td><?php echo$cell1 ;?></td> <!-- customerID -->
								<td><?php echo$cell2 ;?></td> <!-- orderItems -->
								<td><?php echo$cell3 ;?></td> <!-- eventDate -->
								<td><?php echo$cell4 ;?></td> <!-- returnDate -->
								<td class="short"><?php echo$cell5 ;?></td> <!-- orderStatus -->
							</tr>
							<?php endforeach;
						endforeach; } else {
							echo "<td colspan='6'><h2>Nothing Found!</h2></td>";
						}?>
						</tbody>
					</table>
				</div>
				<br>

				<button type="button" onClick="cancelOrder()" class="navButton">Cancel Order</button>

				<button type="button" onClick="modifyOrder()" class="navButton">Modify Order</button> 
				
				<button type="button" onClick="searchOrder()" class="navButton">Search</button> 
				<br><br>
				<a href="rentalindex.php" class="navButton"><b>Back</b></a>
			</fieldset>
		</form>
	</div>
</body>
</html>