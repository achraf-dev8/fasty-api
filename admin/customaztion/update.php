<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$id = filterRequest("id");
$name = filterRequest("name");
$section = filterRequest("section");


    $data = array(
        "name" => $name
    );

updateData($section, $data, "id = $id");

printSuccess();



