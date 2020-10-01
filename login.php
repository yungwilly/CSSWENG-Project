<?php
session_start();
include("includes/db.php");


if (isset($_POST['userpush'])) {

    $email = $_POST['uName'];
    $passW = $_POST['uPass'];

    $ref = "employeeuser";
    $data = $database->getReference($ref)->getValue();
    foreach ($data as $key => $data1) {
        if($email == $data1["email"] && $passW == $data1["password"]){
            $_SESSION['position'] = "user";
            header("Location:Statuses.php");
        }
        else{
            header("Location:HomePage.php");
        }
    }
}
else if (isset($_POST['adminpush'])) {

    $email = $_POST['aName'];
    $passW = $_POST['aPass'];

    $ref = "adminuser";
    $data = $database->getReference($ref)->getValue();
    foreach ($data as $key => $data1) {
        if($email == $data1["email"] && $passW == $data1["password"]){
            $_SESSION['position'] = "admin";
            header("Location:Statuses.php");
        }
        else{
            header("Location:HomePage.php");
        }
    }

    
}
