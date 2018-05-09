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
<?php
echo "<h1 align='center'>Booking History</h1>";
$email = $_SESSION['email'];
$sql = "SELECT * FROM tickets WHERE userid='$email'";
$query = mysqli_query($conn,$sql);
$count = mysqli_num_rows($query);
echo "<div class='w3-margin'>";
while($row = mysqli_fetch_assoc($query)){
	echo "<div class='w3-card-8 w3-padding'><h2>PNR No = ".$row['pnr']."</h2><br>
	<table border=1 class='w3-table'><tr class='w3-green'><th>Train No</th><th>Train Name</th><th>Origin Stn</th><th>Destination</th><th>Arrival Time</th><th>Departure Time</th><th>Distance</th><th>Train Type</th><th>Fare</th><th>Date of Journey</th></tr>
<tr><th>".$row['train_no']."</th><th>".$row['Tname']."</th><th>".$row['Origin']."</th><th>".$row['Destination']."</th>
<th>".$row['Arrival_Time']."</th><th>".$row['Departure_Time']."</th><th>".$row['Distance']."</th><th>".$row['Train_type']."</th><th>".$row['full_fare']."</th><th>".$row['date']."</th></tr>
     </table>";
     echo "<br>";
     $pnr = $row['pnr'];

     $sql2 = "SELECT * FROM pnr WHERE pnr='$pnr'";
     $query2 = mysqli_query($conn,$sql2);
     $i=0;
     echo "<table border=1 class='w3-table' style='width:40%;'><tr class='w3-red'><th>Serial No</th><th>Passenger Name</th><th>Age</th><th>Gender</th><th>Coach No</th><th>Seat No</th></tr>";
     while($row2 = mysqli_fetch_assoc($query2)){
     	$i++;
     	echo "<tr><th>".$i."</th><th>".$row2['pass_name']."</th><th>".$row2['pass_age']."</th><th>".$row2['pass_gen']."</th><th>".$row2['coach_no']."</th><th>".$row2['seat_no']."</th></tr>";


     }
     echo "</table><br></div>";
}
echo "</div>";
if($count == 0){
	echo "<h2>No Bookings yet</h2>";
}
?>
<?php
}
?>