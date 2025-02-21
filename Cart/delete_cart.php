<?php
include "../Core/connect.php";
include "../Core/functions.php";

$idArray = createList("ids");
if($idArray != []){
    $sanitizedIds = array_map('intval', $idArray);

    $idList = implode(',', $sanitizedIds);
    
    deleteData('cart', "id IN ($idList)");
}
printSuccess();
?>
