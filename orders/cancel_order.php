<?php
include "../Core/connect.php";
include "../Core/functions.php";


$id = filterRequest("id");

deleteData('orders', "id = $id");

printSuccess();

