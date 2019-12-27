<!DOCTYPE html>
<head>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<title>Datos del sensor</title>
<?php

$host = "localhost";
$database = "practica";
$user = "root";
$databasePassword = "";

// 1 Stablishing connection to Database
$connection = mysqli_connect($host, $user, $databasePassword, $database);

// 2. Managing errors

if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}

// 4. Checking if the table is created
if (isset($_GET["id"])) {

    $idCanal = $_GET["id"];
    $sqlUser = "SELECT * FROM canales WHERE id=$idCanal";

    if ($result = mysqli_query($connection, $sqlUser)) {
        $index = 0;

        echo '<script type="text/javascript"> window.onload = function () {';
        while ($row = mysqli_fetch_array($result)) {
            $nombreCanal = $row["nombreCanal"];
            $descripcionCanal = $row["descripcion"];
            $fechaCanal = $row["fecha"];
            $urlCanal = $row["url"];

            $sql2 = "SELECT * FROM datossensores WHERE id_canal=" . $idCanal . "";
            if ($result2 = mysqli_query($connection, $sql2)) {
                $dataPoints =array();
                while ($row2 = mysqli_fetch_array($result2)) {
                    $dato = $row2['dato'];
                    $fecha = new DateTime($row2['fecha'], new DateTimeZone('Europe/London'));

                    $dataPoints[] = array("x" => $fecha->getTimestamp() * 1000, "y" => intval($dato));
                }

                echo 'var chart' . strval($index) . ' = new CanvasJS.Chart("chartContainer' . strval($index) . '", {
                    animationEnabled: true,
                    title:{
                        text: "Canal: ' . $nombreCanal . '"
                    },
                    subtitles:[{
                        text: "URL:  ' . $urlCanal . '",
                        fontColor: "blue"
                    }]
                    ,
                    axisY: {
                        title: "Dato",
                    },
                    data: [{
                        type: "spline",
                        markerSize: 5,
                        xValueFormatString: "H:mm:s",
                        yValueFormatString: "#,##0.##",
                        xValueType: "dateTime",
                        dataPoints: ';
                        echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
                echo '}]
            });

            chart' . strval($index) . '.render();';
                unset($dataPoints);
            }
        }
        echo '}</script>';
    }
}
mysqli_close($connection);
?>
</head>
<body>
<div id="chartContainer0"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> 
</body>

</html>
