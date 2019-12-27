<!DOCTYPE html>
<head>
    <title>productos</title>
    <link rel="stylesheet" href="stylesMisCanales.css" />
    <meta http-equiv="refresh" content="url=misCanales.php">
</head>
<body>
<?php
session_start();
?>
<header><h2>Listado de productos</h2></header>
<aside><a href="meterProducto.php"><button id="botonLado">Añadir productos</button></a></aside>
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

$sql = "SELECT * FROM products";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $nombrep = $row["name"];
        $descripcion = $row["description"];
        $precio = $row["price"];
        $moneda = $row["currency"];
        $stock = $row["stock"];

        echo '<section>';
        echo '<article>';
        echo '<aside>';
        echo '<figure>';
        echo "<a href=\"eliminarProducto.php?nombrep=".$nombrep."\"><img src='papelera.jpg' alt='borrar'> </a>";
        echo '</figure>';
        echo '</aside>';
        echo "<p>Nombre del producto: $nombrep</p>";
        echo "<p>Descripción: $descripcion</p>";
        echo "<p>Precio: $precio</p>";
        echo "<p>Moneda: $moneda</p>";
        echo "<p>Stock: $stock </p>";
        echo "<a href ='modificarProducto.php?producto=$nombrep'><p>Editar</p>";
        echo "</article>";
        echo '</section';
    }
}
?>
</body>
</html>