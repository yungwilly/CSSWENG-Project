<?php
session_start();
include("includes/db.php");

if (isset($_GET['key'])) {
    $status = "Done";
    $date = date("Y-m-d");

    $data = [
        'status' => $status
    ];

$pushData = $database->getReference("orders/" . $_GET['key'])->update($data);





header("Location:clientPO.php");
}
?>