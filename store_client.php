<?php
session_start();
include("includes/db.php");
date_default_timezone_set('Asia/Manila');

if (isset($_POST['push'])) {
    $clientName = $_POST['clientName'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $data = [
        'clientName' => $clientName,
        'address' => $address,
        'contact' => $contact
    ];
    $ref = "clients/";
    $pushData = $database->getReference($ref)->push($data);
    header("Location:ClientInfo.php");
} 

else {
    $clientName = $_POST['clientName'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $data = [
        'clientName' => $clientName,
        'address' => $address,
        'contact' => $contact
    ];
    $ref = "clients/";
    $pushData = $database->getReference($ref)->set($data);
}
