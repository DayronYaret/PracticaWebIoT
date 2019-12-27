<?php
session_start();
if(isset($_SESSION["user"])) {
    if ($_SESSION["user"] == "admin") {
        if (isset($_POST["id"])&&isset($_POST["nombre"])&&isset($_POST["descripcion"])&&isset($_POST["precio"])&&isset($_POST["stock"])&&isset($_POST["moneda"])) {
            $id = $_POST["id"];
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $precio = $_POST["precio"];
            $stock = $_POST["stock"];
            $moneda = $_POST["moneda"];
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
                $sql = "UPDATE products
    SET name = '$nombre', description = '$descripcion', price = '$precio', currency = '$moneda', stock = '$stock'
    WHERE id = '$id'";

                if (mysqli_query($conn, $sql)) {
                    header('Location: verProducto.php');
                }else {
                    echo "error en sql";
                }
            }
        }
    }
}


?>