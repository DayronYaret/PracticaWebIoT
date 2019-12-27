<!DOCTYPE html>
<head>
    <title>Registrar</title>
    <link rel="stylesheet" href="stylesRegistrar.css" />
</head>
<body>
<?php
session_start();
?>

<section>
    <form action="formularioProducto.php" method="POST">
        Nombre <input type="text" name="nombre" required> <br> <br>
        Descripcion <textarea name ="descripcion" required></textarea> <br> <br>
        Precio <input type="number" name="precio" step="0.1" required> <br> <br>
        Moneda <select name="moneda">
            <option value="euros">euros</option>
            <option value="dolares">dolares</option>
            <option value="libras">libras</option>
        </select> <br> <br>
        <a href="principal.php"><button id="boton">Cancelar</button></a> <input type="submit" value="Registrar">
    </form>
</section>
<footer id="fondo">Footer</footer>
</body>
</html>