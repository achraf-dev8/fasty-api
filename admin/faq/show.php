<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$data = array();

$faq = getAllData("faq");
$data["faq"] = $faq;

echo json_encode($data);
