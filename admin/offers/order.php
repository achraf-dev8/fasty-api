<?php
include "../../Core/connect.php";
include "../../Core/functions.php";


global $con;

$idArray = createList("ids");

$sanitizedIds = array_map('intval', $idArray);

$stmt = $con->prepare("UPDATE offers SET `order` = :order WHERE id = :id");

$orderValue = 0;

foreach ($sanitizedIds as $id) {
    $stmt->execute([
        ':order' => $orderValue,
        ':id' => $id
    ]);  $orderValue += 1; }

    

printSuccess();
?>
