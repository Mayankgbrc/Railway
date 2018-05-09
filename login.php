<?php
	session_start();
?>
<?php
	if(isset($_SESSION['num'])){
		header("location: search-form.php");
	}
	?>
<html>
	<head>
		<title> Phoenix </title>
	</head>
	<body>
		<form method="post" action="login.do.php">
			<input type="text" placeholder="Enter your email" name="email"/>
			<input type="password" placeholder="Enter your password" name="password" />
			<button type="submit">Log In</button>
		</form>
		<br>
		<a href="reg.php">Click to go to registration page.</a>
	</body>
</html>
	