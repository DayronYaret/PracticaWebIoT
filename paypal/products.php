<?php
require __DIR__ . '/lib/PayPalDemo.php';
$app = new PayPalDemo();
// fetch all products
$cart = (!empty($_SESSION['cart']) ? $_SESSION['cart'] : []);
$products = $app->getAllProducts();
if(isset($_POST["clean"])){
    unset($_SESSION["cart"]);
    header("location:products.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practica</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/stylesPayPal.css">


</head>
<body>

<?php require 'navigation.php'; ?>
<aside id="carrito">
    <h3>My shopping cart</h3>
    <?php if (count($cart)>0){
    if (isset($_SESSION["cart"])) { ?>

    <table class="table table-striped table-bordered table-responsive">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
        </tr>
        <?php

        $sql = "SELECT * FROM products WHERE id IN (";
        foreach ($_SESSION['cart'] as $id => $value) {
            $sql .= $id . ",";
        }
        $sql = substr($sql, 0, -1) . ") ORDER BY name ASC";
        if ($query = mysqli_query($con, $sql)) {
            while ($row = mysqli_fetch_array($query)) {
                $producto = $row["name"];
                $cantidad = $_SESSION['cart'][$row['id']]['quantity'];
                echo "<tr>";
                echo "<td>$producto</td>";
                echo "<td>$cantidad</td>";
                echo "</tr>";
            }
        }
        }
        } else {
            echo "<p>El carro esta vacío</p>";
        }
        ?>
    </table>
    <?php if(count($cart)>0){?>
        <form method="post">
            <input type="submit" class="btn btn-primary" value="Vaciar el carro" name="clean">
        </form>
    <?php } ?>
    <a href="shopping-cart.php">Go to Shopping cart</a>
</aside>

<div style="margin-right: 300px;margin-left: 200px;">

    <div class="row">
        <div class="col-md-12">
            <h2>
                Products
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <?php foreach ($products as $product) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <?php echo $product['name'] ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p>
                            <?php echo $product['description'] ?>
                        </p>
                        <p>
                            Stock: <?php echo $product['stock'] ?> unidades restantes.
                        </p>

                        <h4>Price: <?php echo $product['price'] . ' €' ?></h4>


                        <div class="form-group">
                            <form action="shopping-cart.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $product['id'] ?>">
                                <?php if ($product['stock'] == 0) { ?>
                                    <input name="btnAddProduct" type="submit" class="btn btn-success"
                                           value="Add to Shopping Cart" title="No queda stock" disabled>
                                <?php } else { ?>
                                    <input name="btnAddProduct" type="submit" class="btn btn-success"
                                           value="Add to Shopping Cart">
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>

    </div>
</div>

</body>
</html>

