<!DOCTYPE html>
<head>
    <title>Mis canales en MyWebIoT</title>
    <link rel="stylesheet" href="stylesMisCanales.css" />
    <meta http-equiv="refresh" content="url=misCanales.php">
</head>
<body>
    <?php
    session_start();
    ?>
    <nav>
        <figure>
            <img id="logo" src="ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg" width="100px" height="50px" >
        </figure>
        <a id="navbar" href="principal.php">MyWebIoT</a><a id="elegido" href=>Canales</a><a id="navbar" href="ayuda.php">Ayuda</a><a id="navbar" href="contacto.php">Contacto</a><a id="navbar" href="paypal/products.php">Productos</a>

        <?php

            if(isset($_SESSION["user"])){
                $nombre = $_SESSION["user"];
                echo "<a id='navbar' href=social.php>Social</a>";
                echo "<aside id='navbar' > Bienvenido $nombre";
                echo "<br>";
                echo "<a href='logout.php'>LogOut</a>";
            }else{
                header('Location: principal.php');
            
            ?>
        <aside id="login"><a id="navbar" href="iniciarSesion.php">Login</a><a id="navbar" href="registrar.php">Register</a></aside>

        <?php
            }
            ?>

    </nav>
    <header><h2>Listado de todos sus canales dados de alta</h2></header>
    <aside><a href="registrarSensor.php"><button id="botonLado">Añadir canal</button></a></aside>
    <?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "practica";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM users WHERE nombre = '$nombre'";
        
        if ($result = mysqli_query($conn, $sql)) {
            if ($row = mysqli_fetch_array($result)) {
        $idUser = $row["id"];
        }
    }
    $sql = "SELECT * FROM canales WHERE id_user = $idUser";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $nombreCanal = $row["nombreCanal"];
        $descripcionCanal = $row["descripcion"];
        $fechaCanal = $row["fecha"];
        $urlCanal = $row["url"];
        $idCanal = $row["id"];
        

        $sql2 = "SELECT nombre FROM users WHERE id = '$idUser'";
        if ($result2 = mysqli_query($conn, $sql2)) {
            if ($row2 = mysqli_fetch_array($result2)) {
        $nombreUsuario = $row2["nombre"];
        }
    }
        echo '<section>';
        echo '<article>';
        echo '<aside>';
        echo '<figure>';
        echo "<a href=\"eliminarCanal.php?id=".$idCanal."\"><img src='papelera.jpg' alt='borrar'> </a>";
        echo '</figure>';
        echo '</aside>';
        echo "<p>Información sobre el Canal: $nombreCanal</p>";
        echo "<p>Autor: $nombreUsuario</p>";
        echo "<p>Descripción: $descripcionCanal</p>";
        echo "<p>Fecha: $fechaCanal</p>";
        echo "<p>Enlace URL: <a href= datosCanal.php?id=$idCanal> $urlCanal </a></p>";
        echo "</article>";
        echo '</section';
    }
}
    ?>
</body>
</html>