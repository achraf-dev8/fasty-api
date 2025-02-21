<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$id = filterRequest('id');
$delivery = filterRequest('delivery');

$stmt = $con->prepare("SELECT state FROM orders WHERE id = ?");
$stmt->execute([$id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if ($order['state'] != 1) {

    printFailure();

}else{

    $stmt = $con->prepare("SELECT name FROM deliveries WHERE id = ?");
    $stmt->execute([$delivery]);
    $deliveryData = $stmt->fetch(PDO::FETCH_ASSOC);
    $deliveryName = $deliveryData['name'];

    $data = array(
        "state" => 2,
        "delivery" => $delivery,
        "delivery_name" => $deliveryName
    );

    updateData('orders', $data, "id = $id");

printSuccess();

}




