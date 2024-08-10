<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="new.css">
</head>
<body>
	<div class="content">
		<h2 class="center"> Login</h2>
		<form class="center" id="loginForm">
			<fieldset>
				<legend>Login</legend>
				<label for="userName"> Username:</label>
				<input type="text" id="employeeUsername" name="username" value="" class="inputField" required>
				<br>

				<label for="password">Password:</label>
				<input type="password" id="employeePassword" name="password" value="" class="inputField" required>
				<br>

				<input type="submit" value="Login" class="navButton">
			</fieldset>
		</form>
		<div id="login-status" class="center"></div>
	</div>
	<script src="login.js"></script>
</body>
</html>