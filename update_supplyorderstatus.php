<?php
session_start();
include("includes/db.php");

if (isset($_GET['key'])) {
    $status = "Done";
    $date = date("Y-m-d");

    $data = [
        'status' => $status
    ];

    $pushData = $database->getReference("supplyorders/" . $_GET['key'])->update($data);

    $ref = "supplyorders";
    $data = $database->getReference($ref)->getValue();
    foreach ($data as $key => $data1) {
        $ingredient = array();
        $ingredientqty = array();
        if ($key == $_GET['key']) {
            array_push($ingredient, $data1['ingredientName']);
            array_push($ingredientqty, $data1['qty']);
        }
        $ref = "ingredients";
        $dat = $database->getReference($ref)->getValue();
        $i = 0;
        foreach($ingredient as $value){
            foreach($dat as $key2 => $dat1){
                if($value == $dat1['ingredientName']){

                    $new = $dat1['ingredientQty'] + $ingredientqty[$i];

                    $update = [
                        'ingredientQty' => $new,
                        'lastEdit' => $date
                    ];
                    $pushData = $database->getReference("ingredients/".$key2)->update($update);
                }
            }
            $i++;
        }
    }

    header("Location:supplierPO.php");
}