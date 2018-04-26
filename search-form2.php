<!DOCTYPE html>
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
    <body>
        <form method="get" >
            <div class="search-box">
                <input type="text" autocomplete="off" placeholder="Search country..."  name="ocity"/>
                <div class="result"></div>
            </div>
            <div class="search-box2">
                <input type="text" autocomplete="off" placeholder="Search country..." name="dcity"/>
                <div class="result2"></div>
            </div>
            <button type="submit">Submit</button>
        </form>
        <?php
        if(isset($_GET['dcity'])){
            $conn = new mysqli("localhost","root","","rail");
            $ocity = $_GET['ocity'];
            $dcity = $_GET['dcity'];
            $ol = stripos($ocity," ");
            $dl = stripos($dcity," ");
            $ocode =  substr($ocity,0,$ol);
            echo "Your origin Station is ".$ocode;
            $dcode =  substr($dcity,0,$dl);
            echo " and destination is ".$dcode."<br>";
            /*$sql = "SELECT * FROM trains where ((Station_Code='$ocity' AND Train_No IN (SELECT Train_No FROM trains WHERE Station_Code='$dcity')) OR ( Station_Code='$dcity' AND Train_No IN (SELECT Train_No FROM trains WHERE Station_Code='$ocity')))";
            */ $sql = "SELECT * FROM trains where (((Station_Code='$ocode'  OR Station_Code = (SELECT alt2 FROM alternate WHERE alt1 = '$ocode') OR Station_Code = (SELECT alt3 FROM alternate WHERE alt1 = '$ocode') OR Station_Code = (SELECT alt4 FROM alternate WHERE alt1 = '$ocode')) AND Train_No IN (SELECT Train_No FROM trains WHERE ( Station_Code='$dcode'  OR Station_Code = (SELECT alt2 FROM alternate WHERE alt1 = '$dcode') OR Station_Code = (SELECT alt3 FROM alternate WHERE alt1 = '$dcode') OR Station_Code = (SELECT alt4 FROM alternate WHERE alt1 = '$dcode')))) OR ((Station_Code='$dcode' OR Station_Code = (SELECT alt2 FROM alternate WHERE alt1 = '$dcode') OR Station_Code = (SELECT alt3 FROM alternate WHERE alt1 = '$dcode') OR Station_Code = (SELECT alt4 FROM alternate WHERE alt1 = '$dcode')) AND Train_No IN (SELECT Train_No FROM trains WHERE (Station_Code='$ocode' OR Station_Code = (SELECT alt2 FROM alternate WHERE alt1 = '$ocode') OR Station_Code = (SELECT alt3 FROM alternate WHERE alt1 = '$ocode') OR Station_Code = (SELECT alt4 FROM alternate WHERE alt1 = '$ocode'))))) ";
            $result = mysqli_query($conn,$sql);
            $t_no = 0;
            $seq_no = 0;
            $d1 = 0;
            echo "<table border=2><tr><td>Train No</td><td>Train Name</td><td>Origin Stn</td><td>Destination</td><td>Arrival Time</td><td>Departure Time</td><td>Distance</td><td>Availability</td></tr>";
            while($row = mysqli_fetch_assoc($result)){
                $distance = $row['Distance'] - $d1; 
                if(($row['Train_No'] == $t_no) && ($row['Station_Code'] == $dcode) ){
                    echo "<tr><td>".$row['Train_No']."</td><td>".$row['Train_Name']."</td><td>".$origin."</td><td>".$row['Station_Code']."</td><td>".$atime."</td><td>".$row['Arrival_time']."</td><td>".$distance."</td><td>1AC 2AC 3AC SL</td></tr>";
                    /* echo "Train_No:".$row['Train_No'] . "Distance is ".$distance."km. Train Name is:".$row['Train_Name'] . " <br>"; */
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
    </body>
</html>