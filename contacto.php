<!DOCTYPE html>
<head>
    <title>Contacto</title>
    <link rel="stylesheet" href="stylesContacto.css" />
</head>
<body>
<?php
    session_start();
    ?>
    <nav>
        <figure>
            <img id="logo" src="ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg" width="100px" height="50px" >
        </figure>
        <a id="navbar" href="principal.php">MyWebIoT</a><a id="navbar" href="canales.php">Canales</a><a id="navbar" href="ayuda.php">Ayuda</a><a id="elegido" href=>Contacto</a><a id="navbar" href="paypal/products.php">Productos</a>
        <?php

if(isset($_SESSION["user"])){
    $nombre = $_SESSION["user"];
    echo "<a id='navbar' href='social.php'>Social</a>";
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
    <header><h2>Información de contacto</h2></header>
    <article>
        <p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></p>
    </article>
    <footer id="fondo">Footer</footer>
</body>
</html>