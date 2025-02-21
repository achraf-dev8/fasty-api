<?php
include "../../Core/connect.php";
include "../../Core/functions.php";

$id = filterRequest("id");
$sizes = createList("sizes");
$prices = createList("price");
$old_prices = createList("old_price");
$main = createList("main");



// Loop through new sizes and insert or update as needed

if(sizeof($sizes) == 0){

    $results = fetchAll("SELECT * FROM item_size WHERE item = ?", [$id]);
    $firstRow = $results[0];
    $mainValue = $firstRow['main'];
    $idValue = $firstRow['id'];
    if($mainValue == 0){
        $sizeData = array(
            "price" => $prices[0],
            "old_price" => $old_prices[0],
        );
        updateData("item_size", $sizeData, "id = $idValue");
    }else{
        deleteData("item_size", "item = $id");
        $sizeData = array(
            "item" => $id,
            "price" => $prices[0],
            "old_price" => $old_prices[0],
            "main" => $main[0]
        );
        insertData("item_size", $sizeData);
    }

}  else{
// Fetch existing sizes for the item
$existingSizes = fetchAll("SELECT `size` FROM item_size WHERE item = ?", [$id]);

// Convert existing sizes to a simple array for easy lookup
$existingSizesArray = array_column($existingSizes, 'size');
foreach ($sizes as $index => $size_id) {
    $price = $prices[$index];
    $old_price = $old_prices[$index];
    $main_value = $main[$index];

    if (!in_array($size_id, $existingSizesArray)) {
        // Insert new size record
        $insertData = array(
            "item" => $id,
            "size" => $size_id,
            "price" => $price,
            "old_price" => $old_price,
            "main" => $main_value
        );
        insertData('item_size', $insertData);
    } else {
        // Update existing size record
        $updateData = array(
            "price" => $price,
            "old_price" => $old_price,
            "main" => $main_value
        );
        $updateData = array(
            "price" => $price,
            "old_price" => $old_price,
            "main" => $main_value
        );
        updateData('item_size', $updateData, "item = $id AND size = $size_id");
    }
}

// Identify sizes to delete (those not in the new list)
$sizesToDelete = array_diff($existingSizesArray, $sizes);

// Delete sizes that are no longer in the list
if (!empty($sizesToDelete)) {
    $placeholders = implode(',', array_fill(0, count($sizesToDelete), '?'));
    $where = "item = ? AND size IN ($placeholders)";
    $values = array_merge([$id], $sizesToDelete);
    
    // Use the deleteData function to perform the deletion
    $query = "DELETE FROM item_size WHERE $where";
    $stmt = $con->prepare($query);
    $stmt->execute($values);
    $count = $stmt->rowCount();
}
}
// Output success
printSuccess();
?>
