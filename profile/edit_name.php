<?php
include "../Core/connect.php";
include "../Core/functions.php";

$id = filterRequest('id');
$firstName = filterRequest('first_name');
$lastName = filterRequest('last_name');


    $data = array(
        "first_name" => $firstName,
        "last_name" => $lastName,
    );

updateData('users', $data, "id = $id");

printSuccess();



