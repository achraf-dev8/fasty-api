<?php
include "../Core/connect.php";
include "../Core/functions.php";

$id = filterRequest("id");

$alldata = array();

$categories = getAllData("categories");
$alldata["categories"] = $categories;

$items = getAllData("items", "active = 1");
$alldata["items"] = $items;

$extras = getAllData("extras");
$alldata["extras"] = $extras;

$sizes = getAllData("sizes");
$alldata["sizes"] = $sizes; 

$itemSizes = getAllData("item_size");
$alldata["item_size"] = $itemSizes;

$itemExtras = getAllData("item_extra");
$alldata["item_extra"] = $itemExtras;

$itemExtras = getAllData("item_extra");
$alldata["item_extra"] = $itemExtras;

$favorite = getAllData("favorite", "user = $id");
$alldata["favorite"] = $favorite;


$addresses = getAllData("addresses", "user = $id");
$alldata["addresses"] = $addresses;

$reviews = getAllData("reviews", "user = $id");
$alldata["reviews"] = $reviews;

$cart = getAllData("cart", "user = $id AND `order` IS NULL");
$alldata["cart"] = $cart;

$allCartExtras = getAllData("cart_extra");

$cartItemIds = array_map(function($item) {
    return $item['id'];
}, $cart);


$cartExtras = getCartExtras($cartItemIds);

$alldata["cart_extra"] = $cartExtras;

$faq = getAllData("faq");
$alldata["faq"] = $faq;

$offers = getAllData("offers", null, null, "order DESC");
$alldata["offers"] = $offers;


$user = getAllData("users", "id = $id")[0];

$notification = $user['notification'];
$alldata["notification"] = $notification;

$cartBool = $user['cart'];
$alldata["cartBool"] = $cartBool;

echo json_encode($alldata);