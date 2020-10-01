<?php
session_start();
include("includes/db.php");

if(isset($_POST['update'])){
    $_SESSION["startDate"] = $_POST["startDate"];
    $_SESSION["endDate"] = $_POST["endDate"];

    header("Location:FinancialReportChange.php");
}
?>