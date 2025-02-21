<?php
include "../Core/connect.php";
include "../Core/functions.php";

$id = filterRequest('id');
$logintype = filterRequest('logintype');
$login = filterRequest('login');


    $data = array(
        $logintype => $login,
    );

updateData('users', $data, "id = $id");

printSuccess();



