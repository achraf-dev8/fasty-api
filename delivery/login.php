<?php
include "../Core/connect.php";
include "../Core/functions.php";

$phoneNumber = filterRequest('phone_number');
$password = filterRequest('password');

$stmt = $con ->prepare("SELECT * FROM `deliveries` WHERE `password` = ? AND `phone_number` = ? ");
    
$stmt->execute(array($password, $phoneNumber));

$count = $stmt -> rowCount(); 

if($count > 0){
$data = $stmt -> fetch(PDO::FETCH_ASSOC);
echo json_encode(array("status" => "success", "data" => $data));
}else{
    printFailure();
}