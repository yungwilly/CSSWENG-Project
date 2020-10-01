<?php
session_start();
?>
<html>

<head>
    <title>
        22 PROPACK ASIA CORPORATION
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="InventoryPage.css">
</head>

<body>
    <div>
        <img src="propack.png" width="" alt="" id="pic">
    </div>

    <div>
        <a type="button" id="inventory" class="btn btn-info" href="InventoryPage.php">Inventory</a>
        <a type="button" id="calculate" class="btn btn-info" href="CalculatePage.html">Calculate</a>
        <a type="button" id="client" class="btn btn-info" href="ClientInfo.php">Client Info</a>
        <a type="button" id="orders" class="btn btn-info" href="clientPO.php">Orders</a>
        <a type="button" id="financial" class="btn btn-info" href="FinancialReport.php">Financial Report</a>
    </div>

    <div class="dropdown">
        <button class="dropbtn">Dropdown</button>
        <div class="dropdown-content">
            <a href="inventoryPage.php">Ingredients</a>
            <a href="productPage.php">Finished Products</a>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

    <button type="button" id="addProduct" data-toggle="modal" data-target="#addmodal">Add Order</button>

    <!-- Modal -->
    <div id="addmodal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Order</h4>
                </div>
                <div class="modal-body">
                    <form name="add_name" id="add_name" action="store_clientpo.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="poNumber">PO Number</label>
                            <input type="text" class="form-control" name="poNumber">
                        </div>
                        <div class="form-group">
                            <label for="clientName">Client Name</label>
                            <select type="text" name="clientName" class="form-control measure_list" onchange="myFunction()">
                                <option disabled selected value> -- select an option -- </option>
                                <?php
                                include("includes/db.php");
                                $ref = "clients";
                                $data = $database->getReference($ref)->getValue();
                                foreach ($data as $key => $data1) {
                                ?>
                                    <option value="<?php echo $data1["clientName"]; ?>"><?php echo $data1["clientName"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <label for="productOrders">Products</label>
                        <table class="table table-bordered" id="dynamic_field">
                            <tr>
                                <td>Name: <input type="text" id="name1" name="name[]" class="form-control name_list"></td>
                                <td>Unit Price: <input type="number" id="uprice1" name="uprice[]" class="form-control qty_list"></td>
                                <td>Amount: <input type="number" id="qty1" name="qty[]" class="form-control qty_list"></td>
                                <td>Measurement: <select type="text" id="measure1" name="measure[]" class="form-control measure_list" onchange="myFunction()">
                                        <option disabled selected value> -- select -- </option>
                                        <option value="pcs">pieces</option>
                                        <option value="cs">cases</option>
                                    </select>
                                </td>
                                <td>Total Price: <input type="number" id="tprice1" name="tprice[]" class="form-control qty_list"></td>
                                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                            </tr>
                        </table>
                        <div class="form-group">
                            <label for="dateDue">Due Date</label>
                            <input type="date" class="form-control" name="dateDue">
                        </div>

                        <div class="form-group">
                            <label for="productPrice">Overall Price (in pesos)</label>
                            <input type="number" id="oprice" class="form-control" name="oprice">
                        </div>
                        <div class="form-group">
                            <label for="dateDue">Status</label>
                            <select type="text" name="status">
                                <option value="Done">Done</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Late">Late</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="push" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>

        </div>
    </div>



    <table class="tg" style="table-layout: fixed; width: 100%;">

        <thead>
            <tr>
                <th>PO Number</th>
                <th>Client Name</th>
                <th>Date Added</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("includes/db.php");
            $ref = "orders";
            $data = $database->getReference($ref)->getValue();
            $i = 0;
            foreach ($data as $key => $data1) {
                $product = array();
                $productamount = array();
                $productmeasure = array();
                $i++;
            ?>
                <tr>
                    <td><?php echo $data1['poNumber']; ?></td>
                    <td><?php echo $data1['clientName']; ?></td>
                    <td><?php echo $data1['date']; ?></td>
                    <td><?php echo $data1['dateDue']; ?></td>
                    <td><?php echo $data1['status']; ?></td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#viewmodal<?php echo $i; ?>"> View</button>
                        <a type="button" class="btn btn-success" href="update_orderstatus.php?key=<?php echo $key; ?>"> Done</a>

                        <div id="viewmodal<?php echo $i; ?>" class="modal fade" role="dialog" aria-hidden="true" tabindex="-1">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">View Orders</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form name="add_name" id="add_name" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="productName">PO Number</label>
                                                <input type="text" class="form-control" name="poNumber" value="<?php echo $data1['poNumber']; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="productName">Client Name</label>
                                                <input type="text" class="form-control" name="clientName" value="<?php echo $data1['clientName']; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="date">Date Added</label>
                                                <input type="date" class="form-control" name="date" value="<?php echo $data1['date']; ?>" disabled>
                                            </div>
                                            <label for="productOrders">Products</label>
                                            <table class="table table-bordered" id="dynamic_field">

                                                <?php

                                                $n = 0;
                                                foreach ($data1['products'] as $key2 => $data2) {
                                                    array_push($product, $data2['name' . $n]);
                                                    array_push($productamount, $data2['qty' . $n]);
                                                    array_push($productmeasure, $data2['measure' . $n]);
                                                ?>
                                                    <tr>
                                                        <td>Name: <input type="text" name="name[]" class="form-control name_list" value="<?php echo $data2['name' . $n]; ?>"></td>
                                                        <td>Unit Price: <input type="number" name="uprice[]" class="form-control measure_list" value="<?php echo $data2['uprice' . $n]; ?>">
                                                        <td>Amount: <input type="number" name="qty[]" class="form-control qty_list" value="<?php echo $data2['qty' . $n]; ?>"></td>
                                                        <td>Measurement: <input type="text" name="measure[]" class="form-control measure_list" value="<?php echo $data2['measure' . $n]; ?>">
                                                        <td>Total Price: <input type="number" name="tprice[]" class="form-control measure_list" value="<?php echo $data2['tprice' . $n]; ?>">
                                                    </tr>
                                                <?php
                                                    $n++;
                                                }
                                                ?>

                                            </table>

                                            <?php
                                            include("includes/db.php");
                                            $ref = "products";
                                            $dat = $database->getReference($ref)->getValue();
                                            $prodqtycount = 0;
                                            foreach ($product as $value) {
                                            ?>

                                                <h4>Product: <?php echo $value; ?></h4>
                                                <h4>Required ingredients:</h4>
                                                <?php
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
                                                                } else {
                                                                    $required = $productamount[$prodqtycount] * $amount[$a] / 1000;
                                                                }
                                                                array_push($newamount, $hold);
                                                ?>
                                                                <?php
                                                                if ($info1['ingredientMeasure'] == "kg") {
                                                                    echo $value2 . ": (" . $productamount[$prodqtycount] . " * 18) * " . $amount[$a] . "/1000 = " . $required . "kg";
                                                                ?>
                                                                    <br>
                                                                <?php
                                                                    echo "Current stock: " . $info1['ingredientQty'] . $info1['ingredientMeasure'];
                                                                } else {
                                                                    echo $value2 . ": (" . $productamount[$prodqtycount] . " * 18) * " . $amount[$a] . "/1000 = " . $required . "l";
                                                                ?>
                                                                    <br>
                                                                <?php
                                                                echo "Current stock: " . $info1['ingredientQty'] . $info1['ingredientMeasure'];
                                                                }
                                                                ?> 
                                                                <br>

                                            <?php
                                                            }
                                                        }
                                                        $a++;
                                                    }
                                                }
                                                $prodqtycount++;
                                            }
                                            ?>
                                            <br>
                                            <div class="form-group">
                                                <label for="totalPrice">Price (in pesos)</label>
                                                <input type="number" class="form-control" name="totalPrice" value="<?php echo $data1['price']; ?>">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>

</html>
<script type="text/javascript" src="includes/db.php"></script>
<script>
    $(document).ready(function() {
        var i = 1;
        <?php $loop = 1; ?>
        $('#add').click(function() {
            <?php $loop++; ?>
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '"><td>Name: <input type="text" id="name' + i + '" name="name[]" class="form-control name_list"></td><td>Unit Price: <input type="number" id="uprice' + i + '" name="uprice[]" class="form-control qty_list"></td><td>Amount: <input type="number" id="qty' + i + '" name="qty[]" class="form-control qty_list"></td><td>Measurement: <select type="text" id="measure' + i + '" name="measure[]" class="form-control measure_list" onchange="myFunction()"><option disabled selected value> -- select -- </option><option value="pcs">pieces</option><option value="cs">cases</option><td>Total Price: <input type="number" id="tprice' + i + '" name="tprice[]" class="form-control qty_list"></td></select></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

        /*
        $('#submit').click(function() {
            $.ajax({
                url: "name.php",
                method: "POST",
                data: $('#add_name').serialize(),
                success: function(data) {
                    alert(data);
                    $('#add_name')[0].reset();
                }
            });
        });
        */
    });

    function myFunction() {
        var n = 0;
        var total = 0;
        var count = <?php echo $loop; ?>;
        while (n < 3) {
            n++;
            if (document.getElementById("measure" + n).value == "pcs") {
                document.getElementById("tprice" + n).value = document.getElementById("uprice" + n).value * document.getElementById("qty" + n).value;
            } else if (document.getElementById("measure" + n).value == "cs") {
                document.getElementById("tprice" + n).value = document.getElementById("uprice" + n).value * document.getElementById("qty" + n).value * 18;
            }
            total = total += parseFloat(document.getElementById("tprice" + n).value);


        }
        document.getElementById("oprice").value = total;
    }
</script>