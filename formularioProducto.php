<?php
if(isset($_POST["nombre"])&&isset($_POST["descripcion"])&&isset($_POST["precio"])&&isset($_POST["moneda"])){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "practica";
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $moneda = $_POST["moneda"];

    // create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $sql = "INSERT INTO products (name, description, price, currency)
                VALUES('$nombre', '$descripcion', '$precio', '$moneda')";
        if (mysqli_query($conn, $sql)) {
        echo "producto insertado correctamente";
        }else{
            echo "error en la sql";
        }
    }
    }

?>