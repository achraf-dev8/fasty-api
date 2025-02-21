<?php
include "../Core/connect.php";
include "../Core/functions.php";

$id = filterRequest('id');
$item = filterRequest('item');
$comment = filterRequest("comment");
$rating = createList("rating");


$data = array(
    "id" => $id,
    "comment" => $comment,
    "rating" => $rating,
);

updateData('reviews', $data, "id = $id");

changeItemRating($item);

printSuccess();