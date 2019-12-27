<?php
echo "hola";
if($_SERVER["REQUEST_METHOD"]=="GET"){
    echo "hola1";
    if(isset($_GET["dato"]) && isset($_GET["url"])){
        echo "hola2";
        $datoSensor = $_GET["dato"];
        $urlSensor = $_GET["url"];
        $fechaSensor = date("Y-m-d H:i:s");

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "practica";

        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
        $sql = "SELECT id FROM canales WHERE url='" . $urlSensor . "'";
        if ($result = mysqli_query($conn, $sql)) {
            if ($row = mysqli_fetch_array($result)) {
                $idCanal = $row["id"];
                //Insert Values into the table
                $sql = "INSERT INTO datossensores (id_canal, dato ,fecha) VALUES ('$idCanal', '$datoSensor', '$fechaSensor')";
        if (mysqli_query($conn, $sql)) {
            exit;
            echo "registro completado";
            } else {
            echo "fallo al registar";
                }
            }
        }
    }
}

?>