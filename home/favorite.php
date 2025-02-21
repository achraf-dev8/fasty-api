<?php
include "../Core/connect.php";
include "../Core/functions.php";

$user = filterRequest("user");
$item = filterRequest("item");
$state = filterRequest("state");



if($state == "add"){
    $data = array(
        "user" => $user,
        "item" => $item
    );
    insertData('favorite', $data);
}else{
    deleteData('favorite', "user = $user AND item = $item");
}

printSuccess();


