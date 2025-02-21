<?php
include "../Core/connect.php";
include "../Core/functions.php";

$user = filterRequest("user");
$itemSize = filterRequest("item_size");
$amount = filterRequest("amount");
$extraList = createList("extras");

    $data = array(
        "user" => $user,
        "item_size" => $itemSize,
        "amount" => $amount,
    );
    
    $cartId = insertData('cart', $data);

    foreach ($extraList as $extraObj) {

        if (is_array($extraObj) || is_object($extraObj)) {
            $extra = json_encode($extraObj);
        } else {
            $extra = strval($extraObj);
        }
        $extraData = array(
            "cart" => $cartId,
            "extra" => $extra
        );
    
        insertData('cart_extra', $extraData);
    }

    $userData = array(
        "cart" => 1,
    );
    
    updateData('users', $userData, "id = $user");

    echo json_encode(array("id" => $cartId));
    



