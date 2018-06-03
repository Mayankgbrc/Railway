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
		<title>Railway Ticketing</title>
		<link rel="stylesheet" href="css/w3.css" />
	</head>
	<body class="w3-green">
		<div class="w3-green" style="margin-top: 0px;">
			<div class="w3-card-8 w3-teal" style="margin-left:35%;margin-top:5%;width:30%;height:100%;">
				<div class="w3-margin-left w3-margin-right w3-center">
					<br><h2 style="text-shadow: 2px 2px 2px black">Indian Railways</h2>
					<h5 style="text-shadow: 2px 2px 2px black">- An online booking portal</h5>
					<form method="POST" action="reg.do.php">
						<input type="text" placeholder="Enter your name" name="name" style="width:100%;" class="w3-round w3-input w3-border w3-light-grey" /><p>
						<input type="text" placeholder="Enter your email" name="email" style="width:100%;" class="w3-round w3-input w3-border w3-light-grey" /><p>
						<input type="password" placeholder="Enter your password" name="password" style="width:100%;"  class="w3-round w3-input w3-border w3-light-grey" /><p>
						<input type="date" placeholder="Enter your DOB" name="dob"  max='1999-05-11' style="width:100%;" class="w3-round w3-input w3-border w3-light-grey" /><p>

						<button type="submit" class="w3-btn" style="width:100%;">Sign Up</button>
					</form>
					<br>
					<a href="login.php" ><button class="w3-btn w3-blue" style="box-shadow: 2px 2px 5px black">Log In</button></a>
					<br><br>
				</div>
			</div>
		</div>
		
	</body>
</html>
