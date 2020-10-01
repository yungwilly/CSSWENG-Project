<?php
session_start();
include("includes/db.php");
date_default_timezone_set('Asia/Manila');

if (isset($_POST['push'])) {
    $supplierName = $_POST['supplierName'];
    $supplyNumber = $_POST['supplyNumber'];
    $dateDue = $_POST['dueDate'];
    $ingredientName = $_POST['ingredientName'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $date = date("Y-m-d");

    $data = [
        'supplierName' => $supplierName,
        'supplyNumber' => $supplyNumber,
        'dateDue' => $dateDue,
        'ingredientName' => $ingredientName,
        'qty' => $qty,
        'price' => $price,
        'status' => $status,
        'date' => $date

    ];
    $ref = "supplyorders/";
    $pushData = $database->getReference($ref)->push($data)->push($data);
    header("Location:clientPO.php");
} else {
    $supplierName = $_POST['supplierName'];
    $supplyNumber = $_POST['supplyNumber'];
    $dateDue = $_POST['dueDate'];
    $ingredientName = $_POST['ingredientName'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $date = date("Y-m-d");

    $data = [
        'supplierName' => $supplierName,
        'supplyNumber' => $supplyNumber,
        'dateDue' => $dateDue,
        'ingredientName' => $ingredientName,
        'qty' => $qty,
        'price' => $price,
        'status' => $status,
        'date' => $date

    ];
    $ref = "supplyorders/";
    $pushData = $database->getReference($ref)->push($data)->push($data);
}
