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
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

    <button type="button" id="addProduct" data-toggle="modal" data-target="#addmodal">Add Product</button>

    <!-- Modal -->
    <div id="addmodal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Product</h4>
                </div>
                <div class="modal-body">
                    <form name="add_name" id="add_name" action="store_product.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" class="form-control" name="productName">
                        </div>
                        <label for="productIngredients">Ingredients</label>
                        <table class="table table-bordered" id="dynamic_field">
                            <tr>
                                <td>Name: <input type="text" name="name[]" class="form-control name_list"></td>
                                <td>Amount: <input type="number" name="qty[]" class="form-control qty_list"></td>
                                <td>Measurement: <select type="text" name="measure[]" class="form-control measure_list">
                                        <option value="g">grams</option>
                                        <option vakue="ml">mililiters</option>
                                    </select>
                                </td>
                                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                            </tr>
                        </table>
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
                <th>ProductName</th>
                <th>Product Price (in pesos)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("includes/db.php");
            $ref = "products";
            $data = $database->getReference($ref)->getValue();
            $i = 0;
            foreach ($data as $key => $data1) {
                $amount = array();
                $ingredient = array();
                $i++;
            ?>
                <tr>
                    <td><?php echo $data1['productName']; ?></td>
                    <td><?php echo $data1['productPrice']; ?></td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#viewmodal<?php echo $i; ?>"> View</button>

                        <div id="viewmodal<?php echo $i; ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">View Product</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form name="add_name" id="add_name" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="productName">Product Name</label>
                                                <input type="text" class="form-control" name="productName" value="<?php echo $data1['productName']; ?>" disabled>
                                            </div>
                                            <label for="productIngredients">Ingredients</label>
                                            <table class="table table-bordered" id="dynamic_field">

                                                <?php

                                                $n = 0;
                                                foreach ($data1['ingredients'] as $key2 => $data2) {
                                                    array_push($amount, $data2['qty' . $n]);
                                                    array_push($ingredient, $data2['name' . $n]);

                                                ?>
                                                    <tr>
                                                        <td>Name: <input type="text" name="name[]" class="form-control name_list" value="<?php echo $data2['name' . $n]; ?>"></td>
                                                        <td>Amount: <input type="number" name="qty[]" class="form-control qty_list" value="<?php echo $data2['qty' . $n]; ?>"></td>
                                                        <td>Measurement: <input type="text" name="measure[]" class="form-control measure_list" value="<?php echo $data2['measure' . $n]; ?>">
                                                    </tr>
                                                <?php
                                                    $n++;
                                                }
                                                ?>

                                            </table>
                                            <div class="form-group">
                                                <h4>Formula: (current stocks * 1000) / amount needed</h4>
                                                <h4>Note: multiplied to 1000 to convert kg and l into g and ml respectively</h4>
                                            </div>

                                            <?php
                                            include("includes/db.php");
                                            $ref = "ingredients";
                                            $data = $database->getReference($ref)->getValue();
                                            $a = 0;
                                            $newamount = array();
                                            foreach ($ingredient as $value) {
                                                foreach ($data as $key => $data1) {
                                                    if ($value == $data1['ingredientName']) {
                                                        $hold =  floor(($data1['ingredientQty'] * 1000) / $amount[$a]);
                                                        array_push($newamount, $hold);
                                                        echo $value . ": (" . $data1['ingredientQty'] . " * 1000) / " . $amount[$a] . " = " . $hold; ?> <br>

                                            <?php
                                                    }
                                                }
                                                $a++;
                                            }
                                            ?>
                                            <br>
                                            <div class="form-group">
                                                <label for="productPrice">Total Possible Productions</label>
                                                <input type="number" class="form-control" name="production" value="<?php echo (min($newamount)) ?>">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
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
        $('#add').click(function() {
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '"><td>Name: <input type="text" name="name[]" class="form-control name_list"></td><td>Amount: <input type="number" name="qty[]" class="form-control qty_list"></td><td>Measurement: <select type="text" name="measure[]" class="form-control measure_list"><option value="g">grams</option><option vakue="ml">mililiters</option></select></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
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
</script>