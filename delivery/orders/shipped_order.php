<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$id = filterRequest('id');
$user = filterRequest('user');


    $data = array(
        "state" => 3,
    );

    updateData('orders', $data, "id = $id");
    insertNotification("Done", "Order #$id has been delivered", $user);
    sendFCM("Done", "Your order has been delivered!", "user$user", "../../fasty_notification.json");

printSuccess();


