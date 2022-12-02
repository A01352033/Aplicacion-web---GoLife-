<?php

$host = "localhost";            // host = localhost because database hosted on the same server where PHP files are hosted
$dbname = "microsoft2";         // Database name
$username = "user326";          // Database username
$password = "patitos123";        // Database password


// Establish connection to MySQL database
$conn = new mysqli($host, $username, $password, $dbname);

?>


<?php

// Check if connection established successfully
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Finding connection... Please wait...<br>";
    sleep(1);
    echo "Connected to database. <br>";
}


// Select values from MySQL database table

$sql = "SELECT * FROM medidas";
//"SELECT Conteo, Dia, Hora, Temp_actual, Humed_actual FROM medidas";

$result = $conn->query($sql);

echo "<center>";

if ($result->num_rows > 0) {

    $conteo = [];
    $temp = [];
    $humed = [];

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $conteo[] = $row['Conteo'];
        $temp[] = $row['Temp_actual'];
        $humed[] = $row['Humed_actual'];
    }
    array_push($conteo, $row["Conteo"]);
    array_push($temp, $row["Temp_actual"]);
    array_push($humed, $row["Humed_actual"]);
} else {
    echo "0 results";
}

echo "</center>";

$conn->close();
?>

