<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$id = filterRequest('id');
$new_password = filterRequest('new_password');


    $update_data = array(
        "password" => $new_password
    );

    $count = updateData('deliveries', $update_data, "id = $id");
    
        printSuccess();


