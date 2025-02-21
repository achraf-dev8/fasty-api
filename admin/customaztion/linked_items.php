<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$order = filterRequest("order");

$data = array();

$cart = getAllData("cart", "`order` = $order");
$data["cart"] = $cart;

echo json_encode($alldata);
    



