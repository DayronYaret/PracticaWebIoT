<?php

require __DIR__ . '/config/app.php';
require __DIR__ . '/config/paypal.php';

class PayPalDemo{
    protected $db;

    function __construct()
    {
        $this->db = DB();
    }

    public function getAllProducts()
    {
        $data = [];
        $query = "SELECT * FROM products";
        if (!$result = mysqli_query($this->db, $query)) {
            exit(mysqli_error($this->db));
        }
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function get_product_details($id)
    {
        $data = [];
        $query = "SELECT * FROM `products` WHERE `id` = '$id'";
        if (!$result = mysqli_query($this->db, $query)) {
            exit(mysqli_error($this->db));
        }
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data = $row;
            }
        }
        return $data;
    }

    public function add_new_product($id)
    {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
            header('location:products.php');
        } else {
            $sql_s = "SELECT * FROM products 
                WHERE id={$id}";
            $query_s = mysqli_query($this->db, $sql_s);
            if (mysqli_num_rows($query_s) != 0) {
                $row_s = mysqli_fetch_array($query_s);
                $_SESSION['cart'][$row_s['id']] = array(
                    "product_id"=>$row_s['id'],
                    "quantity" => 1,
                    "price" => $row_s['price'],
                    "stock" => $row_s['stock']
                );
                header('location:products.php');
            }
        }
    }
    public
    function _get_sum()
    {
        $price = 0;
        if (count($_SESSION['cart']) > 0) {
            foreach ($_SESSION['cart'] as $product) {
                $price += (float)$product['price'] * $product['quantity'];
            }
        }
        return round($price, 2);
    }


    public function getUserDetails($email)
    {
        $data = [];
        $query = "SELECT * FROM `users` WHERE `email` = '$email'";
        if (!$result = mysqli_query($this->db, $query)) {
            exit(mysqli_error($this->db));
        }
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data = $row;
            }
        }

        return $data;
    }

    public function paypal_check_payment($payment_id, $payer_id, $token, $user_id)
    {

        // request http using curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, PayPal_BASE_URL . 'oauth2/token');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERPWD, PayPal_CLIENT_ID . ":" . PayPal_SECRET);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $result = curl_exec($ch);
        $accessToken = NULL;


        if (empty($result)) {
            return FALSE;
        } else {

            // get Order details along with the status and update order
            $json = json_decode($result);
            $accessToken = $json->access_token;
            $curl = curl_init(PayPal_BASE_URL . 'payments/payment/' . $payment_id);
            curl_setopt($curl, CURLOPT_POST, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_HEADER, FALSE);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $accessToken,
                'Accept: application/json',
                'Content-Type: application/xml'
            ));
            $response = curl_exec($curl);
            $result = json_decode($response);
            $state = $result->state;
            $total = $result->transactions[0]->amount->total;
            curl_close($ch);
            curl_close($curl);

            if ($state == 'approved') {
                $this->add_new_order($user_id, $state, $total,$payment_id,$payer_id);

                return TRUE;

            } else {

                return FALSE;
            }

        }

    }

    public
    function add_new_order($user_id, $state, $total,$payment_id,$payer_id)
    {
        $query = "INSERT INTO orders(cliente_id, total, estado, fecha) VALUES ('$user_id', '$total','$state' ,CURRENT_TIMESTAMP )";
        if (!$result = mysqli_query($this->db, $query)) {
            exit(mysqli_error($this->db));
        }
        $order_id = mysqli_insert_id($this->db);
        $this->_add_order_items($order_id);
        $this->add_factura($order_id, $user_id, $state, $total,$payment_id,$payer_id);
    }

    public
    function add_factura($order_id, $cliente_id, $state, $total,$payment_id,$payer_id)
    {
        $query = "INSERT INTO factura(order_id,cliente_id,estado,total,moneda,fecha,id_transaccion,payer_id) VALUES ('$order_id', '$cliente_id','$state','$total','USD' ,CURRENT_TIMESTAMP ,'$payment_id','$payer_id')";
        if (!$result = mysqli_query($this->db, $query)) {
            exit(mysqli_error($this->db));
        }
    }

    public
    function _add_order_items($order_id)
    {
        $cart = $_SESSION['cart'];
        if (count($cart) > 0) {
            foreach ($cart as $product) {
                $query = "INSERT INTO order_items(product_id, order_id, quantity) VALUES ('{$product['product_id']}', '$order_id','{$product['quantity']}')";
                if (!$result = mysqli_query($this->db, $query)) {
                    exit(mysqli_error($this->db));
                }
                $nuevoStock = $product['stock']-$product['quantity'];
                $product_id = $product['product_id'];
                $query = "UPDATE products SET stock = $nuevoStock where id=$product_id ";
                if (!$result = mysqli_query($this->db, $query)) {
                    exit(mysqli_error($this->db));
                }
            }
        }
        $_SESSION['cart'] = [];
    }

    public function getOrders($user_id)
    {
        $data = [];

        $query = "SELECT * FROM orders WHERE cliente_id = '$user_id' ORDER BY id DESC";
        if (!$result = mysqli_query($this->db, $query)) {
            exit(mysqli_error($this->db));
        }
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function getOrderItems($order_id)
    {
        $data = [];
        $query = "SELECT P.id, P.name, P.price, P.currency, OI.quantity FROM order_items OI
  LEFT JOIN products P
  ON P.id = OI.product_id
    WHERE OI.order_id = '$order_id'";
        if (!$result = mysqli_query($this->db, $query)) {
            exit(mysqli_error($this->db));
        }
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }

        return $data;
    }
}


?>