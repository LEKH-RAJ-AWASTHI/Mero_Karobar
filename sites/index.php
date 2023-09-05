<?php include('../partials/header.inc.php'); ?>
<?php
if (isset($_SESSION['update'])) {
    echo $_SESSION['update']; //Displaying session message
    unset($_SESSION['update']); //removing session message
}
if (isset($_SESSION['add'])) {
    echo $_SESSION['add']; //Displaying session message
    unset($_SESSION['add']); //removing session message
}
if (isset($_SESSION['delete'])) {
    echo $_SESSION['delete']; //Displaying session message
    unset($_SESSION['delete']); //removing session message
}
if (isset($_SESSION['update'])) {
    echo $_SESSION['update']; //Displaying session message
    unset($_SESSION['update']); //removing session message
}
if (isset($_SESSION['login'])) {
    echo $_SESSION['login']; //Displaying session message
    unset($_SESSION['login']); //removing session message
}



?>
<div class="body">
<?php
$privilege = $_SESSION['privilege'];
if ($privilege == 'superadmin') {
    // Display the div for superadmin
    echo '<div style="width: 100%" class="clearfix">
              <div class=" float-end m-2">
                  <a href="../forms/manage-user.php" class="btn btn-primary">Manage User</a>
              </div>
          </div>';
} else {
    // Display the div for other users with a change password button
    echo '<div style="width: 100%" class="clearfix">
              <div class=" float-end m-2">
                  <a href="../forms/change-user-pwd.php?id='.$_SESSION['id'].'" class="btn btn-primary">Change Password</a>
              </div>
          </div>';
}
?>

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
                            <p class=" col-3 fs-3 text-right">
                                <?php
                                $sql = "SELECT client_id FROM client";
                                $res = mysqli_query($con, $sql);
                                // pr($res);
                                $count = mysqli_num_rows($res);
                                echo $count;
                                ?>
                            </p>
                        </div>
                        <a href="customer.php" class="btn btn-primary">View

                        </a>

                    </div>
                </div>
                <div class="card m-3 shadow" style="width:400px">
                    <div class="card-body ">
                        <div class="row">
                            <h4 class="col-9 card-title">Products</h4>
                            <p class=" col-3 fs-3 text-right">                       <?php 
                        $sql= "SELECT product_id FROM product";
                        $res=mysqli_query($con, $sql);
                        // pr($res);
                        $count=mysqli_num_rows($res);
                        echo $count;
                        ?></p>
                        </div>
                        <a href="product.php" class="btn btn-primary">View

                        </a>

                    </div>
                </div>
                <div class="card m-3 shadow bg-primary" style="width:400px">
                    <div class="card-body ">
                        <div class="row">
                        <h4 class="col-9 card-title text-white">Transactions</h4>

                        <p class=" col-3 fs-3 text-right text-white">                       <?php 
                        $sql1= "SELECT purchase_id FROM purchase_bill";
                        $sql2= "SELECT sales_id FROM sales_bill";
                        $sql3= "Select receipt_id from receipt_bill";
                        $sql4= "Select voucher_id from voucher_bill";
                        $res1=mysqli_query($con, $sql1);
                        $res2=mysqli_query($con, $sql2);
                        $res3=mysqli_query($con, $sql3);
                        $res4=mysqli_query($con, $sql4);
                        $count=0;
                        // pr($res);
                        $count+=mysqli_num_rows($res1);
                        $count+=mysqli_num_rows($res2);
                        $count+=mysqli_num_rows($res3);
                        $count+=mysqli_num_rows($res4);
                        echo $count;


                        
                        
                        ?></p>
                        </div>
                        <a href="transaction.php" class="btn btn-info mt-3">View

                        </a>

                    </div>
                </div>

                <div class="card m-3 shadow bg-primary" style="width:400px">
                    <div class="card-body ">
                        <div class="row">
                            <h4 class="col-9 card-title text-white">Invoices (Bill)</h4>
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