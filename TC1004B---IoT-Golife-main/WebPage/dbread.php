<?php

    $host = "localhost";            // host = localhost because database hosted on the same server where PHP files are hosted
    $dbname = "microsoft2";         // Database name
    $username = "user326";          // Database username
    $password = "patitos123";	    // Database password


// Establish connection to MySQL database
$conn = new mysqli($host, $username, $password, $dbname);


// Check if connection established successfully
if ($conn->connect_error) {
    die("Connection failed: " . $conn-> connect_error);
}

else { 
    echo "Connected to mysql database. <br>"; 
}


// Select values from MySQL database table

$sql = "SELECT    *
FROM      medidas
ORDER BY  Conteo DESC
LIMIT     1";
//"SELECT Conteo, Dia, Hora, Temp_actual, Humed_actual FROM medidas";

$result = $conn->query($sql);

echo "<center>";

if ($result->num_rows > 0) {


    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<strong> # Reg.:</strong> " . $row["Conteo"]. " &nbsp <strong>Dia:</strong> " . $row["Dia"]. " &nbsp <strong>Hora:</strong> " . $row["Hora"]. " &nbsp <strong>Temp en °C:</strong> " . $row["Temp_actual"]." &nbsp <strong>Humedad en %:</strong>" .$row["Humed_actual"]. "<p>";
    }
} 

else{
    echo "0 results";
}

echo "</center>";

$conn->close();



?>