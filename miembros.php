<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Miembros</title>
<link rel="stylesheet" href="stylesPrincipal.css" />
</head>
<body>
<?php
    session_start();
    ?>
    <nav>
        <figure>
            <img id="logo" src="ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg" width="100px" height="50px" >
        </figure>
        <a id="navbar" href=>MyWebIoT</a><a id="navbar" href="canales.php">Canales</a><a id="navbar" href="ayuda.php">Ayuda</a><a id="navbar" href="contacto.php">Contacto</a><a id="navbar" href="paypal/products.php">Productos</a><a id='navbar' href='social.php'>Social</a>
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
<p>Este es el listado de todos los usuarios que hay registrados</p>
<?php

$idUsuarioActual = $_SESSION["id"];
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

    if(isset($_GET['add'])){
        $usuarioAmigo = $_GET['add'];
        $sql3 = "SELECT * FROM users WHERE nombre='$usuarioAmigo'";
        if($result3 = mysqli_query($conn, $sql3)){
            if($row3 = mysqli_fetch_array($result3)){
                $idAmigo = $row3["id"];
            }
        }
        $sql4 = "INSERT INTO amigos (id_user, id_amigo) VALUES ('$idUsuarioActual', '$idAmigo')";
        if (mysqli_query($conn, $sql4)) {
            header('Location: miembros.php');
            exit;
            echo "registro completado";
        } else {
            echo "fallo al registar";
        }
        
    }
    elseif(isset($_GET["remove"])){
        $usuarioAmigo = $_GET["remove"];
        
        $sql3 = "SELECT * FROM users WHERE nombre='$usuarioAmigo'";
        if($result3 = mysqli_query($conn, $sql3)){
            if($row3 = mysqli_fetch_array($result3)){
                $idAmigo = $row3["id"];
            }
        }
        echo $idUsuarioActual;
        echo $idAmigo;
        $sql4 = "DELETE FROM amigos WHERE id_user='$idUsuarioActual' AND id_amigo='$idAmigo'";
        $result4 = mysqli_query($conn, $sql4);
        header('Location: miembros.php');
    }


$sql = "SELECT * FROM users";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $nombreUsuario = $row["nombre"];
        $idUsuarioASeguir = $row["id"];
        if($nombreUsuario == "admin" || $nombreUsuario == $_SESSION["user"])continue;
        echo "<p> $nombreUsuario"; 
        $follow = "seguir";
        $sql1 = "SELECT * FROM amigos WHERE id_user=$idUsuarioActual AND id_amigo = $idUsuarioASeguir";
        if($result1 = mysqli_query($conn, $sql1)){
            $t1 = $result1->num_rows;
        }
        $sql1 = "SELECT* FROM amigos WHERE id_user=$idUsuarioASeguir AND id_amigo = $idUsuarioActual";
        if($result1 = mysqli_query($conn, $sql1)){
            $t2 = $result1->num_rows;
        }
        if(($t1+$t2)>1) echo " sois amigos ";
        elseif($t1) echo " estas siguiendolo ";
        elseif($t2){
            echo " te está siguiendo ";
            $follow = "recip";
        }
        if(!$t1) echo "<a href ='miembros.php?add=$nombreUsuario'> $follow </a> </p>";
        else echo "<a href ='miembros.php?remove=$nombreUsuario'> dejar de seguir </a> </p>";
        }
        }
    }


?>
</body>
</html>

