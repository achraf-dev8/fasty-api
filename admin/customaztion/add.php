<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$name = filterRequest("name");
$section = filterRequest("section");

$data = array(
    "name" => $name,
); 

$data = insertData($section, $data);

printSuccess();



