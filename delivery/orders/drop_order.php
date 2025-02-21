<?php
include "../../Core/connect.php";
include "../../Core/functions.php";


$id = filterRequest('id');

$stmt = $con->prepare("SELECT delivery FROM orders WHERE id = ?");
$stmt->execute([$id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);
$delivery_id = $order['delivery'];

$data = array(
    "state" => 1
);

updateData('orders', $data, "id = $id");


$stmt = $con->prepare("UPDATE deliveries SET dropped = dropped + 1 WHERE id = ?");

$stmt->execute([$delivery_id]);


printSuccess();
