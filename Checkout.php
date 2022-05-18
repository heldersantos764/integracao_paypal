<?php
require_once "Init.php";

$metodo = $_REQUEST['metodo'];


if($metodo == 'order'){
    $paypal->createOrder();
}else if($metodo == 'capturePayment'){
    $orderId = $_POST['orderId'];
    $paypal->capturePayment($orderId);
}