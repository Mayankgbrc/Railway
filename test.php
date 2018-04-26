<?php
	$conn = new mysqli("localhost","root","","rail");
	$sql3 = "SELECT * FROM fares WHERE 459 BETWEEN R1 AND R2";
	$result3 = mysqli_query($conn,$sql3);
            
            while($row3 = mysqli_fetch_assoc($result3)){
                 echo "Fair of 1st AC is : ".(ceil($row3['AC1']/5)*5).". Fair of 2nd AC is : ".(ceil($row3['AC2']/5)*5).". Fair of 3rd AC is : ".(ceil($row3['AC3']/5)*5).". Fair of SL is : ".(ceil($row3['SL']/5)*5);
			}
			?>