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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="FinancialReport.css">
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
            <a href="FinancialReport.php">Sales Report</a>
            <a href="ExpenseReport.php">Expense Report</a>
        </div>
    </div>
    <br>
    <br>   

    <div>
        <a href="ExpenseReportPrintChange.php" target="_blank" class="btn btn-primary"> Print</a>
    </div>
    <div>
        <form action="update_expense_report.php" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-md-6">
                    <label for="dateAdded">Start Date</label>
                    <input type="date" class="form-control" id="dateAdded" name="startDate">
                </div>
                <!-- Default input -->
                <div class="col-md-6">
                    <label for="birthday">End Date</label>
                    <input type="date" class="form-control" id="endDate" name="endDate">
                </div>
                <div class="col-md-12">
                    <input type="submit" name="update" value="Set">
                </div>
            </div>
        </form>
    </div>

    <table class="tg" style="table-layout: fixed; width: 100%;">
        <thead>
            <tr>
                <th class="tg-0pky"><b>Supply No.</b></th>
                <th class="tg-0pky"><b>Date</b></th>
                <th class="tg-0pky"><b>Supplier Name</b></th>
                <th class="tg-0pky"><b>Ingredient</b></th>
                <th class="tg-0pky"><b>Quantity Ordered</b></th>
                <th class="tg-0pky"><b>Price</b></th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("includes/db.php");
            $ref = "supplyorders";
            $data = $database->getReference($ref)->getValue();
            $totalprice = 0;
            $array = array();
            foreach ($data as $key => $data1) {
                if($data1['status'] == "Done" && $data1['date'] >= $_SESSION["startDate"]  && $data1['date'] <= $_SESSION["endDate"]){
                array_push($array, $data1['supplierName']);
                $totalprice += $data1['price'];
            ?>
                <tr>
                    <td><?php echo $data1['supplyNumber']; ?></td>
                    <td><?php echo $data1['date']; ?></td>
                    <td><?php echo $data1['supplierName']; ?></td>
                    <td><?php echo $data1['ingredientName']; ?></td>
                    <td><?php echo $data1['qty']; ?></td>
                    <td><?php echo $data1['price']; ?></td>
                </tr>
                <?php
                }
            }
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Suppliers</b></td>
                    <td><b>Times ordered</b></td>
                </tr>
                <?php

                $unique =  array_unique($array);
                foreach ($unique as $value) {
                    $count = 0;
                ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php echo $value; ?></td>
                        <?php
                        foreach ($data as $key => $data1) {
                            if ($data1['status'] == "Done" && $value == $data1['supplierName'] && $data1['date'] >= $_SESSION["startDate"]  && $data1['date'] <= $_SESSION["endDate"])
                                $count++;
                        ?>
                        <?php
                        }
                        ?>
                        <td><?php echo $count; ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Total Cost</b></td>
                    <td><?php echo $totalprice; ?></td>
                </tr>
        </tbody>
    </table>
</body>

</html>