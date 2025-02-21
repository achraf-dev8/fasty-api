<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$clickable = filterRequest("clickable");
$directTo = filterRequest("direct_to");
$selectedItem = filterRequest("selected_item");

$image = imageUpload("../../upload/offers", "files");

if($clickable == 0){
    $data = array(
        "clickable" => $clickable,
        "image"=> $image
    );

}else{
    $data = array(
        "clickable" => $clickable,
        $directTo => $selectedItem,
        "image"=> $image
    );
}

    
    insertData('offers', $data);

    printSuccess();
    



