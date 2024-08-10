<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="stylesheet" href="new.css">
	<title>Rental Management</title>
</head>
<body>
<script src="rental.js"></script>
	<div class="content">
		<h2 class="center"> Rental System</h2>
		<form class="center" id="loginForm">
			<fieldset>
				<a href="createRentalOrder.php" class="navButton"><b>Create New Rental Order</b></a><br>
				<a href="searchRentalOrder.php" class="navButton"><b>Search Rental Orders</b></a><br>
				<a href="inventoryRental.php" class="navButton"><b>View Rental Inventory</b></a><br>
				<a href="index.php" class="navButton"><b>Back</b></a>
			</fieldset>
		</form>
		<div id="login-status" class="center"></div>
	</div>
</body>
</html>