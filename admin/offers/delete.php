<?php
include "../../Core/connect.php";
include "../../Core/functions.php";


$id = filterRequest("id");
$image = filterRequest("image");


deleteData('offers', "id = $id");
deleteFile("../../upload/offers", $image);

printSuccess();
?>
