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
}
// delete a channel form the 'canales' table
$_GET["nombrep"];
$sql = 'DELETE FROM products WHERE name="'.$_GET['nombrep'].'"';

// checking if operation succeeded or not
if (mysqli_query($conn, $sql)) {
    echo "Channel deleted correctly";
    header('Location: verProducto.php');
    die();
} else {
    echo "Error deleting channel: " . mysqli_error($conn);
}

// finally closing connection
$conn->close();