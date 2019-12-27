<!DOCTYPE html>
<head>
<meta charset="utf-8">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Plataforma Web para IoT</title>
    <link rel="stylesheet" href="stylesPrincipal.css" />
    <script>        
    function get_channels() {
            $("#canales").load("cogerCanales.php");
            setTimeout(get_channels, 100);
        };
        </script>
    <script>        
    function get_users() {
            $("#usuarios").load("cogerUsuarios.php");
            setTimeout(get_users, 100);
        };
        </script>
    <script>        
    function get_capacity() {
            $("#espacio").load("cogerTamañoTabla.php");
            setTimeout(get_capacity, 100);
        };
        </script>
    <?php
// initializing database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "practica";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // getting channels from 'canales' table
    $sql = "SELECT * FROM canales ORDER BY fecha DESC LIMIT 2"; // ORDER BY fecha DESC LIMIT 1

    // checking if operation succeeded or not
    if ($result = mysqli_query($conn, $sql)) {
        $index = 0;
        echo '<script type="text/javascript"> window.onload = function () {';
        while ($row = mysqli_fetch_array($result)) {
            $index += 1;
            $id = $row['id'];
            $nombreCanal = $row['nombreCanal'];

            // getting channels data
            $sql2 = 'SELECT * FROM datossensores WHERE id_canal="' . $id . '"'; // 

            if ($result2 = mysqli_query($conn, $sql2)) {
                $dataPoints =array();
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $dato = $row2['dato'];
                    $fecha = new DateTime($row2['fecha'], new DateTimeZone('Europe/London'));

                    $dataPoints[] = array("x" => $fecha->getTimestamp() * 1000, "y" => intval($dato));
                }

                echo 'var chart' . strval($index) . ' = new CanvasJS.Chart("chartContainer' . strval($index) . '", {
                            animationEnabled: true,
                            title:{
                                text: "' . $nombreCanal . '"
                            },
                            axisY: {
                                title: "Valor eje Y",
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
            } else {
                echo "Error selecting channels's data: " . mysqli_error($conn);
            }
        }
        echo '}</script>';
    } else {
        echo "Error selecting user's channel: " . mysqli_error($conn);
    }

    // finally closing connection
    $conn->close();
}

 ?>
</head>
<body>
<?php
    session_start();
    ?>
    <nav>
    
        <figure>
            <img id="logo" src="ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg" width="100px" height="50px" >
        </figure>
        <a id="elegido" href=>MyWebIoT</a><a id="navbar" href="canales.php">Canales</a><a id="navbar" href="ayuda.php">Ayuda</a><a id="navbar" href="contacto.php">Contacto</a> <a id="navbar" href="paypal/products.php">Productos</a>
        <?php

if(isset($_SESSION["user"])){
    $nombre = $_SESSION["user"];
    echo "<a id='navbar' href='social.php'>Social</a>";
    echo "<aside id='navbar' > Bienvenido $nombre";
    echo "<br>";
    echo "<a href='logout.php'>LogOut</a>";
}else{


?>
<aside id="login"><a id="navbar" href="iniciarSesion.php">Login</a><a id="navbar" href="registrar.php">Register</a></aside>

<?php
}
?>
    </nav>
    <aside id="asideGrande">
        <p>Información actualizada de los datos almacenados en la BBDD (al menos de los siguientes):</p>
        <br>
<p id="usuarios"> Usuarios: </p>
<p id="canales"> Canales: </p>
<p id="espacio">El tamaño de la base de datos en Kb es: </p>

        
    </aside>
    <article id="texto">
        <h2>MyWebIoT</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        
        <?php
            if(isset($_SESSION["user"])){
            }else{
        ?>

        <footer id="boton"><a href="registrar.php"><button>Empieza YA</button></a></footer>

        <?php
        }
        ?>
    </article>
    <article id="graficas">
        <h2 style="margin-left: 3%">Últimos canales</h2>
        <div class="grafica" id="chartContainer1" style="float:left"></div>
        <div class="grafica" id="chartContainer2" style="float:right; margin-right: 5%"></div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </article>
    <footer id="fondo">Footer</footer>
    <script>setTimeout(get_channels, 1000)</script>
    <script>setTimeout(get_users, 1000)</script>
    <script>setTimeout(get_capacity, 1000)</script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> 
</body>
</html>