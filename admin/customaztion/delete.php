<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$id = filterRequest("id");
$section = filterRequest("section");

deleteData($section, "id = $id");

printSuccess();
