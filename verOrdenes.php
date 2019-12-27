<!DOCTYPE html>
<head>
    <title>Ordenes</title>
    <link rel="stylesheet" href="stylesCanales.css" />
</head>
<body>
<?php
session_start();
?>

<header><h2>Listado de todas las ordenes</h2></header>

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
$sql = "SELECT * FROM orders";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $idOrden = $row['id'];
        $clienteId = $row["cliente_id"];
        $total = $row["total"];
        $fecha = $row["fecha"];
        $estado = $row["estado"];

        $sql2 = "SELECT * FROM users WHERE id = '$clienteId'";
if ($result2 = mysqli_query($conn, $sql2)) {
    while ($row2 = mysqli_fetch_array($result2)) {
    $nombreUsuario = $row2["nombre"];
    }
}
        echo '<section>';
        echo '<article>';
        echo "<p>Nombre del cliente: $nombreUsuario</p>";
        echo "<p>Precio total: $total</p>";
        echo "<p>Fecha: $fecha</p>";
        echo "<p>Estado: $estado</p>";
        echo "<a href='verOrden.php?id=$idOrden'> <button>Ver informacion de la orden</button> </a>";
        echo "</article>";
        echo '</section>';
    }
}
?>
<a href="datosCanal.php?url=$url"></a>
</body>
</html>