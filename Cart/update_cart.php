<?php
include "../Core/connect.php";
include "../Core/functions.php";

$id = filterRequest('id');
$amount = filterRequest('amount');
$user = filterRequest('user');

    $data = array(
        "amount" => $amount
    );

updateData('cart', $data, "id = $id");

$userData = array(
    "cart" => 1,
);

updateData('users', $userData, "id = $user");


printSuccess();



