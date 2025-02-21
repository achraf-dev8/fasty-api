<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$id = filterRequest('id');
$address = filterRequest('address');


    $data = array(
        "name" => $address
    );

updateData('addresses', $data, "id = $id");

printSuccess();



