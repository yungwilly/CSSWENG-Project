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
    <link rel="stylesheet" href="ClientInfo.css">
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
        <a type="button" id="logout" class="btn btn-info" href="HomePage.php">Logout</a>
    </div>
    <div class="dropdown">
        <button class="dropbtn">Dropdown</button>
        <div class="dropdown-content">
            <a href="ClientInfo.php">Client Info</a>
            <a href="SupplierInfo.php">Supplier Info</a>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>



    <button type="button" id="addIngredient" data-toggle="modal" data-target="#addmodal">Add Client</button>

    <!-- Modal -->
    <div id="addmodal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Client</h4>
                </div>
                <div class="modal-body">
                    <form action="store_client.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="clientName">Client Name</label>
                            <input type="text" class="form-control" name="clientName">
                        </div>
                        <div class="form-group">
                            <label for="clientAddress">Address</label>
                            <input type="text" class="form-control" name="address">
                        </div>
                        <div class="form-group">
                            <label for="clientContact">Contact Number</label>
                            <input type="text" name="contact" class="form-control">
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
                <th>Client Name</th>
                <th>Address</th>
                <th>Contact No.</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("includes/db.php");
            $ref = "clients";
            $data = $database->getReference($ref)->getValue();
            foreach ($data as $key => $data1) {
            ?>
                <tr>
                    <td><?php echo $data1['clientName']; ?></td>
                    <td><?php echo $data1['address']; ?></td>
                    <td><?php echo $data1['contact']; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>

</html>