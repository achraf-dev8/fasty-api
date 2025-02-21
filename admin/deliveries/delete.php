<?php
include "../../Core/connect.php";
include "../../Core/functions.php";


$id = filterRequest("id");

deleteData('deliveries', "id = $id");

printSuccess();

