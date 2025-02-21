<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

define("MB", 1048576);


require 'php-jwt-main/src/JWT.php';
require 'php-jwt-main/src/Key.php';


function returnFireBaseTkn($file){
    $jsonInfo = json_decode(file_get_contents($file), true);

    $now_seconds = time();
    
    $privateKey = $jsonInfo['private_key'];
    
    $payload = [
        'iss' => $jsonInfo['client_email'],
        'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        'aud' => $jsonInfo['token_uri'],
        //Token to be expired after 1 hour
        'exp' => $now_seconds + (60 * 60),
        'iat' => $now_seconds
    ];
    
    $jwt = JWT::encode($payload, $privateKey, 'RS256');
    
    // create curl resource
    $ch = curl_init();
    
    // set post fields
    $post = [
        'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
        'assertion' => $jwt
    ];
    
    $ch = curl_init($jsonInfo['token_uri']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    
    // execute!
    $response = curl_exec($ch);
    
    // close the connection, release resources used
    curl_close($ch);
    
    // do anything you want with your response
    $jsonObj = json_decode($response, true);

    return $jsonObj['access_token'];
}




function filterRequest($requestname)
{
    if (isset($_POST[$requestname]) && is_array($_POST[$requestname])) {
        return array_map(function($item) {
            return htmlspecialchars(strip_tags($item));
        }, $_POST[$requestname]);
    } elseif (isset($_POST[$requestname])) {
        return htmlspecialchars(strip_tags($_POST[$requestname]));
    }
    return null; // or return an empty array if you prefer
}

function changeItemRating($item)
{
    // Use the getAllData function to fetch all ratings for the given item ID
    $reviews = getAllData('reviews', 'item = ?', [$item]);
    
    // If no reviews found, set the average rating to 0
    if (empty($reviews)) {
        $averageRating = 0;
    } else {
        // Extract the ratings from the reviews
        $ratings = array_column($reviews, 'rating');
        
        // Calculate the average rating
        $averageRating = array_sum($ratings) / count($ratings);

        $averageRating = round($averageRating, 1);
    }
    
    // Use the updateData function to update the item's rating in the items table
    updateData('items', ['rating' => $averageRating], "id = $item");
}


function getAllData($table, $where = null, $values = null, $orderBy = null)
{
    global $con;
    $data = array();

    // Build the base query
    $query = "SELECT * FROM $table";

    // Add WHERE clause if needed
    if ($where != null) {
        $query .= " WHERE $where";
    }

    // Add ORDER BY clause if needed
    if ($orderBy != null) {
        // Quote the column names to avoid conflicts with reserved keywords
        $query .= " ORDER BY " . str_replace('order', '`order`', $orderBy);
    }

    // Prepare and execute the query
    $stmt = $con->prepare($query);
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}



function insertData($table, $data)
{
    global $con;
    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    return $con->lastInsertId();
}


function updateData($table, $data, $where)
{
    global $con;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $con->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    return $count;
}

function deleteData($table, $where)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    return $count;
}

function fetchAll($query, $values = null)
{
    global $con;
    $data = array();

    $stmt = $con->prepare($query);
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}

function imageUpload($dir, $imageRequest)
{

  global $msgError;
  if(isset($_FILES[$imageRequest])){
    $imagename  = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
    $imagetmp   = $_FILES[$imageRequest]['tmp_name'];
    $imagesize  = $_FILES[$imageRequest]['size'];
    $allowExt   = array("svg", "png", "jpg", "jpeg", "SVG", "PNG");
    $strToArray = explode(".", $imagename);
    $ext        = end($strToArray);
    $ext        = strtolower($ext);
  
    if (!empty($imagename) && !in_array($ext, $allowExt)) {
      $msgError = "EXT";
    }
    if ($imagesize > 2 * MB) {
      $msgError = "size";
    }
    if (empty($msgError)) {
      move_uploaded_file($imagetmp,  $dir . "/" . $imagename);
      return $imagename;
    } else {
      return "fail";
    }
  }else{
    return "empty";
  }

}



function deleteFile($dir, $imagename)
{
    if (file_exists($dir . "/" . $imagename)) {
        unlink($dir . "/" . $imagename);
    }
}

function checkAuthenticate()
{
    if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {
        if ($_SERVER['PHP_AUTH_USER'] != "wael" ||  $_SERVER['PHP_AUTH_PW'] != "wael12345") {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Page Not Found';
            exit;
        }
    } else {
        exit;
    }
}

function createList($input) {
    
    $jsonList = filterRequest($input);
    $array = json_decode($jsonList, true);
    return $array;
}


function sendFCM($title, $message, $topic, $file) {
    $token = returnFireBaseTkn($file);
    $url = 'https://fcm.googleapis.com/v1/projects/fasty-ea533/messages:send';
    $fields = [
        "message" => [
            "topic" => $topic,
            "notification" => [
                "title" => $title,
                "body" => $message
            ],
            "android" => [
                "notification" => [
                    "click_action" => "TOP_STORY_ACTIVITY",
                    "body" => $message
                ]
            ],
            "apns" => [
                "payload" => [
                    "aps" => [
                        "category" => "NEW_MESSAGE_CATEGORY"
                    ]
                ]
            ]
        ]
    ];
    $fields = json_encode($fields);
    $headers = array(
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $result = curl_exec($ch);
    /*
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    } else {
        echo 'Response: ' . $result;
    }
        */
    return $result;
    curl_close($ch);

}

function insertNotification($title, $body, $user = null){
global $con;

if($user != null){
    $stmt = $con->prepare("INSERT INTO `notifications`(`title`, `body`, `user`) VALUES (?, ?, ?)");
    $stmt -> execute(array($title, $body, $user));
    $count = $stmt -> rowCount();
    
    $userData = array(
        "notification" => 1,
    );
    
    updateData('users', $userData, "id = $user");
     
}else{
    $stmt = $con->prepare("INSERT INTO `notifications`(`title`, `body`) VALUES (?, ?)");
    $stmt -> execute(array($title, $body));
    $count = $stmt -> rowCount();
}
return $count;
}

function getCartExtras($cartIds) {
    if (empty($cartIds)) {
        return [];
    }

    $cartItemIdsString = implode(',', array_map('intval', $cartIds));
    $where = "cart IN ($cartItemIdsString)";
    $cartExtras = getAllData('cart_extra', $where);
    
    return $cartExtras;
}

function printFailure(){
    echo json_encode(array("status" => "fail"));
}

function printSuccess(){
    echo json_encode(array("status" => "success"));
}

