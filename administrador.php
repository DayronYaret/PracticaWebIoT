<!DOCTYPE html>
<head>
    <title>Administrador</title>
    <link rel="stylesheet" href="stylesAdministrador.css" />
</head>
<body>
<?php
session_start();
if(isset($_SESSION["user"])){
    $usuario = $_SESSION["user"];
    if($usuario  =="admin"){
        //eres admin
        echo "<a href='meterProducto.php'><button id='primero'>Meter productos</button></a><a href='verProducto.php'><button id='segundo'>Ver productos</button></a><a href='verOrdenes.php'><button id='tercero'>Ver ordenes</button></a><a href='verTransacciones.php'><button id='cuarto'>Ver transacciones</button></a><a href='logout.php'><button id='quinto'>LogOut</button></a>";
    }else{
        header('Location: principal.php');
        exit;
    }

}else {
    echo "desastre";
}
?>
</body>
</html>
