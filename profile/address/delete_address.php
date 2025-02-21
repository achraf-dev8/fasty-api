<?php
include "../../Core/connect.php";
include "../../Core/functions.php";


$id = filterRequest("id");

deleteData('addresses', "id = $id");

printSuccess();
?>
