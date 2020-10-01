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

    <div>
        <a href="FinancialReportPrintChange.php" target="_blank" class="btn btn-primary"> Print</a>
    </div>
    <div>
        <form action="update_financial_report.php" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-md-6">
                    <label for="dateAdded">Start Date</label>
                    <input type="date" class="form-control" id="dateAdded" name="startDate">
                </div>
                <!-- Default input -->
                <div class="col-md-6">
                    <label for="birthday">End Date</label>
                    <input type="date" class="form-control" id="birthday" name="endDate">
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
                <th class="tg-0pky">PO No.</th>
                <th class="tg-0pky">Client Name</th>
                <th class="tg-0pky">Product</th>
                <th class="tg-0pky">Measure</th>
                <th class="tg-0pky">Quantity Sold</th>
                <th class="tg-0pky">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("includes/db.php");
            $ref = "orders";
            $data = $database->getReference($ref)->getValue();
            $totalprice = 0;
            $array = array();
            foreach ($data as $key => $data1) {
                $n = 0;
                foreach ($data1['products'] as $key2 => $data2) {
                    if ($data1['date'] >= $_SESSION["startDate"]  && $data1['date'] <= $_SESSION["endDate"]) {
                        array_push($array, $data1['clientName']);
                        $totalprice += $data1['price'];
            ?>
                        <tr>
                            <td><?php echo $data1['poNumber']; ?></td>
                            <td><?php echo $data1['date']; ?></td>
                            <td><?php echo $data1['clientName']; ?></td>
                            <td><?php echo $data2['name' . $n]; ?></td>
                            <td><?php echo $data2['qty' . $n]; ?></td>
                            <td><?php echo $data2['measure' . $n]; ?></td>
                            <td><?php echo $data2['uprice' . $n]; ?></td>
                            <td><?php echo $data2['tprice' . $n]; ?></td>
                        <tr>
                <?php
                        $n++;
                    }
                }
            }
                ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>Clients</b></td>
                            <td><b>No. of times ordered</b></td>
                        </tr>
                        <?php

                        $unique =  array_unique($array);
                        foreach ($unique as $value) {
                            $n = 0;
                            $count = 0;
                        ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php echo $value; ?></td>
                                <?php
                                foreach ($data as $key => $data1) {
                                    foreach ($data1['products'] as $key2 => $data2) {
                                        if ($value == $data1['clientName'] && $data1['date'] >= $_SESSION["startDate"]  && $data1['date'] <= $_SESSION["endDate"]) {
                                            $count++;
                                ?>
                                <?php
                                        }
                                        $n++;
                                    }
                                }
                                ?>
                                <td><?php echo $count; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total Sales</td>
                            <td><?php echo $totalprice; ?></td>
                        </tr>
        </tbody>
    </table>
</body>

</html>