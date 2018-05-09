<?php
	session_start();
?>
<?php
	if(isset($_SESSION['num'])){
		header("location: search-form.php");
	}
	?>
<!DOCTYPE html>
<html>
	<head>
		<title> Social networking </title>
	</head>
	<body>
		<form method="POST" action="reg.do.php">
			<input type="text" placeholder="Enter your name" name="name"/><br>
			<input type="text" placeholder="Enter your email" name="email"/><br>
			<input type="password" placeholder="Enter your password" name="password" /><br>
			<input type="date" placeholder="Enter your DOB" name="dob"  max='1999-05-11'/><br>

			<button type="submit">Sign Up</button>
		</form>
		<br>
		<a href="login.php">Click to go to login page</a>
	</body>
</html>
