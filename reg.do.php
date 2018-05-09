<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rail";
	//print "<pre>";
	//print_r($_HEADER);
	//print "</pre>";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

 $name = $_POST['name'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 $dob = $_POST['dob'];
 if($err == 0){
$sql = "INSERT INTO users (name, email, password,dob)
VALUES ('$name', '$email', '$password', '$dob' )";

if ($conn->query($sql) === TRUE) {
    $_SESSION['email'] = $email;
         $_SESSION['id'] = $row['id'];
         $_SESSION['name'] = $row['name'];
         $_SESSION['dob'] = $row['dob'];
		 $num = 1;
         $_SESSION['num'] = $num;
		
		 setcookie($email, $password, time() + (86400 * 30), "/");
         header("location: search-form.php");
 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
 }
 else{
	 header ('location: reg.php');
 }
?>