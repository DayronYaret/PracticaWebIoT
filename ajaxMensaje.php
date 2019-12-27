<?php
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
$sql = "SELECT * FROM mensajes  WHERE privado = 0 ORDER BY fecha DESC LIMIT 5";
if ($result = mysqli_query($conn, $sql)) {
while ($row = mysqli_fetch_array($result)) {
$mensaje = $row["mensaje"];
$idUsuario = $row["id_user"];
$idAmigo = $row["id_receptor"];
$fecha = $row["fecha"];
$sql2 = "SELECT * FROM users WHERE id = '$idUsuario'";
if ($result2 = mysqli_query($conn, $sql2)) {
while ($row2 = mysqli_fetch_array($result2)) {
$nombreUsuario = $row2["nombre"];
}
}
$sql3 = "SELECT * FROM users WHERE id = '$idAmigo'";
if ($result3 = mysqli_query($conn, $sql3)) {
while ($row3 = mysqli_fetch_array($result3)) {
$nombreAmigo = $row3["nombre"];
}
}
echo "<p> Mensaje de $nombreUsuario a $nombreAmigo hecho el $fecha</p>";
echo "<p> $mensaje </p>";

}
}

}
?>