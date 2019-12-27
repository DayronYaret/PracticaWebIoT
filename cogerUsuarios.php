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
$sql = "SELECT * FROM users";
$numeroUsuarios=0;
if ($result = mysqli_query($conn, $sql)) {
    $numeroUsuarios = mysqli_num_rows($result);
}
echo "<p> Usuarios: $numeroUsuarios </p>";

?>