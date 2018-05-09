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
     $Tno = $_POST['Tno'];
     $Tname = $_POST['Tname'];
     $Origin = $_POST['Origin'];
     $Arrival_Time = $_POST['Arrival_Time'];
     $Destination = $_POST['Destination'];
     $Departure_Time = $_POST['Departure_Time'];
     $Distance = $_POST['Distance'];
     $Train_type = $_POST['Train_type'];
     $full_fare = $_POST['full_fare']."<br>";
     $Date = $_POST['Date']."<br>";
     $count = $_POST['count'];
     $time = time();
     $pnr = $time;
     $user = $_SESSION['email'];
     ?>
     <div class="w3-margin">
     <h1>Booking Confirmation</h1>
<?php
echo "<br><table border=1 class='w3-table'><tr class='w3-green'><th>Train No</th><th>Train Name</th><th>Origin Stn</th><th>Destination</th><th>Arrival Time</th><th>Departure Time</th><th>Distance</th><th>Train Type</th><th>Fare</th><th>Date of Journey</th></tr>
<tr class=''><th>".$_POST['Tno']."</th><th>".$_POST['Tname']."</th><th>".$_POST['Origin']."</th><th>".$_POST['Destination']."</th>
<th>".$_POST['Arrival_Time']."</th><th>".$_POST['Departure_Time']."</th><th>".$_POST['Distance']."</th><th>".$_POST['Train_type']."</th><th>".$_POST['full_fare']."</th><th>".$_POST['Date']."</th></tr>
     </table><br><br>";

?>
<?php
     echo "<table border=2>";
     if($_POST['Train_type'] == 'Sleeper'){
          $coach_no = "S1";
          $sql4 = "SELECT SUM(noofseats) FROM tickets WHERE train_no='$Tno' AND date='$Date' AND train_type='Sleeper'";
       $query4 = mysqli_query($conn,$sql4);
       while($row = mysqli_fetch_assoc($query4)){
            $seats = $row['SUM(noofseats)'] + 1;
            
          }
     }
     elseif ($_POST['Train_type'] == 'AC3') {
          $coach_no = "B1";
          $sql4 = "SELECT SUM(noofseats) FROM tickets WHERE train_no='$Tno' AND date='$Date' AND train_type='AC3'";
       $query4 = mysqli_query($conn,$sql4);
       while($row = mysqli_fetch_assoc($query4)){
            $seats = $row['SUM(noofseats)'] + 1;
            
       }
     }
     elseif ($_POST['Train_type'] == 'AC2') {
          $coach_no = "H1";
          $sql4 = "SELECT SUM(noofseats) FROM tickets WHERE train_no='$Tno' AND date='$Date' AND train_type='AC2'";
       $query4 = mysqli_query($conn,$sql4);
       while($row = mysqli_fetch_assoc($query4)){
            $seats = $row['SUM(noofseats)'] + 1;
            
       }
     }
     elseif ($_POST['Train_type'] == 'AC1') {
          $coach_no = "HU1";
          
          $sql4 = "SELECT SUM(noofseats) FROM tickets WHERE train_no='$Tno' AND date='$Date' AND train_type='AC1'";
       $query4 = mysqli_query($conn,$sql4);
       while($row = mysqli_fetch_assoc($query4)){
            $seats = $row['SUM(noofseats)'] + 1;
            
       }
     }
     echo "<table border=1 class='w3-table' style='width:40%;'><tr class='w3-red'><th>Serial No</th><th>Passenger Name</th><th>Age</th><th>Gender</th><th>Coach No</th><th>Seat No</th></tr>";
     for($i=1;$i<=$count;$i++){
          $name = $_POST['pass_name'.$i];
          
          $age = $_POST['pass_age'.$i];
         
          $gender = $_POST['pass_gender'.$i];
          
          $sql = "INSERT INTO pnr(pnr, pass_name, pass_age, pass_gen, coach_no, seat_no) VALUES ('$pnr','$name','$age','$gender','$coach_no','$seats')";
          
          if($query = mysqli_query($conn,$sql)){
               
               echo "<tr><td>".$i."</td><td>$name</td><td>$age</td><td>$gender</td><td>$coach_no</td><td>$seats</td></tr>";
          }
          else{
               echo mysqli_error($conn);
          }
          $seats++;
          
     }
     echo "</table>";
     $sql2 = "INSERT INTO tickets(pnr, train_no, userid, noofseats, date, Tname, Origin, Arrival_Time, Destination, 
          Departure_Time, Distance, Train_type, full_fare) VALUES ('$pnr','$Tno','$user','$count','$Date','$Tname','$Origin','$Arrival_Time',
          '$Destination','$Departure_Time','$Distance','$Train_type','$full_fare')";
          if($query = mysqli_query($conn,$sql2)){
               echo "Your PNR number is <b>".$pnr."</b>";
          }
          else{
               echo mysqli_error($conn);
          }


     
echo "</table>";

?>

</div>
<?php
}
?>