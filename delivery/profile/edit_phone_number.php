<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$id = filterRequest('id');
$phoneNumber = filterRequest('phone_number');

$stmt = $con->prepare("SELECT * FROM `deliveries` WHERE phone_number = ?");
$stmt->execute(array($phoneNumber));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row){
    printFailure();
    
} else{
    
        $data = array(
            "phone_number" => $phoneNumber,
        );
    
    updateData('deliveries', $data, "id = $id");
    
    printSuccess();
}





