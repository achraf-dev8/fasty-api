<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$title = filterRequest('title');
$body = filterRequest("body");


insertNotification($title, $body);
sendFCM($title, $body, "users", "../../fasty_notification.json");


printSuccess();
