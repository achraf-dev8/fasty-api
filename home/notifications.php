<?php
include "../Core/connect.php";
include "../Core/functions.php";

$data = array();
$user = filterRequest("user");
$notifications = getAllData("notifications", "user = $user");
$data["notifications"] = $notifications;

$userData = array(
    "notification" => 0,
);

updateData('users', $userData, "id = $user");

echo json_encode($data);
