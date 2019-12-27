<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Red social WebIoT</title>
    <link rel="stylesheet" href="stylesRegistrar.css" />

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
    <a id="navbar" href="principal.php">MyWebIoT</a><a id="navbar" href="canales.php">Canales</a><a id="navbar" href="ayuda.php">Ayuda</a><a id="navbar" href="contacto.php">Contacto</a><a id='navbar' href="social.php">Social</a>
    <?php

    if(isset($_SESSION["user"]) && isset($_SESSION["id"])){
        $nombre = $_SESSION["user"];
        $id = $_SESSION["id"];
        echo "<aside id='navbar' > Bienvenido $nombre";
        echo "<br>";
        echo "<a href='logout.php'>LogOut</a>";
    }else{


        ?>
        <aside id="login"><a id="navbar" href="iniciarSesion.php">Login</a><a id="navbar" href="registrar.php">Register</a></aside>

        <?php
    }
    ?>
    </nav>
    <section>
    <article>
    <?php
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
        $sql = "SELECT * FROM perfiles WHERE id_user = $id";
        $perfil=0;
if ($result = mysqli_query($conn, $sql)) {
    $perfil = mysqli_num_rows($result);
}
if($perfil == 0){
    ?>
    <form action="actualizarPerfil.php" method="POST">
    <textarea name="perfil" required></textarea> <br><br>
    <input type="hidden" name="actualizar" value="0">
    <a href="social.php"><button id="boton">Cancelar</button></a> <input type="submit" value="Cambiar">
    </form>
    <?php
}else{
    $sql = "SELECT * FROM perfiles WHERE id_user = $id";
    if ($result = mysqli_query($conn, $sql)) {
        while ($row = mysqli_fetch_array($result)) {
            $estado = $row["descripcion"];
        }
}
?>
<form action="actualizarPerfil.php" method="POST">
<textarea name="perfil" required><?php echo $estado; ?></textarea> <br><br>
<input type="hidden" name="actualizar" value="1">
    <a href="social.php"><button id="boton">Cancelar</button></a> <input type="submit" value="Cambiar">
    </form>
<?php
    }
}

    ?>
    </article>
    </section>
    </body>
    </html>