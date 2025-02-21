<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$id = filterRequest('id');
$user = filterRequest('user');


    $data = array(
        "state" => 1,
    );
    
updateData('orders', $data, "id = $id");
insertNotification("Approved", "Order #$id has been approved", $user);
sendFCM("Approved", "Your order has been approved!", "user$user", "../../fasty_notification.json");


printSuccess();


