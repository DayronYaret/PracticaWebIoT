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
    <a id="navbar" href="principal.php">MyWebIoT</a><a id="navbar" href=>Canales</a><a id="navbar" href="ayuda.php">Ayuda</a><a id="navbar" href="contacto.php">Contacto</a><a id="navbar" href="paypal/products.php">Productos</a><a id='navbar' href='social.php'>Social</a>

    <?php

    if(isset($_SESSION["user"])){
        $nombre = $_SESSION["user"];
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
<section>
    <header><h2>Listado de sus canales</h2></header>
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
        echo '<article>';
        echo "<p>Información sobre el Canal: $nombreCanal</p>";
        echo "<p>Autor: $nombreUsuario</p>";
        echo "<p>Descripción: $descripcionCanal</p>";
        echo "<p>Fecha: $fechaCanal</p>";
        echo "<p>Enlace URL: <a href= datosCanal.php?id=$idCanal> $urlCanal </a></p>";
        echo "</article>";
    }
}
?>
</section>
<section>
    <header><h2>Listado de los canales de sus amigos</h2></header>
    <?php
    $sql1 = "SELECT * FROM amigos WHERE id_user = $idUser";
    if ($result1 = mysqli_query($conn, $sql1)) {
    while ($row1 = mysqli_fetch_array($result1)) {
        $idAmigo = $row1["id_amigo"];
        $sql2 = "SELECT * FROM canales WHERE id_user = $idAmigo";
    if ($result2 = mysqli_query($conn, $sql2)) {
        while ($row2 = mysqli_fetch_array($result2)) {
            $nombreCanal2 = $row2["nombreCanal"];
            $descripcionCanal2 = $row2["descripcion"];
            $fechaCanal2 = $row2["fecha"];
            $urlCanal2 = $row2["url"];
            $idCanal2 = $row2["id"];
            $sql3 = "SELECT nombre FROM users WHERE id = '$idAmigo'";
            if ($result3 = mysqli_query($conn, $sql3)) {
                if ($row3= mysqli_fetch_array($result3)) {
                    $nombreUsuario2 = $row3["nombre"];
                }
            }
            echo '<article>';
            echo "<p>Información sobre el Canal: $nombreCanal2</p>";
            echo "<p>Autor: $nombreUsuario2</p>";
            echo "<p>Descripción: $descripcionCanal2</p>";
            echo "<p>Fecha: $fechaCanal2</p>";
            echo "<p>Enlace URL: <a href= datosCanal.php?id=$idCanal2> $urlCanal2 </a></p>";
            echo "</article>";
        }
    }
    }
    }


    ?>
</section>
</body>
</html>