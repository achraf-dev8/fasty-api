<?php
include "../Core/connect.php";
include "../Core/functions.php";

$order = filterRequest("order");

$alldata = array();

$cart = getAllData("cart", "`order` = $order");
$alldata["cart"] = $cart;

$allCartExtras = getAllData("cart_extra");

$cartIds = array_map(function($item) {
    return $item['id'];
}, $cart);

$cartExtras = getCartExtras($cartIds);

$alldata["cart_extra"] = $cartExtras;


    echo json_encode($alldata);
    



