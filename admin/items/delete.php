<?php
include "../../Core/connect.php";
include "../../Core/functions.php";


$id = filterRequest("id");
$image = filterRequest("image");

deleteData('items', "id = $id");
deleteFile("../../upload/items", $image);

printSuccess();

