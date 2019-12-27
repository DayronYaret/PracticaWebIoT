<?php
session_start();
$id = $_SESSION["id"];
if(isset($_POST["perfil"])&& $_POST["actualizar"] == 0){
$perfil = $_POST["perfil"];
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
        
        $sql = "INSERT INTO perfiles(id_user, descripcion)
        VALUES('$id', '$perfil')";
        if (mysqli_query($conn, $sql)) {
            header('Location: social.php');
            echo "registro completado";
            exit;

        } else {
            echo "fallo al registar";
        }
        
    }
}if(isset($_POST["perfil"])&& $_POST["actualizar"] == 1){
    $perfil = $_POST["perfil"];
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
    $sql = "UPDATE perfiles
    SET descripcion = '$perfil'
    WHERE id_user = '$id'";

     if (mysqli_query($conn, $sql)) {
        header('Location: social.php');
     }else {
         echo "error en sql";
     }
    }
}

?>