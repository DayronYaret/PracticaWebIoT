<?php

require __DIR__ . '/lib/PayPalDemo.php';


if (empty($_SESSION['email'])) {
    header('Location: ../principal.php');
    exit;
}

if (!empty($_GET['payment_id']) && !empty($_GET['payer_id']) && !empty($_GET['token'])) {

    $app = new PayPalDemo();

    $user = $app->getUserDetails($_SESSION['email']);

    $payment_id = $_GET['payment_id'];
    $payer_id = $_GET['payer_id'];
    $token = $_GET['token'];
    if ($app->paypal_check_payment($payment_id, $payer_id, $token, $user["id"])) {
        header("Location: my-orders.php?status=true");
        exit;
    } else {
        header('Location: shopping-cart.php?status=false');
        exit;
    }

} else {
    header('Location: products.php');
    exit;
}

?>