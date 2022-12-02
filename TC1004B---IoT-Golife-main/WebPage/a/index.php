<?php
$con = mysqli_connect("localhost", "root", "", "microsoft2");
if (!$con) {
    echo "Problem in database connection..." . mysqli_error();
} else {
    $sql = "SELECT * FROM medidas";
    $result = mysqli_query($con, $sql);
    $chart_data = "";
    while ($row = mysqli_fetch_array($result)) {
        $productname[] = $row['Conteo'];
        $sales[] = $row['Temp_actual'];
        $goldemexico[] = $row['Humed_actual'];
        $horagol[] = $row['Hora'];
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Bargraph in PHP and MYSQL</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <section>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg">
                        <h1>Bargraph in PHP and MYSQL</h1>
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
                            fontSize: 14,
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
                        <h1>Bargraph in PHP and MYSQL</h1>
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
                            fontSize: 14,
                        }
                    },
                }
            });
        </script>
    </section>
</body>

</html>