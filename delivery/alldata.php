<?php
include "../Core/connect.php";
include "../Core/functions.php";

$id = filterRequest("id");

$alldata = array();

$ordersToShip = getAllData("orders", "state = 1");
$alldata["orders_to_ship"] = $ordersToShip;

$shippingOrders = getAllData("orders", "state = 2 AND delivery = $id");
$alldata["shipping_orders"] = $shippingOrders;

$archivedOrders = getAllData("orders", "state = 3 AND delivery = $id");
$alldata["archived_orders"] = $archivedOrders;

echo json_encode($alldata);