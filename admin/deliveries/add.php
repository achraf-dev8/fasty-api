<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$name = filterRequest("name");
$phoneNumber = filterRequest("phone_number");
$password = filterRequest("password");

$stmt = $con->prepare("SELECT * FROM `deliveries` WHERE phone_number = ?");
$stmt->execute(array($phoneNumber));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row){
    printFailure();
} else{
    $data = array(
        "name" => $name,
        "phone_number"=> $phoneNumber,
        "password" => $password
    );
    
    insertData('deliveries', $data);

    printSuccess();
}



    



