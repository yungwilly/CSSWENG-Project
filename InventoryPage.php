<html>

<head>
    <title>
        22 PROPACK ASIA CORPORATION
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <a type="button" id="financial" class="btn btn-info" href="FinancialReport.html">Financial Report</a>
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

    <button type="button" id="addIngredient" data-toggle="modal" data-target="#addmodal">Add Ingredient</button>

    <!-- Modal -->
    <div id="addmodal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Ingredient</h4>
                </div>
                <div class="modal-body">
                    <form action="store_ingredient.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="ingredientName">Ingredient Name</label>
                            <input type="text" class="form-control" name="ingredientName">
                        </div>
                        <div class="form-group">
                                <label for="ingredientQty">Quantity</label>
                                <input type="number" class="form-control" name="ingredientQty">
                        </div>
                        <div class="form-group">
                                <label for="ingredientMeasure">Measurement</label>
                                <select name="ingredientMeasure" class="form-control">
                                    <option value="kg">kilograms</option>
                                    <option value="l">liters</option>
                                </select>
                        </div>
                        <div class="form-group">
                                <label for="ingredientName">Threshold</label>
                                <input type="number" class="form-control" name="ingredientThreshold">
                        </div>
                </div>
                <br>
                <div class="modal-footer">
                        <button type="submit" name="push" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>

        </div>
    </div>



    <table class="tg" style="table-layout: fixed; width: 100%; height: 50%;">

        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Measurement</th>
                <th>Threshold</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("includes/db.php");
            $ref = "ingredients";
            $data = $database->getReference($ref)->getValue();
            foreach ($data as $key => $data1) {
            ?>
                <tr>
                    <td><?php echo $data1['ingredientName']; ?></td>
                    <td><?php echo $data1['ingredientQty']; ?></td>
                    <td><?php echo $data1['ingredientMeasure']; ?></td>
                    <td><?php echo $data1['ingredientThreshold']; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <!--
    <table class="tg" style="table-layout: fixed; width: 100%; height: 50%;">
        <colgroup>
            <col style="width: 174px">
            <col style="width: 237px">
            <col style="width: 266px">
            <col style="width: 238px">
            <col style="width: 243px">
            <col style="width: 296px">
        </colgroup>
        <thead>
            <tr>
                <th class="tg-0pky"></th>
                <th class="tg-c3ow" colspan="5">Quantity</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="tg-0pky">Banana</td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
            </tr>
            <tr>
                <td class="tg-0pky">Honey</td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
            </tr>
            <tr>
                <td class="tg-0pky">Sugar</td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
            </tr>
            <tr>
                <td class="tg-0pky">Boxes</td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
                <td class="tg-0pky"></td>
            </tr>
        </tbody>
    </table>
            -->
</body>

</html>