<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$id = filterRequest('id');
$data = array();

$orders = getAllData("orders", "user = $id");
$data["orders"] = $orders;

echo json_encode($data);
