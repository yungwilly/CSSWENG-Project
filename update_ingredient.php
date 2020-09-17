<?php
session_start();
include("includes/db.php");

if(isset($_POST['update'])){
    $ingredientName = $_POST['ingredientName'];
    $ingredientQty = $_POST['ingredientQty'];
    $ingredientMeasure = $_POST['ingredientMeasure'];
    $ingredientThreshold = $_POST['ingredientThreshold'];
    $lastEdit = date("Y-m-d");
    $ref = $_POST['ref'];

    $data = [
        'ingredientName' => $ingredientName,
        'ingredientQty' => $ingredientQty,
        'ingredientMeasure' => $ingredientMeasure,
        'ingredientThreshold' => $ingredientThreshold,
        'lastEdit' => $lastEdit
    ];
    $pushData = $database->getReference($ref)->update($data);
    header("Location:InventoryPage.php");
}


?>