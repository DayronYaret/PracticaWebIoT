<?php
//TODO completar que se cree la sesion del usuario

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["nombre"])&& isset($_POST["correo"]) && isset($_POST["fecha"]) 
    && isset($_POST["clave"]) && isset($_POST["clave2"]) && ($_POST["clave"]===$_POST["clave2"])){

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

        $nombre= $_POST["nombre"];
        $fecha= $_POST["fecha"];
        $email= $_POST["correo"];
        $pass=$_POST["clave"];
        $passConf=$_POST["clave2"];
        $fechaActual=date("Y-m-d H:i:s");
        //Insert Values into the table
        $sql = "INSERT INTO users (nombre, email, fechaNacimiento,passwd,fecha)
        VALUES ('$nombre', '$email', '$fecha','$pass','$fechaActual')";
        if (mysqli_query($conn, $sql)) {
            header('Location: iniciarSesion.php');

            exit;
            echo "registro completado";
        } else {
            echo "fallo al registar";
        }
        // close the connection with the db
        $conn->close();


    }else{
        echo "passConf was wrong";
    }

}