<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Red social WebIoT</title>
    <link rel="stylesheet" href="stylesPerfil.css" />
</head>
<body>
<?php
session_start();
?>
<nav>

    <figure>
        <img id="logo" src="ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg" width="100px" height="50px" >
    </figure>
    <a id="navbar" href="principal.php">MyWebIoT</a><a id="navbar" href="canales.php">Canales</a><a id="navbar" href="ayuda.php">Ayuda</a><a id="navbar" href="paypal/products.php">Productos</a><a id="navbar" href="contacto.php">Contacto</a>
    <?php

    if(isset($_SESSION["user"])){
        $nombre = $_SESSION["user"];
        $id = $_SESSION["id"];
        echo "<a id='elegido' href=>Social</a>";
        echo "<aside id='navbar' > Bienvenido $nombre";
        echo "<br>";
        echo "<a href='logout.php'>LogOut</a>";
    }else{
        header("Location: principal.php");


        ?>
        <aside id="login"><a id="navbar" href="iniciarSesion.php">Login</a><a id="navbar" href="registrar.php">Register</a></aside>

        <?php
    }
    ?>
</nav>
<?php
if(isset($_GET["user"])) {
    $nombreUsuario = $_GET["user"];
    ?>
    <article id="texto">
        <h2>Mi perfil</h2>
        <figure>
            <img id="perfil" src="man.png">
        </figure>
        <p>Nombre : <?php echo $nombreUsuario ?></p>
        <p> Estado : <?php
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
                $sql1 = "SELECT * FROM users WHERE nombre = '$nombreUsuario'";
                if ($result1 = mysqli_query($conn, $sql1)) {
                    while ($row1 = mysqli_fetch_array($result1)) {
                        $idUsuario = $row1["id"];
                        $sql = "SELECT * FROM perfiles WHERE id_user = '$idUsuario'";
                        if ($result = mysqli_query($conn, $sql)) {
                            while ($row = mysqli_fetch_array($result)) {
                                $estado = $row["descripcion"];
                                echo $estado;
                            }
                        }
                    }
                }

                ?>
                </p>
                </article>
                </section>
                <section>
                    <article id="texto">
                        <h2>Muro de WebIoT</h2>
                        <div id="mensajes"> Mensajes recientes</div>
                        <?php
                        if($nombre == $nombreUsuario){
                            $sql = "SELECT * FROM mensajes  WHERE id_receptor = '$idUsuario' ORDER BY fecha DESC";
                            if ($result = mysqli_query($conn, $sql)) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $mensaje = $row["mensaje"];
                                    $idUsuario = $row["id_user"];
                                    $idAmigo = $row["id_receptor"];
                                    $fecha = $row["fecha"];
                                    $privacidad = $row["privado"];
                                    $sql2 = "SELECT * FROM users WHERE id = '$idUsuario'";
                                    if ($result2 = mysqli_query($conn, $sql2)) {
                                        while ($row2 = mysqli_fetch_array($result2)) {
                                            $nombreUsuario = $row2["nombre"];
                                        }
                                    }
                                    $sql3 = "SELECT * FROM users WHERE id = '$idAmigo'";
                                    if ($result3 = mysqli_query($conn, $sql3)) {
                                        while ($row3 = mysqli_fetch_array($result3)) {
                                            $nombreAmigo = $row3["nombre"];
                                        }
                                    }
                                    if($privacidad ==1){
                                        echo "<p> Susurro de $nombreUsuario a $nombreAmigo hecho el $fecha</p>";
                                        echo "<p> $mensaje </p>";
                                    }else {
                                        echo "<p> Mensaje de $nombreUsuario a $nombreAmigo hecho el $fecha</p>";
                                        echo "<p> $mensaje </p>";
                                    }
                                }
                            }
                        }else {
                            $sql = "SELECT * FROM mensajes  WHERE privado = 0 AND id_receptor = '$idUsuario' ORDER BY fecha DESC";
                            if ($result = mysqli_query($conn, $sql)) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $mensaje = $row["mensaje"];
                                    $idUsuario = $row["id_user"];
                                    $idAmigo = $row["id_receptor"];
                                    $fecha = $row["fecha"];
                                    $sql2 = "SELECT * FROM users WHERE id = '$idUsuario'";
                                    if ($result2 = mysqli_query($conn, $sql2)) {
                                        while ($row2 = mysqli_fetch_array($result2)) {
                                            $nombreUsuario = $row2["nombre"];
                                        }
                                    }
                                    $sql3 = "SELECT * FROM users WHERE id = '$idAmigo'";
                                    if ($result3 = mysqli_query($conn, $sql3)) {
                                        while ($row3 = mysqli_fetch_array($result3)) {
                                            $nombreAmigo = $row3["nombre"];
                                        }
                                    }
                                    echo "<p> Mensaje de $nombreUsuario a $nombreAmigo hecho el $fecha</p>";
                                    echo "<p> $mensaje </p>";
                                }
                            }
                        $sql = "SELECT * FROM mensajes  WHERE privado = 1 AND id_user = '$id' AND id_receptor = '$idAmigo' ORDER BY fecha DESC";
                        if ($result = mysqli_query($conn, $sql)) {
                        while ($row = mysqli_fetch_array($result)) {
                            $mensaje = $row["mensaje"];
                            $fecha = $row["fecha"];
                            echo "<p> Susurro de $nombreUsuario a $nombreAmigo hecho el $fecha</p>";
                            echo "<p> $mensaje </p>";
                        }
                        }
                        }
                        ?>
                    </article>
                </section>
                <?php
            }
}
?>
<footer id="fondo">Footer</footer>
</body>
</html>