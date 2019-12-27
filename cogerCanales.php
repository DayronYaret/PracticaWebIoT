<?php
$host = "localhost";
$database = "practica";
$user = "root";
$databasePassword = "";

// 1 Stablishing connection to Database
$connection = mysqli_connect($host, $user, $databasePassword, $database);

$fechaCanal = date("Y-m-d H:i:s");

// 2. Managing errors

if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}

// 4. Checking if the table is created

$sqlUser = "SELECT * FROM canales";
$numero_canales = 0;
if ($result = mysqli_query($connection, $sqlUser)) {
    $numero_canales = mysqli_num_rows($result);
}

echo "<p>Canales: $numero_canales</p>";

mysqli_close($connection);