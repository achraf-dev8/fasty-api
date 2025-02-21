<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$data = array();

$deliveries = getAllData("deliveries");
$data["deliveries"] = $deliveries;

echo json_encode($data);
