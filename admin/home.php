<?php
include "../Core/connect.php";
include "../Core/functions.php";

$data = array();

$categories = getAllData("categories");
$data["categories"] = $categories;

$sizes = getAllData("sizes");
$data["sizes"] = $sizes;

$extras = getAllData("extras");
$data["extras"] = $extras;

$items = getAllData("items");
$data["items"] = $items;

$itemSizes = getAllData("item_size");
$data["item_size"] = $itemSizes;

$itemExtras = getAllData("item_extra");
$data["item_extra"] = $itemExtras;

$offers = getAllData("offers", null, null, "order DESC");
$data["offers"] = $offers;

echo json_encode($data);
