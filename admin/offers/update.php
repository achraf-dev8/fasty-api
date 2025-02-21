<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$id = filterRequest("id");
$clickable = filterRequest("clickable");
$directTo = filterRequest("direct_to");
$selectedItem = filterRequest("selected_item");

$oldImage = filterRequest("old_image");

$res = imageUpload("../../upload/offers", "files");

if($res == "empty"){
    $data = array(
        "clickable" => $clickable,
        $directTo => $selectedItem,
    );
}else{
    deleteFile("../../upload", $oldImage);
    $data = array(
        "clickable" => $clickable,
        $directTo => $selectedItem,
        "image"=> $res
    );
}
    
    updateData('offers', $data, "id = $id");

    printSuccess();
    



