<?php
include "../Core/connect.php";
include "../Core/functions.php";


$id = filterRequest("id");
$item = filterRequest("item");

deleteData('reviews', "id = $id");

changeItemRating($item);

printSuccess();
?>
