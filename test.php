<?php
	$conn = new mysqli("localhost","root","","rail");
	$sql3 = "SELECT DISTINCT Train_No FROM trains";
	$result3 = mysqli_query($conn,$sql3);
    $count3 = mysqli_num_rows($result3);
	echo "Total number of trains is ".$count3."<br>";
            while($row3 = mysqli_fetch_assoc($result3)){
                echo $row3['Train_No']."<br>";
            }
            
			?>