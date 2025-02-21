<?php
include "../../Core/connect.php";
include "../../Core/functions.php";


$user = filterRequest("user");
$id = filterRequest("id");

$data = array(
    "address" => $id
);


updateData("users", $data, "id = $user");

printSuccess();

