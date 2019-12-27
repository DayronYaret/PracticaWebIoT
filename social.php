<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Red social WebIoT</title>
    <link rel="stylesheet" href="stylesSocial.css" />

    <script>
        function get_mensajes(){
            $("#mensajes").load("ajaxMensaje.php");
            setTimeout(get_mensajes, 1000);
        }
    </script>
</head>
<body>
<?php
session_start();
?>
<nav>

    <figure>
        <img id="logo" src="ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg" width="100px" height="50px" >
    </figure>
    <a id="navbar" href="principal.php">MyWebIoT</a><a id="navbar" href="canales.php">Canales</a><a id="navbar" href="ayuda.php">Ayuda</a><a id="navbar" href="contacto.php">Contacto</a><a id="navbar" href="paypal/products.php">Productos</a>
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
<article id="perfiles">
<h2>Mi perfil</h2>
    <figure>
        <img id="perfil" src="man.png">
    </figure>
    <br>
    <?php
    echo "<a href='perfil.php?user=$nombre' <p> $nombre </p> </a>";
    ?>
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
            $sql = "SELECT * FROM perfiles WHERE id_user = '$id'";
            if ($result = mysqli_query($conn, $sql)) {
                while ($row = mysqli_fetch_array($result)) {
                    $estado = $row["descripcion"];
                    echo $estado;
                }
        }
    }
    ?>
    </p>
</article>
    <article id="opciones">
<h2>Opciones</h2>
        <a href="mensaje.php"><button id="impar">Mensajes</button></a>
        <a href="miembros.php"><button id="par">Miembros</button></a>
        <a href="canalesAmigos.php"><button id="impar">Canales</button></a>
        <a href="amigos.php"><button id="par">Amigos</button></a>
        <a href="modificarPerfil.php"><button id="impar">Perfil</button></a>
    </article>
</section> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<section>
    <article id="texto">
        <h2>Muro de WebIoT</h2>
        <div id="mensajes"> Mensajes recientes </div>
    </article>
</section>
<footer id="fondo">Footer</footer>
<script>setTimeout(get_mensajes, 1000)</script>
</body>
</html>