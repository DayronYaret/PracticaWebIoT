<?php
//TODO completar login, comparar valores del input con la base de datos.
session_start();

if (isset($_POST["correo"]) && isset($_POST["clave"])) {
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

    $email = $_POST["correo"];
    $password =$_POST["clave"];

    if($email == "admin@admin.admin" && $password == "admin"){
        $_SESSION["user"] = "admin";
        header('Location: administrador.php');
        exit;


    }else {

        $sql = "SELECT * FROM users WHERE email='$email' AND passwd='$password'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                if ($row["email"] == $email && $row["passwd"] == $password) {
                    $name = $row["email"];
                    $pass = $row["passwd"];
                    $nombre = $row["nombre"];
                    $id = $row["id"];
                    echo "Hello: $email" . " $pass";
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["user"] = $row["nombre"];
                    $_SESSION["id"] = $id;
                    header('Location: misCanales.php');


                    exit;
                }
            }
        }
    }
    $conn->close();

    header('Location: iniciarSesion.php');
    exit;


}else{
    echo "No set";
}