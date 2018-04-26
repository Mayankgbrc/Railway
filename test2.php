<!DOCTYPE html>
<html>
<body>

<?php
$conn = new mysqli("localhost","root","","rail");
	$sql = "SELECT DISTINCT Train_No FROM trains"; 
	$result = mysqli_query($conn,$sql);
            
            while($row = mysqli_fetch_assoc($result)){
				echo "INSERT INTO Schedule (Train_No) VALUES (";
                 echo $row['Train_No'].");<br>";
				 
				 }
?>
</body>
</html>