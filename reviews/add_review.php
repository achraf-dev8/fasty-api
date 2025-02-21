<?php
include "../Core/connect.php";
include "../Core/functions.php";

$item = filterRequest("item");
$user = filterRequest("user");
$comment = filterRequest("comment");
$rating = createList("rating");

    $data = array(
        "item" => $item,
        "user" => $user,
        "comment" => $comment,
        "rating" => $rating,
    );

    $reviewId = insertData('reviews', $data);

    changeItemRating($item);

    echo json_encode(array("id" => $reviewId));
    



