<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Red social WebIoT</title>
    <link rel="stylesheet" href="stylesAmigos.css" />

</head>
<body>
<?php
session_start();
?>
<nav>

    <figure>
        <img id="logo" src="ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg" width="100px" height="50px" >
    </figure>
    <a id="navbar" href="principal.php">MyWebIoT</a><a id="navbar" href="canales.php">Canales</a><a id="navbar" href="ayuda.php">Ayuda</a><a id="navbar" href="contacto.php">Contacto</a><a id="navbar" href="paypal/products.php">Productos</a><a id='navbar' href= social.php>Social</a>
    <?php

    if(isset($_SESSION["user"])){
        $nombre = $_SESSION["user"];
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
<article id="texto">
    <h2>Bienvenidos a la red social de WebIoT</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

    <?php
    if(isset($_SESSION["user"])){
    }else{
        ?>

        <footer id="boton"><a href="registrar.php"><button>Empieza YA</button></a></footer>

        <?php
    }
    ?>
</article>
<article id="siguiendo">
    <h2>Personas a las que sigues</h2>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "practica";
    $idUser = $_SESSION["id"];

    // create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
    $sql1 = "SELECT * FROM amigos WHERE id_user =$idUser";
    if ($result1 = mysqli_query($conn, $sql1)) {
        while ($row1 = mysqli_fetch_array($result1)) {
            $idSeguiendo = $row1["id_amigo"];
            $sql2 = "SELECT * FROM users WHERE id = $idSeguiendo";
            if ($result2 = mysqli_query($conn, $sql2)) {
                while ($row2 = mysqli_fetch_array($result2)) {
                    $nombreAmigo = $row2["nombre"];
                    echo "<a href='perfil.php?user=$nombreAmigo'> <p>$nombreAmigo </p> </a>";
                }
            }
        }
    }

    ?>
</article>
<article id="amigos">
    <h2>Amigos</h2>
    <?php
    $sql1 = "SELECT * FROM amigos WHERE id_amigo =$idUser";
    if ($result1 = mysqli_query($conn, $sql1)) {
        while ($row1 = mysqli_fetch_array($result1)) {
            $idAmigo1 = $row1["id_user"];
            $sql2 = "SELECT * FROM amigos WHERE id_user =$idUser";
            if ($result2 = mysqli_query($conn, $sql2)) {
                while ($row2 = mysqli_fetch_array($result2)) {
                    $idAmigo2 = $row2["id_amigo"];
                    if ($idAmigo1 == $idAmigo2) {
                        $sql3 = "SELECT * FROM users WHERE id=$idAmigo1";
                        if ($result3 = mysqli_query($conn, $sql3)) {
                            while ($row3 = mysqli_fetch_array($result3)) {
                                $nombreAmigo1 = $row3["nombre"];
                                echo "<a href='perfil.php?user=$nombreAmigo1' <p>$nombreAmigo1</p>";
                            }
                        }
                    }
                }
            }
        }
    }
    }
    ?>
</article>
</section> <br><br><br><br><br><br><br><br><br><br><br><br>

<footer id="fondo">Footer</footer>

</body>
</html>