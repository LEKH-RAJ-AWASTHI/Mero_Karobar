<?php
    include("../partials/header.inc.php");
?>
<?php
    if(isset($_POST['submit']))
    {
        if (!empty($_POST['date'])) {
            $date = get_safe_value($con, $_POST['date']);
        } else {
            $date = date("Y-m-d");
        }
        $client_id=get_safe_value($con, $_POST['client']);
        $particular=get_safe_value($con, $_POST['particular']);
        $amount=get_safe_value($con, $_POST['amount']);

        $sql="INSERT INTO voucher_bill SET
                date='$date',
                client_id='$client_id',
                particular='$particular',
                amount='$amount'
                ";
        $res=mysqli_query($con, $sql) or die(mysqli_error($con)." of insert voucher bill");
        
        if($res)
        {
            $_SESSION['add']='
        
            <div id="add" class="alert alert-success" role="alert">
            Transaction added successfully
            
            </div>';
            header("location:".SITEURL."sites/invoices.php");
        }

        else
        {
            $_SESSION['add']="Failed to add transaction";
            header("location:".SITEURL."sites/invoices.php");
        }
    }
?>
<div class="container-fluid d-flex justify-content-center mt-4 ">
    <h2>Voucher Bill</h2>
</div>
<div class="container">
    <form action="" method="POST">
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" placeholder="Enter Date">
        </div>
        <div class="form-group" >
            <label for="particular">Client</label>
            
            <select class="form-control" name="client" id="client">

            </select>

        </div>
        <div class="form-group" id="panNumDiv">
            <label for="pan-number">PAN Number</label>
            <input type="text" class="form-control" id="pan_number" placeholder="Enter PAN Number">
        </div>
         <div id="error-message" style="display: none;"></div>
        <div id="success-message" style="display: none;"></div>

        <div class="form-group">
            <label for="particular">Particular</label>
            <textarea class="form-control" name="particular" id="particular" rows="3" placeholder="Enter particular"></textarea>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input class="form-control" type="number" name="amount" id="amount" placeholder="Enter Amount"></input>
        </div>
        <div class="container-fluid d-flex justify-content-center m-3">
            <input type="submit" name="submit" class="btn btn-primary">
        </div>
    </form>
</div>
<script src="../js/bill-client.js"></script>

<?php include('../partials/footer.inc.php'); ?>
