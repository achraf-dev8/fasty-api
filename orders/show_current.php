<?php
include "../Core/connect.php";
include "../Core/functions.php";

$data = array();
$user = filterRequest("user");
$orders = getAllData("orders", "(state = 0 OR state = 1 OR state = 2) AND user = $user");
$data["orders"] = $orders;

echo json_encode($data);
