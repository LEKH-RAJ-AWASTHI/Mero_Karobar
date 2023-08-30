
<?php include('../partials/header.inc.php'); ?>
<?php
    if(isset($_SESSION['update'])){
        echo $_SESSION['update']; //Displaying session message
        unset($_SESSION['update']); //removing session message
      }
    if(isset($_SESSION['add'])){
        echo $_SESSION['add']; //Displaying session message
        unset($_SESSION['add']); //removing session message
      }
    if(isset($_SESSION['update'])){
        echo $_SESSION['update']; //Displaying session message
        unset($_SESSION['update']); //removing session message
      }
    if(isset($_SESSION['update'])){
        echo $_SESSION['update']; //Displaying session message
        unset($_SESSION['update']); //removing session message
      }
    if(isset($_SESSION['login'])){
        echo $_SESSION['login']; //Displaying session message
        unset($_SESSION['login']); //removing session message
      }
      
      
      
?>
        <div class="body">
            <div style="width: 100%" class="clearfix">
                <div class=" float-end m-2">
                    <a href="../forms/add-user.php" class="btn btn-primary">Add User</a>
                </div>
            </div>
            
        </div>
    <div class="body mb-5">
        <div class="container mt-3">
            <h2 class="mt-5 pt-5">Dashboard</h2>

            <div class="d-flex justify-content-around">
                <div class="row">

                    <div class="card m-3 shadow" style="width:400px">
                        <div class="card-body ">
                            <div class="row">
                                <h4 class="col-9 card-title">Client</h4>
                                <p class=" col-3 fs-3 text-right">500</p>
                            </div>
                            <a href="customer.php" class="btn btn-primary">View
                                
                            </a>

                        </div>
                    </div>
                    <div class="card m-3 shadow" style="width:400px">
                        <div class="card-body ">
                            <div class="row">
                                <h4 class="col-9 card-title">Products</h4>
                                <p class=" col-3 fs-3 text-right">50</p>
                            </div>
                            <a href="product.php" class="btn btn-primary">View
                                
                            </a>

                        </div>
                    </div>
                    <div class="card m-3 shadow bg-primary" style="width:400px">
                        <div class="card-body ">
                            <div class="row">
                                <h4 class="col-9 card-title">Transaction</h4>
                            </div>
                            <a href="transaction.php" class="btn btn-info mt-3">View
                                
                            </a>

                        </div>
                    </div>

                    <div class="card m-3 shadow bg-primary" style="width:400px">
                        <div class="card-body ">
                            <div class="row">
                                <h4 class="col-9 card-title">Invoices (Bill)</h4>
                            </div>
                            <a href="invoices.php" class="btn btn-info mt-3">View
                                
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php include('../partials/footer.inc.php'); ?>