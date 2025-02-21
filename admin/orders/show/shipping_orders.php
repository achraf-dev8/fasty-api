<?php
include "../../../Core/connect.php";
include "../../../Core/functions.php";

$data = array();

$orders = getAllData("orders", "state = 2");
$data["orders"] = $orders;

echo json_encode($data);
