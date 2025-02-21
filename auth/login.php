<?php
include "../Core/connect.php";
include "../Core/functions.php";

$login = filterRequest('login');
$password = filterRequest('password');
$logintype = filterRequest('logintype');

    $stmt = $con->prepare("SELECT * FROM `users` WHERE $logintype = ?");
    $stmt->execute(array($login));

$count = $stmt->rowCount();

if ($count > 0) {
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
    if ($password == $data['password'] || $logintype == "media_id") {
        if ($data['banned'] == 1) {
            echo json_encode(array("status" => "banned"));
        } else {
            echo json_encode(array("status" => "success", "data" => $data));
        }
    } else {
        printFailure();
    }
} else {
    printFailure();
}
