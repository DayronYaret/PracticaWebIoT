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
$sql = 'SHOW TABLE STATUS';

if ($result = mysqli_query($conn, $sql)) {
    $dbSize = 0;

    while ($row = mysqli_fetch_array($result)) {
        $dbSize += $row["Data_length"] + $row["Index_length"];
    }

    // from bytes to kbytes
    $dbSizeK = $dbSize / 1024;

    echo "<p>Bytes/MB almacenados -> $dbSizeK KiB</p>";
    mysqli_close($conn);
}
?>