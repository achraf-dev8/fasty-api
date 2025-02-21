<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$data = array();

$users = getAllData("users", "banned = 0");
$data["users"] = $users; 

echo json_encode($data);
