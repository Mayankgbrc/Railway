<?php include ("head.php"); ?>
<?php
    if(!isset($_SESSION['num'])){
        header("location: login.php");
    }
    else{
    ?>
<?php
echo "<br><br><div class='w3-margin'><table border=1 class='w3-table'><tr class='w3-green'><th>Train No</th><th>Train Name</th><th>Origin Stn</th><th>Destination</th><th>Arrival Time</th><th>Departure Time</th><th>Distance</th><th>Train Type</th><th>Total Fare</th><th>Date of Journey</th></tr>
<tr class=''><th>".$_POST['Tno']."</th><th>".$_POST['Tname']."</th><th>".$_POST['Origin']."</th><th>".$_POST['Destination']."</th>
<th>".$_POST['Arrival_Time']."</th><th>".$_POST['Departure_Time']."</th><th>".$_POST['Distance']."</th><th>".$_POST['Train_type']."</th><th>".$_POST['Total_fare']."</th><th>".$_POST['Date']."</th></tr>
	</table>";


					


?>
<div>
	<form method="post" action = "payment.php">
		<input type="hidden" name="Tno" value="<?php echo $_POST['Tno']; ?>" />
                    <input type="hidden" name="Tname" value="<?php echo $_POST['Tname']; ?>" />
                    <input type="hidden" name="Origin" value="<?php echo $_POST['Origin']; ?>" />
                    <input type="hidden" name="Arrival_Time" value="<?php echo $_POST['Arrival_Time']; ?>" />
                    <input type="hidden" name="Destination" value="<?php echo $_POST['Destination']; ?>" />
                    <input type="hidden" name="Departure_Time" value="<?php echo $_POST['Departure_Time']; ?>" />
                    <input type="hidden" name="Distance" value="<?php echo $_POST['Distance']; ?>" />
                    <input type="hidden" name="Train_type" value="<?php echo $_POST['Train_type']; ?>" />
                    <input type="hidden" name="Total_fare" value="<?php echo $_POST['Total_fare']; ?>" />
                    <input type="hidden" name="Date" value="<?php echo $_POST['Date'] ?>" />
<br>
		<table border=1 class="w3-table" style="width:60%">
			<tr>
				<td>Passenger 1</td>
				<td><input type="text" name = "Passenger1" placeholder="Enter the name" /></td>
				<td><input type="number" name = "age1" placeholder="Enter age"/></td>
				<td><select name="gender1">
					  <option value="Male">Male</option>
					  <option value="Female">Female</option>
					  <option value="Others">Others</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Passenger 2</td>
				<td><input type="text" name = "Passenger2" placeholder="Enter the name" /></td>
				<td><input type="number" name = "age2" placeholder="Enter age"/></td>
				<td><select name="gender2">
					  <option value="Male">Male</option>
					  <option value="Female">Female</option>
					  <option value="Others">Others</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Passenger 3</td>
				<td><input type="text" name = "Passenger3" placeholder="Enter the name" /></td>
				<td><input type="number" name = "age3" placeholder="Enter age"/></td>
				<td><select name="gender3">
					  <option value="Male">Male</option>
					  <option value="Female">Female</option>
					  <option value="Others">Others</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Passenger 4</td>
				<td><input type="text" name = "Passenger4" placeholder="Enter the name" /></td>
				<td><input type="number" name = "age4" placeholder="Enter age"/></td>
				<td><select name="gender4">
					  <option value="Male">Male</option>
					  <option value="Female">Female</option>
					  <option value="Others">Others</option>
					</select>
				</td>
			</tr>
		</table><br>
		<button type="Submit"> Continue </button>
	</form>
</div> 
</div>
<?php
}
?>