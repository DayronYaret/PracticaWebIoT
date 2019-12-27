<?php
session_start();
if (isset($_POST["amigos"]) && isset($_POST["mensaje"]) && isset($_POST["privacidad"])) {
    $nombreAmigo = $_POST["amigos"];
    $mensaje = $_POST["mensaje"];
    $privacidad = $_POST["privacidad"];
    $id = $_SESSION["id"];
    $fecha = date("Y-m-d H:i:s");
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
        $sql = "SELECT * FROM users WHERE nombre = '$nombreAmigo'";
        if ($result = mysqli_query($conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $idAmigo = $row["id"];
                $sql2 = "INSERT INTO mensajes (id_user, id_receptor, privado, fecha, mensaje)
            VALUES ('$id','$idAmigo','$privacidad','$fecha','$mensaje')";
            }
            if (mysqli_query($conn, $sql2)) {
                header('Location: social.php');
                echo "registro completado";
                exit;

            } else {
                echo "fallo al registar";
            }
            // close the connection with the db
            $conn->close();
        } else {
            echo "something went wrong";
        }
    }
}

?>