<?php
    include('../config/connection.inc.php'); 
    include('../config/functions.inc.php');
    //  include('login-check.inc.php');
?>

<!DOCTYPE html>
<html>

<head>

    <title>My Website</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-grid.css">
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/province-state.js"></script>
   </head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo SITEURL;?>sites/index.php">Mero Karobar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITEURL;?>sites/invoices.php">Invoices</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITEURL;?>sites/transaction.php">Transaction</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITEURL;?>sites/stock.php">Stock</a>
                        </li>
                    </ul>
                    <a href="../forms/update-price.php"  class="btn btn-secondary" > Update Price</a>
                </div>
            </div>
        </nav>
    </header>

