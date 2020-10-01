<?php
session_start();
include("includes/db.php");
date_default_timezone_set('Asia/Manila');

if (isset($_POST['push'])) {
    $clientName = $_POST['clientName'];
    $poNumber = $_POST['poNumber'];
    $dateDue = $_POST['dateDue'];
    $price = $_POST['oprice'];
    $status = $_POST['status'];
    $date = date("Y-m-d");

    $data = [
        'clientName' => $clientName,
        'poNumber' => $poNumber,
        'dateDue' => $dateDue,
        'price' => $price,
        'status' => $status,
        'date' => $date

    ];
    $ref = "orders/";
    $pushData = $database->getReference($ref)->push($data)->getKey();

    $number = count($_POST["name"]);

    for ($i = 0; $i < $number; $i++) {
        if (trim($_POST["name"][$i] != '')) {
            $name = $_POST['name'][$i];
            $qty = $_POST['qty'][$i];
            $measure = $_POST['measure'][$i];
            $uprice = $_POST['uprice'][$i];
            $tprice = $_POST['tprice'][$i];

            $data = [
                'name' . $i => $name,
                'qty' . $i => $qty,
                'measure' . $i => $measure,
                'uprice' . $i => $uprice,
                'tprice' . $i => $tprice
            ];
            $ref = "orders/" . $pushData . "/products";
            $pushData2 = $database->getReference($ref)->push($data);
        }
    }
    header("Location:clientPO.php");
} else {
    $clientName = $_POST['clientName'];
    $poNumber = $_POST['poNumber'];
    $dateDue = $_POST['dateDue'];
    $price = $_POST['oprice'];
    $status = $_POST['status'];
    $date = date("Y-m-d");

    $data = [
        'clientName' => $clientName,
        'poNumber' => $poNumber,
        'dateDue' => $dateDue,
        'price' => $price,
        'status' => $status,
        'date' => $date

    ];
    $ref = "orders/";
    $pushData = $database->getReference($ref)->push($data)->getKey();

    $number = count($_POST["name"]);

    for ($i = 0; $i < $number; $i++) {
        if (trim($_POST["name"][$i] != '')) {
            $name = $_POST['name'][$i];
            $qty = $_POST['qty'][$i];
            $measure = $_POST['measure'][$i];
            $uprice = $_POST['uprice'][$i];
            $tprice = $_POST['tprice'][$i];

            $data = [
                'name' . $i => $name,
                'qty' . $i => $qty,
                'measure' . $i => $measure,
                'uprice' . $i => $uprice,
                'tprice' . $i => $tprice
            ];
            $ref = "orders/" . $pushData . "/products";
            $pushData2 = $database->getReference($ref)->push($data);
        }
    }
}
