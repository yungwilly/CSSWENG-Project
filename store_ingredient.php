<?php
session_start();
include("includes/db.php");
date_default_timezone_set('Asia/Manila');

if (isset($_POST['push'])) {
    $ingredientName = $_POST['ingredientName'];
    $ingredientQty = $_POST['ingredientQty'];
    $ingredientThreshold = $_POST['ingredientThreshold'];

    $data = [
        'ingredientName' => $ingredientName,
        'ingredientQty' => $ingredientQty,
        'ingredientThreshold' => $ingredientThreshold
    ];
    $ref = "ingredients/";
    $pushData = $database->getReference($ref)->push($data);
    header("Location:InventoryPage.php");
} 

else {
    $ingredientName = $_POST['ingredientName'];
    $ingredientQty = $_POST['ingredientQty'];
    $ingredientThreshold = $_POST['ingredientThreshold'];

    $data = [
        'ingredientName' => $ingredientName,
        'ingredientQty' => $ingredientQty,
        'ingredientThreshold' => $ingredientThreshold
    ];
    $ref = "ingredients/";
    $pushData = $database->getReference($ref)->set($data);
}
