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

    $ref = "orders";
    $data = $database->getReference($ref)->getValue();
    foreach ($data as $key => $data1) {
        if ($key == $_GET['key']) {
            $product = array();
            $productamount = array();
            $productmeasure = array();
            $n = 0;
            foreach ($data1['products'] as $key2 => $data2) {
                array_push($product, $data2['name' . $n]);
                array_push($productamount, $data2['qty' . $n]);
                array_push($productmeasure, $data2['measure' . $n]);
                $n++;
            }
            $ref = "products";
            $dat = $database->getReference($ref)->getValue();
            $prodqtycount = 0;
            foreach ($product as $value) {
                foreach ($dat as $key => $dat1) {
                    $amount = array();
                    $ingredient = array();
                    $n = 0;
                    foreach ($dat1['ingredients'] as $key2 => $dat2) {
                        if ($value == $dat1['productName']) {
                            array_push($amount, $dat2['qty' . $n]);
                            array_push($ingredient, $dat2['name' . $n]);
                        }
                        $n++;
                    }
                    include("includes/db.php");
                    $ref2 = "ingredients";
                    $info = $database->getReference($ref2)->getValue();
                    $a = 0;
                    $newamount = array();
                    foreach ($ingredient as $value2) {
                        foreach ($info as $key3 => $info1) {
                            if ($value2 == $info1['ingredientName']) {
                                $hold =  floor(($info1['ingredientQty'] * 1000) / $amount[$a]);
                                if ($productmeasure[$prodqtycount] == "cs") {
                                    $required = $productamount[$prodqtycount] * 18 * $amount[$a] / 1000;
                                } 
                                else {
                                    $required = $productamount[$prodqtycount] * $amount[$a] / 1000;
                                }
                                $newIngredientQty = $info1['ingredientQty'] - $required;

                                $update = [
                                    'ingredientQty' => $newIngredientQty,
                                    'lastEdit' => $date
                                ];
                                $pushData = $database->getReference("ingredients/".$key3)->update($update);
                                array_push($newamount, $hold);
                            }
                        }
                        $a++;
                    }
                }
                $prodqtycount++;
            }
        }
    }


    header("Location:clientPO.php");
}
