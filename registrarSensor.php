<!DOCTYPE html>
<head>
    <title>Registrar Sensor</title>
    <link rel="stylesheet" href="stylesRegistrarSensor.css" />
    <body>
    <?php
    session_start();
    ?>
        <nav>
            <figure>
                <img id="logo" src="ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg" width="100px" height="50px" >
            </figure>
            <a id="navbar" href="principal.php">MyWebIoT</a><a id="navbar" href="canales.php">Canales</a><a id="navbar" href="ayuda.php">Ayuda</a><a id="navbar" href="contacto.php">Contacto</a>
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
        <section>
        <form action="formularioCanales.php" method="POST">
            Nombre del canal <input type="text" name="nombre" required> <br> <br>
            Descripcion <textarea name="descripcion" required></textarea> <br> <br>
            Longitud <input type="number" name="longitud" required > <br> <br>
            Latitud <input type="number" name="latitud" required> <br> <br>
            Tipo de sensor <input type="text" name="tipo" required> <br> <br>
            <a href="misCanales.php"><button id="boton">Cancelar</button></a> <input type="submit" value="Registrar"> 
        </form>
    </section>
    <footer id="fondo">Footer</footer>
    </body>
</head>
</html>