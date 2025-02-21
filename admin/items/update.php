<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$id = filterRequest("id");
$name = filterRequest("name");
$description = filterRequest("description");
$category = filterRequest("category");
$active = filterRequest("active");
$extras = createList("extras");
$oldImage = filterRequest("old_image");
$res = imageUpload("../../upload/offers", "files");



if($res == "empty"){
    $data = array(
        "name" => $name,
        "category" => $category,
        "description" => $description,
        "active" => $active,
    );
}else{
    deleteFile("../../upload", $oldImage);
    $data = array(
        "name" => $name,
        "category" => $category,
        "description" => $description,
        "active" => $active,
        "image"=> $res
    );
}
    updateData('items', $data, "id = $id");

    //extras
    $existingExtras = fetchAll("SELECT `size` FROM item_size WHERE item = ?", [$id]);

    $existingExtrasArray = array_column($existingExtras, 'extra');

    foreach ($extras as $extra_id) {
        if (!in_array($extra_id, $existingExtrasArray)) {
            $insertData = array(
                "item" => $id,
                "extra" => $extra_id
            );
            insertData('item_extra', $insertData);
        }
    }

    $extrasToDelete = array_diff($existingExtrasArray, $extras);

    // Delete extras that are no longer in the list
    if (!empty($extrasToDelete)) {
        // Create the WHERE condition
        $placeholders = implode(',', array_fill(0, count($extrasToDelete), '?'));
        $where = "item = ? AND extra IN ($placeholders)";
        $values = array_merge([$id], $extrasToDelete);
        
        // Use the deleteData function to perform the deletion
        // Prepare query with placeholders
        $query = "DELETE FROM item_extra WHERE $where";
        
        // Prepare and execute the query
        $stmt = $con->prepare($query);
        $stmt->execute($values);
        
        // Check the number of rows affected
        $count = $stmt->rowCount();
    }
    

    printSuccess();
    



