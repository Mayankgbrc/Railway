<?php include ("head.php"); ?>
<?php
    if(!isset($_SESSION['num'])){
        header("location: login.php");
    }
    else{
?>
<?php
echo "<div class='w3-margin'><div class='w3-center'><h1>Confirmation Page</h1></div>";
$count=0;
echo "<br><table border=1 class='w3-table'><tr class='w3-green'><th>Train No</th><th>Train Name</th><th>Origin Stn</th><th>Destination</th><th>Arrival Time</th><th>Departure Time</th><th>Distance</th><th>Train Type</th><th>Fare</th><th>Date of Journey</th></tr>
<tr class=''><th>".$_POST['Tno']."</th><th>".$_POST['Tname']."</th><th>".$_POST['Origin']."</th><th>".$_POST['Destination']."</th>
<th>".$_POST['Arrival_Time']."</th><th>".$_POST['Departure_Time']."</th><th>".$_POST['Distance']."</th><th>".$_POST['Train_type']."</th><th>".$_POST['Total_fare']."</th><th>".$_POST['Date']."</th></tr>
	</table><br><br>";
echo "<table border=1 class='w3-table' style='width:40%;'><tr class='w3-red'><th>Serial No</th><th>Passenger Name</th><th>Age</th><th>Gender</th></tr>";
	for($i=1;$i<=4;$i++){
		if(strlen($_POST['Passenger'.$i])>0){
			$count = $count+1;
			echo "<tr>
					<td>".$count."</td>
					<td>".$_POST['Passenger'.$i]."</td>
					<td>".$_POST['age'.$i]."</td>
					<td>".$_POST['gender'.$i]."</td>
				</tr>";
		}


	}
echo "</table>";
$full_fare = $_POST['Total_fare']*$count;
echo "<h2>Total fare: ".$_POST['Total_fare']." X ".$count." = Rs ".$full_fare."</h2>";

	if($count==0){
		echo "No passenger is selected";
	}
	?>
<form method="post" action = "payment.do.php">
		<input type="hidden" name="Tno" value="<?php echo $_POST['Tno']; ?>" />
                    <input type="hidden" name="Tname" value="<?php echo $_POST['Tname']; ?>" />
                    <input type="hidden" name="Origin" value="<?php echo $_POST['Origin']; ?>" />
                    <input type="hidden" name="Arrival_Time" value="<?php echo $_POST['Arrival_Time']; ?>" />
                    <input type="hidden" name="Destination" value="<?php echo $_POST['Destination']; ?>" />
                    <input type="hidden" name="Departure_Time" value="<?php echo $_POST['Departure_Time']; ?>" />
                    <input type="hidden" name="Distance" value="<?php echo $_POST['Distance']; ?>" />
                    <input type="hidden" name="Train_type" value="<?php echo $_POST['Train_type']; ?>" />
                    <input type="hidden" name="full_fare" value="<?php echo $full_fare; ?>" />
                    <input type="hidden" name="Date" value="<?php echo $_POST['Date']; ?>" />
                    <input type="hidden" name="count" value="<?php echo $count; ?>" />

<?php
for($i=1;$i<=4;$i++){
		if(strlen($_POST['Passenger'.$i])>0){
					echo "<input type=hidden name=pass_name".$i." value=".$_POST['Passenger'.$i]."></input>
					<input type=hidden name=pass_age".$i." value=".$_POST['age'.$i]."></input>
					<input type=hidden name=pass_gender".$i." value=".$_POST['gender'.$i]."></input>";
		}
	}

?>
<button type="submit"> Proceed to Payment </button>
</form>
<?php
}
?>