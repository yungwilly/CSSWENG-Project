<?php
session_start();
include("includes/db.php");
date_default_timezone_set('Asia/Manila');

if (isset($_POST['push'])) {
    $ingredientName = $_POST['ingredientName'];
    $ingredientQty = $_POST['ingredientQty'];
    $ingredientMeasure = $_POST['ingredientMeasure'];
    $ingredientThreshold = $_POST['ingredientThreshold'];
    $lastEdit = date("Y-m-d");

    $data = [
        'ingredientName' => $ingredientName,
        'ingredientQty' => $ingredientQty,
        'ingredientMeasure' => $ingredientMeasure,
        'ingredientThreshold' => $ingredientThreshold,
        'lastEdit' => $lastEdit
    ];
    $ref = "ingredients/";
    $pushData = $database->getReference($ref)->push($data);
    header("Location:InventoryPage.php");
} 

else {
    $ingredientName = $_POST['ingredientName'];
    $ingredientQty = $_POST['ingredientQty'];
    $ingredientMeasure = $_POST['ingredientMeasure'];
    $ingredientThreshold = $_POST['ingredientThreshold'];
    $lastEdit = date("Y-m-d");

    $data = [
        'ingredientName' => $ingredientName,
        'ingredientQty' => $ingredientQty,
        'ingredientMeasure' => $ingredientMeasure,
        'ingredientThreshold' => $ingredientThreshold,
        'lastEdit' => $lastEdit
    ];
    $ref = "ingredients/";
    $pushData = $database->getReference($ref)->set($data);
}
