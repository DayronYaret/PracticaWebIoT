<!DOCTYPE html>
<head>
    <title>Registrar</title>
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
        <a id="navbar" href="principal.php">MyWebIoT</a><a id="navbar" href="canales.php">Canales</a><a id="navbar" href="ayuda.php">Ayuda</a><a id="navbar" href="contacto.php">Contacto</a>
        <?php

if(isset($_SESSION["user"])){
    $nombre = $_SESSION["user"];
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
    <form action="formularioRegistro.php" method="POST">
        Nombre <input type="text" name="nombre" required> <br> <br>
        Fecha de nacimiento <input type="date" name="fecha" value="2019-10-05" required> <br> <br>
        Email <input type="email" name="correo" required > <br> <br>
        Contraseña <input type="password" name="clave"  minlength="4" maxlength="8" required> <br> <br>
        Repetir contraseña <input type="password" name="clave2"  required> <br> <br>
        <a href="principal.php"><button id="boton">Cancelar</button></a> <input type="submit" value="Registrar"> 
    </form>
</section>
<footer id="fondo">Footer</footer>
</body>
</html>