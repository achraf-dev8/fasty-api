<?php
include "../Core/connect.php";
include "../Core/functions.php";

$item = filterRequest("item");
$reviews = array();

$query = 'users u JOIN reviews r ON r.user = u.id';
$where = 'r.item = ?';
$values = [$item];


$reviewsTable = getAllData($query, $where, $values);


foreach ($reviewsTable as &$review) {
    $review['name'] = $review['first_name'] . ' ' . $review['last_name'];
    unset($review['first_name'], $review['last_name']);
}

$reviews["reviews"] = $reviewsTable;

echo json_encode($reviews);
?>
