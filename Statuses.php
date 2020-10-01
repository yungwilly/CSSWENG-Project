<head>
    <title>
        22 PROPACK ASIA CORPORATION
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=devic  e-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="Statuses.css">
</head>

<body>
    <div>
        <img src="propack.png" width="" alt="" id="pic">
    </div>

    <div>
        <a type="button" id="statuses" class="btn btn-info" href="Statuses.php">Dashboard</a>
        <a type="button" id="inventory" class="btn btn-info" href="InventoryPage.php">Inventory</a>
        <!-- <a type="button" id="calculate" class="btn btn-info" href="CalculatePage.html">Calculate</a> -->
        <a type="button" id="client" class="btn btn-info" href="ClientInfo.php">Contact Info</a>
        <a type="button" id="orders" class="btn btn-info" href="clientPO.php">Orders</a>
        <a type="button" id="financial" class="btn btn-info" href="FinancialReport.php">Financial Report</a>
    </div>

    <table class="tg" style="table-layout: fixed; width: 100%; height: 50%;">
        <thead>
            <tr>
                <th class="tg-0lax">Item Name</th>
                <th class="tg-0lax">Stock</th>
                <th class="tg-0lax">Measurement</th>
                <th class="tg-0lax">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("includes/db.php");
            $ref = "ingredients";
            $data = $database->getReference($ref)->getValue();
            $i = 0;
            foreach ($data as $key => $data1) {
                $i++;
                if ($data1['ingredientThreshold'] >= $data1['ingredientQty']) {
            ?>
                    <tr style="background-color: #ffa6a6;">
                        <td><?php echo $data1['ingredientName']; ?></td>
                        <td><?php echo $data1['ingredientQty']; ?></td>
                        <td><?php echo $data1['ingredientMeasure']; ?></td>
                        <td><?php echo "Stocks are low!"; ?></td>
                    </tr>
                <?php
                } else {
                ?>
                    <tr>
                        <td><?php echo $data1['ingredientName']; ?></td>
                        <td><?php echo $data1['ingredientQty']; ?></td>
                        <td><?php echo $data1['ingredientMeasure']; ?></td>
                        <td><?php echo "Inventory is doing fine!"; ?></td>
                    </tr>
            <?php
                }
            }
            ?>
    </table>

</body>