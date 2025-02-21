<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$id = filterRequest('id');


    $data = array(
        "banned" => 1,
    );

updateData('users', $data, "id = $id");

printSuccess();



