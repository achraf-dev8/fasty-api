<?php
include "../Core/connect.php";
include "../Core/functions.php";

$id = filterRequest('id');
$new_password = filterRequest('new_password');

// Hash the new password

$update_data = array(
    "password" => $new_password// Store the hashed password
);

updateData('users', $update_data, "id = $id");

    printSuccess();

