<?php
//TODO completar que se cree la sesion del usuario
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["nombre"])&& isset($_POST["descripcion"]) && isset($_POST["longitud"]) 
    && isset($_POST["latitud"]) && isset($_POST["tipo"])){

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
        $descripcion= $_POST["descripcion"];
        $longitud=$_POST["longitud"];
        $latitud=$_POST["latitud"];
        $tipoCanal=$_POST["tipo"];
        $url = rand(0,100);
        $fecha = date("Y-m-d H:i:s");
        //Insert Values into the table
        $sql = "SELECT * FROM users WHERE nombre='" . $_SESSION["user"] . "'";
        if ($result = mysqli_query($conn, $sql)) {
            if ($row = mysqli_fetch_array($result)) {
                $id_user = $row["id"];
                //Insert Values into the table
                $sql = "INSERT INTO canales (url, id_user ,nombreCanal, fecha, descripcion,longitud ,latitud,nombreSensor)
        VALUES ('$url', '$id_user', '$nombre', '$fecha','$descripcion','$longitud','$latitud','$tipoCanal')";
        if (mysqli_query($conn, $sql)) {
            header('Location: misCanales.php');

            exit;
            echo "registro completado";
        } else {
            echo "fallo al registar";
        }
        // close the connection with the db
        $conn->close();


    }else{
        echo "something went wrong";
    }
        }
    }
}
