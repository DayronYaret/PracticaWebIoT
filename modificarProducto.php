<?php
session_start();
if(isset($_SESSION["user"])){
    if($_SESSION["user"]=="admin"){
        if(isset($_GET["producto"])){
            $producto = $_GET["producto"];
            // initializing database connection parameters
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
            $sql = "SELECT * FROM products WHERE name = '$producto'";
                if ($result = mysqli_query($conn, $sql)) {
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row["id"];
                        $descripcion = $row["description"];
                        $precio = $row["price"];
                        $moneda = $row["currency"];
                        $stock = $row["stock"];
                    }
                }
                ?>
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
<nav>

    <figure>
        <img id="logo" src="ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg" width="100px" height="50px" >
    </figure>
    <a id="navbar" href="principal.php">MyWebIoT</a><a id="navbar" href="canales.php">Canales</a><a id="navbar" href="ayuda.php">Ayuda</a><a id="navbar" href="contacto.php">Contacto</a><a id='navbar' href="social.php">Social</a>

    </nav>
    <section>
        <article>
            <form action="actualizarProducto.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="text" name="nombre" value="<?php echo $producto; ?>" required>  <br> <br>
                <textarea name="descripcion" required><?php echo $descripcion; ?></textarea> <br><br>
                <input type="number" name="precio" step="0.1" value="<?php echo $precio; ?>" required> <br> <br>
                <input type="number" name="stock" step="1" value="<?php echo $stock; ?>" required> <br> <br>
                <select name="moneda">
                    <option value="euros">euros</option>
                    <option value="dolares">dolares</option>
                    <option value="libras">libras</option>
                </select> <br> <br>
                <a href="social.php"><button id="boton">Cancelar</button></a> <input type="submit" value="Cambiar">
            </form>
        </article>


        <?php
            }
        }else{
            echo "no deberias estar aqui";
        }

    }else{
        header("Location: principal.php");
    }
}else{
    header("Location: principal.php");
}



?>