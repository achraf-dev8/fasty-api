<?php
include "../../Core/connect.php";
include "../../Core/functions.php";


$name = filterRequest("name");
$description = filterRequest("description");
$category = filterRequest("category");
$active = filterRequest("active");
$sizes = createList("sizes");
$price = createList("price");
$old_price = createList("old_price");
$main = createList("main");
$extras = createList("extras");
$image = imageUpload("../../upload/items", "files");
$data = array(
    "name" => $name,
    "image" => $image,
    "category" => $category,
    "description" => $description,
    "active" => $active,
);
$itemId = insertData("items", $data); 

$i = 0;
if(sizeof($sizes) == 0){
    $sizeData = array(
        "item" => $itemId,
        "price" => $price[$i],
        "old_price" => $old_price[$i],
        "main" => $main[$i]
    );
    insertData("item_size", $sizeData);
}else{
    foreach ($sizes as $sizeId) {
        $sizeData = array(
            "item" => $itemId,
            "size" => $sizeId,
            "price" => $price[$i],
            "old_price" => $old_price[$i],
            "main" => $main[$i]
        );
        insertData("item_size", $sizeData);
        $i = $i + 1;
    }
}


foreach ($extras as $extraId) {
    $extraData = array(
        "item" => $itemId,
        "extra" => $extraId
    );
    insertData("item_extra", $extraData);
}


printSuccess();