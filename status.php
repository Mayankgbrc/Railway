<?php include ("head.php"); ?>
<?php
     $conn = new mysqli("localhost","root","","rail");
?>
<?php
    if(!isset($_SESSION['num'])){
        header("location: login.php");
    }
    else{
    ?>
<div class='w3-margin'>
<h1 align='center'>Check PNR Status</h1>
<form method="get">
	<input type="text" name="Check" placeholder="Enter the PNR Number">
	<button type="submit">Check</button>
</form>
<?php
if(isset($_GET['Check'])){
	$check = $_GET['Check'];
	$sql = "SELECT * FROM tickets where pnr='$check'";
	$query = mysqli_query($conn,$sql);
	$count = mysqli_num_rows($query);
	$row = mysqli_fetch_array($query);
	$sql2 = "SELECT * FROM pnr where pnr='$check'";
	$query2 = mysqli_query($conn,$sql2);
	$count2 = mysqli_num_rows($query2);
	echo "<br><table border=1 class='w3-table'><tr class='w3-green'><th>Train No</th><th>Train Name</th><th>Origin Stn</th><th>Destination</th><th>Train Type</th><th>Fare</th><th>Date of Journey</th><th>Coach No.</th></tr>";
	echo "<tr><td>".$row['train_no']."</td><td>".$row['Tname']."</td><td>".$row['Origin']."</td><td>".$row['Destination']."</td><td>".$row['Train_type']."</td><td>".$row['full_fare']."</td><td>".$row['date']."</td><td>";
	while($row2 = mysqli_fetch_array($query2)){
		echo $row2['coach_no']."-".$row2['seat_no'].",";
	}
	echo "</td></tr></table></div>";
}
?>
<?php
}
?>
