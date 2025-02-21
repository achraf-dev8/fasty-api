<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$id = filterRequest('id');
$user = filterRequest('user');
$msg = filterRequest('msg');


    $data = array(
        "state" => -1,
        "disapprove_msg" => $msg
    );
    
updateData('orders', $data, "id = $id");
insertNotification("Disapproved", "Order #$id has been disapproved", $user);
sendFCM("Unfortunately", "Your order has been disapproved!", "user$user", "../../fasty_notification.json");

printSuccess();


