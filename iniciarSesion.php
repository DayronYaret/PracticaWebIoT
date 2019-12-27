<!DOCTYPE html>
<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="stylesIniciarSesion.css" />
    <meta http-equiv="refresh" content="url=iniciarSesion.php">
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
        <aside><a id="navbar" href="iniciarSesion.php">Login</a><a id="navbar" href="registrar.php">Register</a></aside>
    </nav>
    <section>
    <form action="FormularioLogin.php" method="POST">
        Email <input type="email" name="correo" required > <br> <br>
        Contraseña <input type="password" name="clave"  minlength="4" maxlength="8" required> <br> <br>
        <a href="principal.html"><button id="boton">Cancelar</button></a> <input type="submit" value="Iniciar Sesion"></a> 
    </form>
</section>
<footer id="fondo">Footer</footer>
</body>
</html>