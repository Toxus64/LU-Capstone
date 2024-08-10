<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="stylesheet" href="new.css">
	<title>Index</title>
</head>
<body>
<script src="index.js"></script>
	<div class="content">
		<h2 class="center"> Welcome!</h2>
		<form class="center" id="loginForm">
			<fieldset>
				<a href="inventory.php" class="navButton"><b>Manage Inventory</b></a><br>
				<a href="searchCustomer.php" class="navButton"><b>Manage Customers</b></a><br>
				<a href="searchOrder.php" class="navButton"><b>Manage Orders</b></a><br>
				<a href="rentalIndex.php" class="navButton"><b>Manage Rentals</b></a><br>
				<a href="login.php" class="navButton"><b>Log Out</b></a>
			</fieldset>
		</form>
		<div id="login-status" class="center"></div>
	</div>
</body>
</html>