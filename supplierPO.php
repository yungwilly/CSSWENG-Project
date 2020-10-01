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
        <!-- <a type="button" id="calculate" class="btn btn-info" href="CalculatePage.html">Calculate</a> -->
        <a type="button" id="client" class="btn btn-info" href="ClientInfo.php">Contact Info</a>
        <a type="button" id="orders" class="btn btn-info" href="clientPO.php">Orders</a>
        <a type="button" id="financial" class="btn btn-info" href="FinancialReport.php">Financial Report</a>
        <a type="button" id="logout" class="btn btn-info" href="HomePage.php">Logout</a>
    </div>

    <div class="dropdown">
        <button class="dropbtn">Dropdown</button>
        <div class="dropdown-content">
            <a href="clientPO.php">Client PO</a>
            <a href="supplierPO.php">Supplier PO</a>
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
                    <form name="add_name" id="add_name" action="store_supplyorder.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="supplyNumber">Supply Number</label>
                            <input type="text" class="form-control" name="supplyNumber">
                        </div>
                        <div class="form-group">
                            <label for="supplierName">Supplier Name</label>
                            <select type="text" name="supplierName" class="form-control measure_list">
                                <option disabled selected value> -- select an option -- </option>
                                <?php
                                include("includes/db.php");
                                $ref = "suppliers";
                                $data = $database->getReference($ref)->getValue();
                                foreach ($data as $key => $data1) {
                                ?>
                                    <option value="<?php echo $data1["supplierName"]; ?>"><?php echo $data1["supplierName"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="productOrders">Ingredient Ordered</label>
                            <input type="text" id="ingredient" class="form-control" name="ingredientName">
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Quantity</label>
                            <input type="number" id="oprice" class="form-control" name="qty">
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Price (in pesos)</label>
                            <input type="number" id="oprice" class="form-control" name="price">
                        </div>
                        <div class="form-group">
                            <label for="date">Date Due</label>
                            <input type="date" class="form-control" name="dueDate">
                        </div>
                        <div class="form-group">
                            <label for="dateDue">Status</label>
                            <select type="text" name="status">
                                <option disabled selected value> -- select -- </option>
                                <option value="Done">Done</option>
                                <option value="Ongoing">Ongoing</option>
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
                <th>Supply Number</th>
                <th>Supplier Name</th>
                <th>Ingredient Name</th>
                <th>Quantity</th>
                <th>Date Added</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("includes/db.php");
            $ref = "supplyorders";
            $data = $database->getReference($ref)->getValue();
            $i = 0;
            foreach ($data as $key => $data1) {
                $i++;
            ?>
                <tr>
                    <td><?php echo $data1['supplyNumber']; ?></td>
                    <td><?php echo $data1['supplierName']; ?></td>
                    <td><?php echo $data1['ingredientName']; ?></td>
                    <td><?php echo $data1['qty']; ?></td>
                    <td><?php echo $data1['date']; ?></td>
                    <td><?php echo $data1['status']; ?></td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#viewmodal<?php echo $i; ?>"> View</button>
                        <?php
                        if ($data1['status'] != "Done") {
                        ?>
                            <a type="button" class="btn btn-success" href="update_supplyorderstatus.php?key=<?php echo $key; ?>"> Done</a>
                        <?php
                        }
                        ?>

                        <div id="viewmodal<?php echo $i; ?>" class="modal fade" role="dialog" aria-hidden="true" tabindex="-1">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">View Orders</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form name="add_name" id="add_name" action="update_supplyorderstatus.php" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="productName">Supply Number</label>
                                                <input type="text" class="form-control" name="poNumber" value="<?php echo $data1['supplyNumber']; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="productName">Supplier Name</label>
                                                <input type="text" class="form-control" name="clientName" value="<?php echo $data1['supplierName']; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="date">Date Added</label>
                                                <input type="date" class="form-control" name="date" value="<?php echo $data1['date']; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="ingredientName">Ingredient Ordered</label>
                                                <input type="text" class="form-control" name="ingredientName" value="<?php echo $data1['ingredientName']; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="productPrice">Quantity</label>
                                                <input type="number" id="oprice" class="form-control" name="qty" value="<?php echo $data1['qty']; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Price (in pesos)</label>
                                                <input type="number" class="form-control" name="price" value="<?php echo $data1['price']; ?>" disabled>
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
</script>