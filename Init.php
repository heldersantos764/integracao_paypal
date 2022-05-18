<?php

require_once "Paypal.php";

$paypal = new Paypal(
    "https://api-m.sandbox.paypal.com", 
    'AXk-3Dm32uyY3BsZ5lDivqK7tp_Jb5AzeIYudDyx5G937kiWsVbCyCUViHt0UPitblL9k_C8ZSZt6-k4', 
    'EBVxeshjo1XaohWw7wp3hWDP5CCQNZnXdZmh39dlPhVxfZvLDBAMKTYQzmldKdh1xe_AxspYhWJJPwQl');

//var_dump($paypal->createOrder());
//var_dump($paypal->capturePayment('8UE83488S6996135A'));