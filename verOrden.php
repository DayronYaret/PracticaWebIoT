<!DOCTYPE html>
<head>
    <title>Orden</title>
    <link rel="stylesheet" href="stylesCanales.css" />
</head>
<body>
<?php
session_start();
?>

<header><h2>Listado de los productos de la orden</h2></header>

<?php
if(isset($_GET["id"])){
    $idOrden = $_GET["id"];
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
$sql = "SELECT * FROM order_items WHERE order_id = '$idOrden' ";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $idProducto = $row["product_id"];
        $cantidad = $row["quantity"];

        $sql2 = "SELECT * FROM products WHERE id = '$idProducto'";
        if ($result2 = mysqli_query($conn, $sql2)) {
            while ($row2 = mysqli_fetch_array($result2)) {
                $nombreProducto = $row2["name"];
                $precio = $row2["price"];
                $moneda = $row2["currency"];
                $precioTotal = $cantidad * $precio;
            }
        }
        echo '<section>';
        echo '<article>';
        echo "<p>Nombre del producto: $nombreProducto</p>";
        echo "<p>Precio: $precio $moneda</p>";
        echo "<p>Cantidad: $cantidad</p>";
        echo "<p>Precio total: $precioTotal $moneda</p>";
        echo "</article>";
        echo '</section>';
    }
}
}
?>
<a href="datosCanal.php?url=$url"></a>
</body>
</html>