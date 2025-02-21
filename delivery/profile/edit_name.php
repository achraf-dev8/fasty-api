<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$id = filterRequest('id');
$name = filterRequest('name');


    $data = array(
        "name" => $name,
    );

updateData('deliveries', $data, "id = $id");

printSuccess();



