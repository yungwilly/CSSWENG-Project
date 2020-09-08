<?php
session_start();
include("includes/db.php");
date_default_timezone_set('Asia/Manila');

if (isset($_POST['push'])) {
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];

    $data = [
        'productName' => $productName,
        'productPrice' => $productPrice

    ];
    $ref = "products/";
    $pushData = $database->getReference($ref)->push($data)->getKey();

    $number = count($_POST["name"]);

    for ($i = 0; $i < $number; $i++) {
        if (trim($_POST["name"][$i] != '')) {
            $name = $_POST['name'][$i];
            $qty = $_POST['qty'][$i];
            $measure = $_POST['measure'][$i];

            $data = [
                'name' . $i => $name,
                'qty' . $i => $qty,
                'measure' . $i => $measure
            ];
            $ref = "products/" . $pushData . "/ingredients";
            $pushData2 = $database->getReference($ref)->push($data);
        }
    }
    header("Location:productPage.php");
} else {
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];

    $data = [
        'productName' => $productName,
        'productPrice' => $productPrice

    ];
    $ref = "products/";
    $pushData = $database->getReference($ref)->push($data)->getKey();

    $number = count($_POST["name"]);

    for ($i = 0; $i < $number; $i++) {
        if (trim($_POST["name"][$i] != '')) {
            $name = $_POST['name'][$i];
            $qty = $_POST['qty'][$i];
            $measure = $_POST['measure'][$i];

            $data = [
                'name' . $i => $name,
                'qty' . $i => $qty,
                'measure' . $i => $measure
            ];
            $ref = "products/" . $pushData . "/products";
            $pushData2 = $database->getReference($ref)->push($data);
        }
    }
}
