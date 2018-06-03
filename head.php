<?php
session_start();
?>
<html>
	<head>
		<title> Indian Railway </title>
		<link rel="stylesheet" href="css/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="js/jquery.min.js"></script>
	</head>
	<body>
		<div class="w3-container w3-green w3-xlarge">
			<a href="search-form.php">Indian Railways</a>
			<div class="w3-right" style="margin-right: 100px;">
				Welcome <?php echo $_SESSION['name']; ?>
				<div class="w3-dropdown-hover">
				  <button class="w3-button"> <a href='search-form.php'><i class="fa fa-home"> </i></a> </button>
				  <div class="w3-dropdown-content w3-card-4 w3-border w3-large" style="width:200px;">
				    <a href="booking.php">Your-Bookings</a>
				    <a href="status.php">PNR Status</a>
				    <a href="logout.php">Sign out</a>
				  </div>
				</div>
			</div>
		</div>
	</body>
</html>