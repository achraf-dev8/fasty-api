<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$question = filterRequest("question");
$answer = filterRequest("answer");

$data =array("question" => $question, "answer" => $answer);

insertData("faq", $data);
printSuccess();



    



