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
$idUser = $_GET["id"];
echo $idUser;
// delete a channel form the 'canales' table
$sql = 'DELETE FROM canales WHERE id="'.$_GET['id'].'"'; // todo: saber referencia para eliminar (preguntar)

// checking if operation succeeded or not
if (mysqli_query($conn, $sql)) {
    echo "Channel deleted correctly";
    header('Location: misCanales.php');
    die();
} else {
    echo "Error deleting channel: " . mysqli_error($conn);
}

// finally closing connection
$conn->close();