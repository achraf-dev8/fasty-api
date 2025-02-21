<?php
include "../Core/connect.php";
include "../Core/functions.php";

$data = array();
$user = filterRequest("user");
$orders = getAllData("orders", "(state = 3 OR state = -1) AND user = $user");
$data["orders"] = $orders;

echo json_encode($data);
