<?php

    $host = "localhost";		         // host = localhost because database hosted on the same server where PHP files are hosted
    $dbname = "microsoft2";              // Database name
    $username = "user326";		         // Database username
    $password = "patitos123";	         // Database password


// Establish connection to MySQL database
$conn = new mysqli($host, $username, $password, $dbname);


// Check if connection established successfully
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

else { echo "Connected to mysql database. "; }

   
// Get date and time variables
    date_default_timezone_set('America/Mexico_City');  // For other timezones, refer:- https://www.php.net/manual/en/timezones.asia.php
    $d = date("Y-m-d");
    $t = date("H:i:s");
    
// If values send by NodeMCU are not empty then insert into MySQL database table

  if(!empty($_POST['sendval']) && !empty($_POST['sendval2']) )
    {
		$val = $_POST['sendval'];
        $val2 = $_POST['sendval2'];

	    $sql = "INSERT INTO medidas(Dia, Hora, Temp_actual, Humed_actual) VALUES ('".$d."','".$t."','".$val."','".$val2."')"; 
 
		if ($conn->query($sql) === TRUE){
		    echo "Values inserted in MySQL database table.";
		} 
        
        else{
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}


// Close MySQL connection
$conn->close();



?>