<?php
include "../Core/connect.php";
include "../Core/functions.php";

$user = filterRequest("user");

$userData = array(
    "cart" => 0,
);

updateData('users', $userData, "id = $user");

printSuccess();
    



