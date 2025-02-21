<?php
include "../../Core/connect.php";
include "../../Core/functions.php";


$reviews = array();

$query = 'users u JOIN reviews r ON r.user = u.id';


$reviewsTable = getAllData($query, null);


foreach ($reviewsTable as &$review) {
    $review['name'] = $review['first_name'] . ' ' . $review['last_name'];
    unset($review['first_name'], $review['last_name']);
}

$reviews["reviews"] = $reviewsTable;

echo json_encode($reviews);
