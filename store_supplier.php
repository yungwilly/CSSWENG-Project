<?php
session_start();
include("includes/db.php");
date_default_timezone_set('Asia/Manila');

if (isset($_POST['push'])) {
    $supplierName = $_POST['supplierName'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $data = [
        'supplierName' => $supplierName,
        'address' => $address,
        'contact' => $contact
    ];
    $ref = "suppliers/";
    $pushData = $database->getReference($ref)->push($data);
    header("Location:SupplierInfo.php");
} 

else {
    $supplierName = $_POST['supplierName'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $data = [
        'supplierName' => $supplierName,
        'address' => $address,
        'contact' => $contact
    ];
    $ref = "suppliers/";
    $pushData = $database->getReference($ref)->set($data);
}
