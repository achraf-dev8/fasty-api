<?php
include "../Core/connect.php";
include "../Core/functions.php";

$login = filterRequest('login');
$logintype = filterRequest('logintype');


if ($logintype == "phone_number") {
    $stmt = $con->prepare("SELECT id FROM users WHERE phone_number = ?");
} else {
    $stmt = $con->prepare("SELECT id FROM users WHERE email = ?");
}


$stmt->execute(array($login));


$row = $stmt->fetch(PDO::FETCH_ASSOC);


if ($row) {
    $id = $row['id'];
    echo json_encode(array("status" => "success", "id" => $id));
} else {
    printFailure();
}
?>
