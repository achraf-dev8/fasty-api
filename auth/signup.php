<?php
include "../Core/connect.php";
include "../Core/functions.php";

$first_name = filterRequest('first_name');
$last_name = filterRequest('last_name');
$address = filterRequest('address');
$phone_number = filterRequest('phone_number');
$email = filterRequest('email');
$password = filterRequest('password');
$mediaId = filterRequest('media_id');

// Hash the password

$addressData = array(
    "name" => $address,
); 

$addressId = insertData("addresses", $addressData);

$userData = array(
    "first_name" => $first_name,
    "last_name" => $last_name,
    "address" => $addressId,
    "phone_number" => $phone_number,
    "email" => $email,
    "password" => $password, 
    "media_id" => $mediaId
);

$userId = insertData("users", $userData);

$addressData = array(
    "user" => $userId,
); 
updateData("addresses", $addressData, "id = $addressId");

insertNotification("Welcome", "Your account has been created!", $userId);

echo json_encode(array("status" => "success", "data" => $userData));
