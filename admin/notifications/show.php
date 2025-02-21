<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$data = array();

$notifications = getAllData("notifications", "user is NULL");
$data["notifications"] = $notifications;

echo json_encode($data);
