<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
</head>
<body>

	<h1>Login Page</h1>

	<form action="login.php" method="post">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username"><br><br>

		<label for="password">Password:</label>
		<input type="password" id="password" name="password"><br><br>

		<label for="role">Role:</label>
		<select id="role" name="role">
			<option value="user">User</option>
			<option value="admin">Admin</option>
		</select><br><br>

		<input type="submit" value="Login">
	</form>

</body>
</html>
