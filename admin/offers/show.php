<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$data = array();

$offers = getAllData("offers", null, null, "order DESC");
$data["offers"] = $offers;

echo json_encode($data);
