<?php
include "../Core/connect.php";
include "../Core/functions.php";

$login = filterRequest('login');
$logintype = filterRequest('logintype');

$stmt = $con->prepare("SELECT * FROM `users` WHERE $logintype = ?");
$stmt->execute(array($login));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    if ($row['banned'] == 1) {
        echo json_encode(array("status" => "banned"));
    } else {
        $id = $row['id'];
        $password = $row['password'];
        if($password != "socialMediaPassword"){
            echo json_encode(array("status" => "success", "id" => $id));
        }else{
            echo json_encode(array("status" => "media", "id" => $id));
        }
        
    }
} else {
    printFailure();
}
