<?php include('../partials/header.inc.php'); ?>

    <!-- <div class="forms mt-5 pt-5"> -->
    <!-- <div> -->

        <!-- purchase bill was here -->

        <!-- sales bill was here -->

        <!-- Voucher bill was here -->

        <!-- Receipt bill was here -->

        <!-- //receipt bill -->
    <!-- </div> -->
    <?php
        if(isset($_SESSION['add'])){
        echo $_SESSION['add']; //Displaying session message
        unset($_SESSION['add']); //removing session message
        }
    ?>

    <div class="body">

        <div class="container mt-3">
            <h2 class="mt-5 pt-5">Invoices</h2>

            <div class="d-flex justify-content-around">
                <div class="row">

                    <div class="card m-3 shadow" style="width:400px">
                        <div class="card-body ">
                            <div class="row">
                                <h4 class="col-9 card-title">Purchase Bill</h4>
                            </div>
                            <a href="../forms/purchase-bill.php" class="btn btn-primary mt-3" >View
                                
                            </a>

                        </div>
                    </div>
                    <div class="card m-3 shadow" style="width:400px">
                        <div class="card-body ">
                            <div class="row">
                                <h4 class="col-9 card-title">Sales Bill</h4>
                            </div>
                            <a href="../forms/sales-bill.php" class="btn btn-primary mt-3">View
                                
                            </a>

                        </div>
                    </div>
                    <div class="card m-3 shadow " style="width:400px">
                        <div class="card-body ">
                            <div class="row">
                                <h4 class="col-9 card-title">Voucher Bill</h4>
                            </div>
                            <a href="../forms/voucher-bill.php" class="btn btn-primary mt-3" >View
                                
                            </a>

                        </div>
                    </div>

                    <div class="card m-3 shadow " style="width:400px">
                        <div class="card-body ">
                            <div class="row">
                                <h4 class="col-9 card-title">Receipt Bill</h4>
                            </div>
                            <a href="../forms/receipt-bill.php" class="btn btn-primary mt-3" >View
                                
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php include('../partials/footer.inc.php'); ?>