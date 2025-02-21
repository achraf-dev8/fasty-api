<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$user = filterRequest("user");
$address = filterRequest("address");

$addressData = array(
    "user" => $user,
    "name" => $address,
); 

$addressId = insertData("addresses", $addressData);

echo json_encode(array("id" => $addressId));
    



