<?php 
session_start();
?>
<html>

<head>
    <title>
        22 PROPACK ASIA CORPORATION
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=devic  e-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="HomePageStyle.css">
</head>

<body>
    <div>
        <img src="propack.png" width="" alt="" id="pic">
    </div>

    <div class="title">
        <p>22 PROPACK ASIA CORPORATION</p>
        <p id="InvSys">Inventory System</p>
        <p id="border"></p>
        <p id="login">Login as a:</p>
        <br>
        <?php 
        $_SESSION['error'] = false;
        if ($_SESSION['error'] == true) { ?>
            <p id="error">Error username or password!</p>
        <?php
        } ?>
    </div>

    <div>
        <button type="button" id="block1" data-toggle="modal" data-target="#usermodal">
            <p class="user">USER</p>
        </button>

        <!-- Modal -->
        <div id="usermodal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">User</h4>
                    </div>
                    <div class="modal-body">
                        <form action="login.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="email" class="form-control" name="uName">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="uPass">
                            </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="submit" name="userpush" class="btn btn-primary">Login</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>

        <button type="button" id="block2" data-toggle="modal" data-target="#adminmodal">
            <p class="user">ADMIN</p>
        </button>

        <!-- Modal -->
        <div id="adminmodal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Admin</h4>
                    </div>
                    <div class="modal-body">
                        <form action="login.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="email" class="form-control" name="aName">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="aPass">
                            </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="submit" name="adminpush" class="btn btn-primary">Login</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>