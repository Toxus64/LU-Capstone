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
  
  $url = 'localhost:8080/' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  $empty = true;
  
  if (isset($_GET['delete'])) {
	  if($_GET['delete'] == true) {
		$id = $_GET['id'];
		$delete = $conn->query("DELETE FROM customerInfo WHERE customerID = '$id'");
		header('Location: customer.php');
	  }
  } elseif (isset($_GET['query'])) {
    
	  if($_GET['query'] == true) {
		$critereaRaw = substr($url, strrpos($url, '&') + 1);
		$critereaRaw2 = str_replace("%20", " ", $critereaRaw);
		$criterea = str_replace("%22", "\"", $critereaRaw2);
		$q = mysqli_query($conn, "SELECT * FROM customerInfo WHERE " . $criterea);
		$results = $conn->query("SELECT * FROM customerInfo WHERE " . $criterea);
		$result = mysqli_fetch_assoc($q);
		
		if (!$result){
			$empty = true;
		} else {
			$x = 0;
			$empty = false;
			while($row = mysqli_fetch_array($results)) {
			  $y = 0;
			  $data[$x][$y] = $row['customerID'];
			  $y++;
			  $data[$x][$y] = $row['customerFirstName'];
			  $y++;
			  $data[$x][$y] = $row['customerLastName'];
			  $y++;
			  $data[$x][$y] = $row['customerPhone'];
			  $y++;
			  $data[$x][$y] = $row['customerAddress'];
			  $y++;
			  $data[$x][$y] = $row['customerAddress2'];
			  $y++;
			  $data[$x][$y] = $row['customerCity'];
			  $y++;
			  $data[$x][$y] = $row['customerState'];
			  $y++;
			  $data[$x][$y] = $row['customerZipcode'];
			  $x = $x + 1;
			}
		}
	}
 }
	
  // Closing the connection that we created
  //$conn->close();

?>
	<div class="content">
		<h2 class="center"> Customer Management</h2>
		<form class="center">
			<fieldset>
				<legend>Customer Management</legend>
				<div style="max-height:500px; overflow:auto">
					<table id="customerTable">
						<thead>
							<tr>
								<th><i>Customer ID</i></th> <!-- 0 -->
								<th><i>First Name</i></th> <!-- 1 -->
								<th><i>Last Name</i></th> <!-- 2 -->
								<th><i>Phone</i></th> <!-- 3 -->
								<th><i>Address</i></th> <!-- 4 -->
								<th><i>Address 2</i></th> <!-- 5 -->
								<th><i>City</i></th> <!-- 6 -->
								<th><i>State</i></th> <!-- 7 -->
								<th><i>Zipcode</i></th> <!-- 8 -->
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
								$cell7 = $column[7];
								$cell8 = $column[8];
							?>
							<?php foreach($rows as $row): ?>
							<tr onclick="highlight(this);">
								<td><?php echo$cell0 ;?></td> <!-- customerID -->
								<td><?php echo$cell1 ;?></td> <!-- customerFirstName -->
								<td><?php echo$cell2 ;?></td> <!-- customerLastName -->
								<td><?php echo$cell3 ;?></td> <!-- customerPhone -->
								<td><?php echo$cell4 ;?></td> <!-- customerAddress -->
								<td><?php echo$cell5 ;?></td> <!-- customerAddress2 -->
								<td><?php echo$cell6 ;?></td> <!-- customerCity -->
								<td class="Xshort"><?php echo$cell7 ;?></td> <!-- customerState -->
								<td class="short"><?php echo$cell8 ;?></td> <!-- customerZipcode -->
							</tr>
							<?php endforeach;
						endforeach; } else {
							echo "<td colspan='9'><h2>Nothing Found!</h2></td>";
						}?>
						</tbody>
					</table>
				</div>
				<br>

				<button type="button" onClick="deleteCustomer()" class="navButton">Remove Customer</button>

				<button type="button" onClick="modifyCustomer()" class="navButton">Modify Customer</button> 
				
				<button type="button" onClick="searchCustomer()" class="navButton">Search</button> 
				<br><br>
				<a href="index.php" class="navButton"><b>Back</b></a>
			</fieldset>
		</form>
	</div>
</body>
</html>