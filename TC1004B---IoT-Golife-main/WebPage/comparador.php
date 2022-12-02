<?php

$host = "localhost";            // host = localhost because database hosted on the same server where PHP files are hosted
$dbname = "microsoft2";         // Database name
$username = "user326";          // Database username
$password = "patitos123";        // Database password


// Establish connection to MySQL database
$conn = new mysqli($host, $username, $password, $dbname);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparador</title>
    <meta http-equiv="refresh" content="10">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@latest/dist/Chart.min.js"> </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/comparador.css">


</head>

<body>

    <header class="hero">
        <nav class="nav container">

            <div class="nav_logo">
                <h2 class="nav_title">Comparador</h2>

            </div>

            <ul class="nav_link nav_link--menu">

                <li class="nav_items">
                    <a href="index.html" class="nav_links">Inicio </a>

                </li>

                <!--li class="nav_items">
                    <a  class="Comparador"href="comparador.html" class="nav_links">Comparador </a>

                </li-->

                <img src="./images/close.svg" class="nav_close">

            </ul>

            <div class="nav_menu">
                <img src="./images/menu.svg" class="nav_img">

            </div>



        </nav>

        <section class="hero_container container">
            <h1 class="hero_title"> Comparacion de los diferentes tipos de plantas con la base de datos</h1>
            <p class="hero_paragraph"> Aprende a diferenciar las temperaturas de las plantas .

            </p>


        </section>



    </header>

    <main>
        <section class="container about">
            <a name="¿Que aprenderas en esta pagina web?"> </a>
            <h2 class="subtitle">¿Que aprenderas en esta seccion? </h2>
            <p class="about_paragraph">Aprenderas a diferenciar las temperaturas de los diferentes tipos de plantas, mediante la base de datos <br> en donde se compararan
                la temperatura ideal y a la que se encuentra.


            </p>

            <div class="about_main">
                <article class="about_icons">
                    <img src="./images/data.svg" class="about_icon">
                    <h3 class="about_title">Anuales </h3>
                    <a href="#Tipos de plantas anuales" class="cta"> Temperatura de plantas anuales</a>
                    <p class="about_paragraph">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sit iste eveniet illum natus? </p>




                </article>

                <article class="about_icons">
                    <img src="./images/data.svg" class="about_icon">
                    <h3 class="about_title">Bianuales </h3>
                    <a href="#Tipos de plantas bianuales" class="cta"> Temperatura de plantas bianuales </a>
                    <p class="about_paragraph">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sit iste eveniet illum natus? </p>




                </article>

                <article class="about_icons">
                    <img src="./images/data.svg" class="about_icon">
                    <h3 class="about_title">Perennes </h3>
                    <a href="#Tipos de plantas perennes" class="cta"> Temperatura de plantas perennes </a>
                    <p class="about_paragraph">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sit iste eveniet illum natus? </p>




                </article>



            </div>






        </section>



        <h1>Temperatura de plantas anuales - Grafica de barras </h1>
        <a href="../index.html"> Ir al inicio</a>
        <canvas id="grafica"> </canvas>
        <script src="./js/main.js"> </script>


        <?php

        // Check if connection established successfully
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            echo "Finding connection... Please wait...<br>";
            sleep(1);
            echo "Connected to database. <br>";
        }
        $all = "SELECT * FROM medidas ORDER BY Conteo DESC LIMIT 25";
        $resultall = mysqli_query($conn, $all);
        $chart_data = "";
        while ($row = mysqli_fetch_array($resultall)) {
            $productname[] = $row['Conteo'];
            $sales[] = $row['Temp_actual'];
            $goldemexico[] = $row['Humed_actual'];
            $horagol[] = $row['Hora'];
        }

        // Select values from MySQL database table

        $sql = "SELECT * FROM medidas ORDER BY Conteo DESC LIMIT 1";
        //"SELECT Conteo, Dia, Hora, Temp_actual, Humed_actual FROM medidas";

        $result = $conn->query($sql);

        echo "<center>";

        if ($result->num_rows > 0) {

            // Output data of each row
            while ($row = $result->fetch_assoc()) {

                echo "<strong> # Reg.:</strong> " . $row["Conteo"] . " &nbsp <strong>Dia:</strong> " . $row["Dia"] . " &nbsp
        <strong>Hora:</strong> " . $row["Hora"] . " &nbsp <strong>Temp en °C:</strong> " . $row["Temp_actual"] . " &nbsp
        <strong>Humedad en %:</strong>" . $row["Humed_actual"] . "<p>";
            }
        } else {
            echo "0 results";
        }

        echo "</center>";


        $conn->close();

        ?>






    </main>


    <section>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg">
                        <h1>Temperaturas </h1>
                    </div>
                    <div class="card-body">
                        <canvas id="chartjs_bar"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
        <script type="text/javascript">
            var ctx = document.getElementById("chartjs_bar").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($productname); ?>,
                    datasets: [{
                        backgroundcolor: [
                            "#ffd322",
                            "#5945fd",
                            "#25d5f2",
                            "#2ec551",
                            "#ff344e",
                        ],
                        data: <?php echo json_encode($sales); ?>
                    }]
                },
                options: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {

                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 0,
                        }
                    },
                }
            });
        </script>
    </section>
    <br>
</body>

<body>
    <section>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card2">
                    <div class="card-header bg">
                        <h1>Humedad por tiempo</h1>
                    </div>
                    <div class="card-body">
                        <canvas id="chartjs_bar2"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
        <script type="text/javascript">
            var ctx = document.getElementById("chartjs_bar2").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($horagol); ?>,
                    datasets: [{
                        backgroundcolor: [
                            "#ffd322",
                            "#5945fd",
                            "#25d5f2",
                            "#2ec551",
                            "#ff344e",
                        ],
                        data: <?php echo json_encode($goldemexico); ?>
                    }]
                },
                options: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 0,
                        }
                    },
                }
            });
        </script>
    </section>


</body>

</html>