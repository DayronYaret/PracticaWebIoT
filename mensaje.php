<!DOCTYPE html>
<head>
    <title>Mensaje</title>
    <link rel="stylesheet" href="stylesRegistrar.css" />
</head>
<body>
<?php
session_start();
?>
<nav>
    <figure>
        <img id="logo" src="ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg" width="100px" height="50px" >
    </figure>
    <a id="navbar" href="principal.php">MyWebIoT</a><a id="navbar" href="canales.php">Canales</a><a id="navbar" href="ayuda.php">Ayuda</a><a id="navbar" href="contacto.php">Contacto</a><a id="navbar" href="paypal/products.php">Productos</a><a id='navbar' href="social.php">Social</a>
    <?php

    if(isset($_SESSION["user"])){
        $nombre = $_SESSION["user"];
        $id = $_SESSION["id"];
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
<section>
    <?php
    ?>
    <form action="formularioMensaje.php" method="POST">
        Nombre <select name="amigos" required>
            <?php
            echo "<option value ='$nombre'> $nombre </option>";
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

                $sql1 = "SELECT * FROM amigos WHERE id_user = $id";
            if ($result1 = mysqli_query($conn, $sql1)) {
            while ($row1 = mysqli_fetch_array($result1)) {
            $idAmigo = $row1["id_amigo"];
            $sql2 = "SELECT * FROM users WHERE id=$idAmigo";
                if ($result2 = mysqli_query($conn, $sql2)) {
                    while ($row2 = mysqli_fetch_array($result2)) {
                    $nombreAmigo = $row2["nombre"];
                    echo "<option value ='$nombreAmigo'> $nombreAmigo </option>";
                    }
                }
            }
            }
            }
            ?>
        </select> <br> <br>
        <select name="privacidad" required>
            <option value="0">Publico</option>
            <option value="1">Privado</option>
        </select><br> <br>
        <textarea name="mensaje" required></textarea> <br> <br>
        <a href="social.php"><button id="boton">Cancelar</button></a> <input type="submit" value="Enviar">
    </form>
</section>
<footer id="fondo">Footer</footer>
</body>
</html>