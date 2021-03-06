<!DOCTYPE html>
<?php include ("head.php"); ?>
<?php
    if(!isset($_SESSION['num'])){
        header("location: login.php");
    }
    else{
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>PHP Live MySQL Database Search</title>
        <style type="text/css">
            body{
                font-family: Arail, sans-serif;
            }
            /* Formatting search box */
            .search-box{
                width: 300px;
                position: relative;
                display: inline-block;
                font-size: 14px;
            }
            .search-box input[type="text"]{
                height: 32px;
                padding: 5px 10px;
                border: 1px solid #CCCCCC;
                font-size: 14px;
            }
            .result{
                position: absolute;        
                z-index: 999;
                top: 100%;
                left: 0;
            }
            .search-box input[type="text"], .result{
                width: 100%;
                box-sizing: border-box;
            }
            /* Formatting result items */
            .result p{
                margin: 0;
                padding: 7px 10px;
                border: 1px solid #ff0000;
                border-top: none;
                cursor: pointer;
                background-color:white;
            }
            .result p:hover{
                background: #f2f2f2;
            }
            
            /* Formatting search box */
            .search-box2{
                width: 300px;
                position: relative;
                display: inline-block;
                font-size: 14px;
            }
            .search-box2 input[type="text"]{
                height: 32px;
                padding: 5px 10px;
                border: 1px solid #CCCCCC;
                font-size: 14px;
            }
            .result2{
                position: absolute;        
                z-index: 999;
                top: 100%;
                left: 0;
            }
            .search-box2 input[type="text"], .result2{
                width: 100%;
                box-sizing: border-box;
            }
            /* Formatting result items */
            .result2 p{
                margin: 0;
                padding: 7px 10px;
                border: 1px solid #ff0000;
                border-top: none;
                cursor: pointer;
                background-color:white;
            }
            .result2 p:hover{
                background: #f2f2f2;
            }
        </style>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.search-box input[type="text"]').on("keyup input", function(){
                    /* Get input value on change */
                    var inputVal = $(this).val();
                    var resultDropdown = $(this).siblings(".result");
                    if(inputVal.length){
                        $.get("backend-search.php", {term: inputVal}).done(function(data){
                            // Display the returned data in browser
                            resultDropdown.html(data);
                        });
                    } else{
                        resultDropdown.empty();
                    }
                });
            
            // Set search input value on click of result item
                $(document).on("click", ".result p", function(){
                    $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                    $(this).parent(".result").empty();
                });

                $('.search-box2 input[type="text"]').on("keyup input", function(){
                    /* Get input value on change */
                    var inputVal = $(this).val();
                    var resultDropdown = $(this).siblings(".result2");
                    if(inputVal.length){
                        $.get("backend-search.php", {term: inputVal}).done(function(data){
                            // Display the returned data in browser
                            resultDropdown.html(data);
                        });
                    } else{
                        resultDropdown.empty();
                    }
                });
            
                // Set search input value on click of result item
                $(document).on("click", ".result2 p", function(){
                    $(this).parents(".search-box2").find('input[type="text"]').val($(this).text());
                    $(this).parent(".result2").empty();
                });
            });
        </script>
    </head>
    <body><br>
        <form method="get" >
            <div class="search-box">
                <input type="text" autocomplete="off" placeholder="Search Origin city..."  name="ocity" required />
                <div class="result"></div>
            </div>
            <div class="search-box2">
                <input type="text" autocomplete="off" placeholder="Search Destination city..." name="dcity" required />
                <div class="result2"></div>
            </div>
            <input type="date" name="date" min='2018-05-09' required />
            <button type="submit">Submit</button>
        </form>
<?php
        if(isset($_GET['dcity'])){
            $conn = new mysqli("localhost","root","","rail");
            $ocity = $_GET['ocity'];
            $dcity = $_GET['dcity'];
            $date = $_GET['date'];
            $ol = stripos($ocity," ");
            $dl = stripos($dcity," ");
            $ocode =  substr($ocity,0,$ol);
          
            echo "<br>Your origin Station is <b>".$ocode;
            $dcode =  substr($dcity,0,$dl);
            echo "</b> and destination is <b>".$dcode."</b><br><br>";
            /*$sql = "SELECT * FROM trains where ((Station_Code='$ocity' AND Train_No IN (SELECT Train_No FROM trains WHERE Station_Code='$dcity')) OR ( Station_Code='$dcity' AND Train_No IN (SELECT Train_No FROM trains WHERE Station_Code='$ocity')))";
            */ $sql = "SELECT * FROM rail2 where (((Station_Code='$ocode'  OR Station_Code = (SELECT alt2 FROM alternate WHERE alt1 = '$ocode') OR Station_Code = (SELECT alt3 FROM alternate WHERE alt1 = '$ocode') OR Station_Code = (SELECT alt4 FROM alternate WHERE alt1 = '$ocode')) AND Train_No IN (SELECT Train_No FROM rail2 WHERE ( Station_Code='$dcode'  OR Station_Code = (SELECT alt2 FROM alternate WHERE alt1 = '$dcode') OR Station_Code = (SELECT alt3 FROM alternate WHERE alt1 = '$dcode') OR Station_Code = (SELECT alt4 FROM alternate WHERE alt1 = '$dcode')))) OR ((Station_Code='$dcode' OR Station_Code = (SELECT alt2 FROM alternate WHERE alt1 = '$dcode') OR Station_Code = (SELECT alt3 FROM alternate WHERE alt1 = '$dcode') OR Station_Code = (SELECT alt4 FROM alternate WHERE alt1 = '$dcode')) AND Train_No IN (SELECT Train_No FROM rail2 WHERE (Station_Code='$ocode' OR Station_Code = (SELECT alt2 FROM alternate WHERE alt1 = '$ocode') OR Station_Code = (SELECT alt3 FROM alternate WHERE alt1 = '$ocode') OR Station_Code = (SELECT alt4 FROM alternate WHERE alt1 = '$ocode'))))) ";
            $result = mysqli_query($conn,$sql);
            $t_no = 0;
            $seq_no = 0;
            $d1 = 0;
            echo "<div class='w3-margin'>";
            echo "<table border=2 class='w3-table-all w3-hoverable'><tr class='w3-green'><th>Train No</th><th>Train Name</th><th>Origin Stn</th><th>Destination</th><th>Arrival Time</th><th>Departure Time</th><th>Distance</th><th>Availability</th></tr>";
            while($row = mysqli_fetch_assoc($result)){
                $distance = $row['Distance'] - $d1; 
                
                if(($row['Train_No'] == $t_no) && ($row['Station_Code'] == $dcode) ){
                    echo "<tr><td>".$row['Train_No']."</td><td>".$row['Train_Name']."</td><td>".$origin."</td><td>".$row['Station_Code']."</td><td>".$atime."</td><td>".$row['Arrival_time']."</td><td>".$distance."</td>
                        <td> 1AC 2AC 3AC SL "; 
                    ?>
                        <form method="get">
                            <input type="hidden" value="<?php echo $ocity; ?>" name="ocity" />
                            <input type="hidden" value="<?php echo $dcity; ?>" name="dcity" />
                            <input type="hidden" value="<?php echo $row['Train_No']; ?>" name="TNo" />
                            <input type="hidden" value="<?php echo $row['Train_Name']; ?>" name="TName" />
                            <input type="hidden" value="<?php echo $origin; ?>" name="origin" />
                            <input type="hidden" value="<?php echo $row['Station_Code']; ?>" name="destination" />
                            <input type="hidden" value="<?php echo $atime; ?>" name="ATime" />
                            <input type="hidden" value="<?php echo $row['Arrival_time']; ?>" name="DTime" />
                            <input type="hidden" value="<?php echo $distance; ?>" name="distance" />
                            <input type="hidden" value="<?php echo $date; ?>" name="date" />
                            <button>Check Availability</button>
                        </form></td></tr>
                    
                    <?php
                }
                
                $t_no = $row['Train_No'];
                $seq_no = $row['SEQ'];
                $origin = $row['Station_Code']; 
                $d1 = $row['Distance'];
                $atime=$row['Departure_Time'];
            }
            echo "</table>";

            
        }
        else{
            "Error";
        }
        ?>
        <?php
        if(isset($_GET['TNo'])){
            echo "<br><br>You queried for ".$_GET['TNo']." - ".$_GET['TName'];
            $Tno = $_GET['TNo'];
            $Tname = $_GET['TName'];
            echo ". from ". $_GET['origin']." to ".$_GET['destination'];
            $origin = $_GET['origin'];
            
            $destination = $_GET['destination'];
            echo ". Departure Time of the train is ".$_GET['ATime'];
            $arrival_time = $_GET['ATime'];
            echo ". Arrival Time of train is ".$_GET['DTime'];
            $departure_time = $_GET['DTime'];
            echo ". Total Distance is ".$_GET['distance']."km. on ";
            echo $date."<br><br>";
            $distance = $_GET['distance'];
            $date = $_GET['date'];
            $t = substr($Tno,1,1);
            
            
    
            $sql3 = "SELECT * FROM fares WHERE '$distance' BETWEEN R1 AND R2";
            $result3 = mysqli_query($conn,$sql3);
            echo "Fare of the Train<br>";
            echo "<div style='width:50%;'><table border=2 class='w3-table-all w3-hoverable'><tr class='w3-green'><th> - </th><th> 1st AC </th><th> 2nd AC </th><th> 3rd AC </th><th> Sleeper </th></tr>";
            while($row3 = mysqli_fetch_assoc($result3)){
                echo "<tr><td>Base Fare </td><td>".$row3['AC1']."</td><td>".$row3['AC2']."</td><td>".$row3['AC3']."</td><td>".$row3['SL']."</td></tr>";
                echo "<tr><td>Reservation Charges </td><td>60</td><td>50</td><td>40</td><td>20</td></tr>";
                if($t == 2){
                    echo "<tr><td>Superfast Charges </td><td>75</td><td>45</td><td>45</td><td>30</td></tr>";
                    echo "<tr><td>Total GST </td><td>".round(((0.05)*($row3['AC1'] + 60 + 75)))."</td><td>".round(((0.05)*($row3['AC2'] + 50 + 45)))."</td><td>".round(((0.05)*($row3['AC3'] + 40 + 45)))."</td><td>0</td></tr>";
                    $tac1 = ceil(($row3['AC1'] + 60 + round(((0.05)*($row3['AC1'] + 60 + 75))) + 75)/5)*5;
                    $tac2 = ceil(($row3['AC2'] + 50 + round(((0.05)*($row3['AC2'] + 50 + 45))) + 45)/5)*5;
                    $tac3 = ceil(($row3['AC3'] + 40 + round(((0.05)*($row3['AC3'] + 40))) + 45)/5)*5;
                    $tsl = ceil(($row3['SL'] + 20 + 30)/5)*5;
                }
                else{ 
                    echo "<tr><td>Superfast Charges </td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
                    echo "<tr><td>Total GST </td><td>".round(((0.05)*($row3['AC1'] + 60)))."</td><td>".round(((0.05)*($row3['AC2'] + 50)))."</td><td>".round(((0.05)*($row3['AC3'] + 40)))."</td><td>0</td></tr>";
                    $tac1 = ceil(($row3['AC1'] + 60 + round(((0.05)*($row3['AC1'] + 60))))/5)*5;
                    $tac2 = ceil(($row3['AC2'] + 50 + round(((0.05)*($row3['AC2'] + 50))))/5)*5;
                    $tac3 = ceil(($row3['AC3'] + 40 + round(((0.05)*($row3['AC3'] + 40))))/5)*5;
                    $tsl = ceil(($row3['SL'] + 20)/5)*5;
                }
                echo "<tr><td>Total fare <span style='font-size:12px;'><br>(Rounding off to next multiple of Rs. 5)</span></td><td>".$tac1;
                ?>
                <form method="post" action="entry.php">
                    <input type="hidden" name="Tno" value="<?php echo $Tno; ?>" />
                    <input type="hidden" name="Tname" value="<?php echo $Tname; ?>" />
                    <input type="hidden" name="Origin" value="<?php echo $origin; ?>" />
                    <input type="hidden" name="Arrival_Time" value="<?php echo $arrival_time; ?>" />
                    <input type="hidden" name="Destination" value="<?php echo $destination; ?>" />
                    <input type="hidden" name="Departure_Time" value="<?php echo $departure_time; ?>" />
                    <input type="hidden" name="Distance" value="<?php echo $distance; ?>" />
                    <input type="hidden" name="Train_type" value="AC1" />
                    <input type="hidden" name="Total_fare" value="<?php echo $tac1; ?>" />
                    <input type="hidden" name="Date" value="<?php echo $date ?>" />
                    <button type="submit"> Book Now </button>
                    <?php 
                    $sql4 = "SELECT SUM(noofseats) FROM tickets WHERE train_no='$Tno' AND date='$date' AND train_type='AC1'";
                 $query4 = mysqli_query($conn,$sql4);
                 while($row = mysqli_fetch_assoc($query4)){
                      $seats = 15 - $row['SUM(noofseats)'];
                      if($seats > 0){
                        echo " <br>Available ".$seats;
                      }
                      else{
                        echo " W/L ";
                      }
                 }
                 ?>
                </form>
                <?php
                echo "</td><td>".$tac2;
                ?>

                <form method="post" action="entry.php">
                    <input type="hidden" name="Tno" value="<?php echo $Tno; ?>" />
                    <input type="hidden" name="Tname" value="<?php echo $Tname; ?>" />
                    <input type="hidden" name="Origin" value="<?php echo $origin; ?>" />
                    <input type="hidden" name="Arrival_Time" value="<?php echo $arrival_time; ?>" />
                    <input type="hidden" name="Destination" value="<?php echo $destination; ?>" />
                    <input type="hidden" name="Departure_Time" value="<?php echo $departure_time; ?>" />
                    <input type="hidden" name="Distance" value="<?php echo $distance; ?>" />
                    <input type="hidden" name="Train_type" value="AC2" />
                    <input type="hidden" name="Total_fare" value="<?php echo $tac2; ?>" />
                    <input type="hidden" name="Date" value="<?php echo $date ?>" />
                    <button type="submit"> Book Now </button>
                    <?php 
                    $sql4 = "SELECT SUM(noofseats) FROM tickets WHERE train_no='$Tno' AND date='$date' AND train_type='AC2'";
                 $query4 = mysqli_query($conn,$sql4);
                 while($row = mysqli_fetch_assoc($query4)){
                      $seats = 30 - $row['SUM(noofseats)'];
                      if($seats > 0){
                        echo " <br>Available ".$seats;
                      }
                      else{
                        echo " W/L ";
                      }
                 }
                 ?>
                </form>
                <?php
                echo "</td><td>".$tac3;
                ?>
                <form method="post" action="entry.php">
                    <input type="hidden" name="Tno" value="<?php echo $Tno; ?>" />
                    <input type="hidden" name="Tname" value="<?php echo $Tname; ?>" />
                    <input type="hidden" name="Origin" value="<?php echo $origin; ?>" />
                    <input type="hidden" name="Arrival_Time" value="<?php echo $arrival_time; ?>" />
                    <input type="hidden" name="Destination" value="<?php echo $destination; ?>" />
                    <input type="hidden" name="Departure_Time" value="<?php echo $departure_time; ?>" />
                    <input type="hidden" name="Distance" value="<?php echo $distance; ?>" />
                    <input type="hidden" name="Train_type" value="AC3" />
                    <input type="hidden" name="Total_fare" value="<?php echo $tac3; ?>" />
                    <input type="hidden" name="Date" value="<?php echo $date ?>" />
                    <button type="submit"> Book Now </button>
                    <?php 
                    $sql4 = "SELECT SUM(noofseats) FROM tickets WHERE train_no='$Tno' AND date='$date' AND train_type='AC3'";
                 $query4 = mysqli_query($conn,$sql4);
                 while($row = mysqli_fetch_assoc($query4)){
                      $seats = 30 - $row['SUM(noofseats)'];
                      if($seats > 0){
                        echo " <br>Available ".$seats;
                      }
                      else{
                        echo " W/L ";
                      }
                 }
                 ?>
                </form>
                <?php
                echo "</td><td>".$tsl;
                ?>
                <form method="post" action="entry.php">
                    <input type="hidden" name="Tno" value="<?php echo $Tno; ?>" />
                    <input type="hidden" name="Tname" value="<?php echo $Tname; ?>" />
                    <input type="hidden" name="Origin" value="<?php echo $origin; ?>" />
                    <input type="hidden" name="Arrival_Time" value="<?php echo $arrival_time; ?>" />
                    <input type="hidden" name="Destination" value="<?php echo $destination; ?>" />
                    <input type="hidden" name="Departure_Time" value="<?php echo $departure_time; ?>" />
                    <input type="hidden" name="Distance" value="<?php echo $distance; ?>" />
                    <input type="hidden" name="Train_type" value="Sleeper" />
                    <input type="hidden" name="Total_fare" value="<?php echo $tsl; ?>" />
                    <input type="hidden" name="Date" value="<?php echo $date ?>" />
                    <button type="submit"> Book Now </button>
                    <?php 
                    $sql4 = "SELECT SUM(noofseats) FROM tickets WHERE train_no='$Tno' AND date='$date' AND train_type='Sleeper'";
                 $query4 = mysqli_query($conn,$sql4);
                 while($row = mysqli_fetch_assoc($query4)){
                      $seats = 60 - $row['SUM(noofseats)'];
                      if($seats > 0){
                        echo " <br>Available ".$seats;
                      }
                      else{
                        echo " W/L ";
                      }
                 }
                 ?>
                </form>
                <?php
                echo "</td></tr>";
                echo "</table></div></div>";
            }
    }
        
        ?>
    </body>
</html>
<?php
}
?>