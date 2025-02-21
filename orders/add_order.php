<?php
include "../Core/connect.php";
include "../Core/functions.php";

$user = filterRequest("user");
$address = filterRequest("address");
$deliveryPrice = filterRequest("delivery_price");
$deliveryTime = filterRequest("delivery_time");
$price = filterRequest("price");
$payement_method = filterRequest("payement_method");
$cart = filterRequest("cart"); // List of item IDs
$sizes = filterRequest("sizes"); 
$prices = filterRequest("prices");
$images = filterRequest("images");
$names = filterRequest("names");

// Prepare the main order data
$data = array(
    "user" => $user,
    "address" => $address,
    "delivery_price" => $deliveryPrice,
    "delivery_time" => $deliveryTime, 
    "price" => $price,
    "payement_method" => $payement_method
);

// Insert order data and get the order ID
$id = insertData('orders', $data);
$i = 0;
foreach ($cart as $cartId) {
        $cartData = array(
            "order" => $id,
            "name" => $names[$i],
            "price" => $prices[$i],
            "image" => $images[$i],
            "size" => $sizes[$i]
        );
        updateData("cart", $cartData, "id = $cartId");
        $cartExtras = getCartExtras([$cartId]);
        foreach ($cartExtras as $cartExtra) {
            $extraId = $cartExtra['extra']; // Assuming extra_id is the column name
    
            // Step 3: Get the extra details
            $extras = getAllData('extras', "id = $extraId");

            if (!empty($extras) && isset($extras[0]['name'])) {
                $extraName = $extras[0]['name'];
    
                // Prepare data for updating cart_extra
                $cartExtraData = array(
                    "extra_name" => $extraName // Assuming extra_name is the field to update
                );
    
                // Update the cart_extra
                updateData("cart_extra", $cartExtraData, "id = " . $cartExtra['id']);
            }
        }

        $i = $i + 1;
}

// Send notifications
insertNotification("Success", "Order #$id is pending approval", $user);
sendFCM("Success", "Your order is pending approval", "user$user", "../fasty_notification.json");

printSuccess();
?>
