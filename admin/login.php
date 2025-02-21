<?php
include "../Core/connect.php";
include "../Core/functions.php";

$username = filterRequest('username');
$password = filterRequest('password');

$stmt = $con ->prepare("SELECT * FROM `admin` WHERE `password` = ? AND `username` = ? ");
    
$stmt->execute(array($password, $username));

$count = $stmt -> rowCount(); 

if($count > 0){
    $data = $stmt -> fetch(PDO::FETCH_ASSOC);
echo json_encode(array("status" => "success", "data" => $data));
}else{
    printFailure();
}