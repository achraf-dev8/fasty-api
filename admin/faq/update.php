<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$id = filterRequest("id");
$question = filterRequest("question");
$answer = filterRequest("answer");

$data =array("question" => $question, "answer" => $answer);

updateData("faq", $data, "id = $id");

printSuccess();



    



