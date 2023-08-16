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
            $product_id=get_safe_value($con, $_POST['product']);
            $rate=(float)get_safe_value($con, $_POST['rate']);
            $quantity=(float)get_safe_value($con, $_POST['quantity']);
            $amount=$rate*$quantity;
            $client_id=get_safe_value($con, $_POST['client']);

            // echo($date);
            // echo("<br>");
            // echo($product_id);
            // echo("<br>");
            // echo($rate);
            // echo("<br>");
            // echo($quantity);
            // echo("<br>");
            // echo($amount);
            // echo("<br>");
            // echo($client_id);
            // die();

            // purchase bill region
            $sql="INSERT INTO purchase_bill SET
                    date='$date',
                    product_id='$product_id',
                    rate='$rate',
                    quantity='$quantity',
                    amount='$amount',
                    client_id='$client_id'
                    ";
            $res=mysqli_query($con, $sql) or die(mysqli_error($con));
            //purchase bill region ends
            
            //update Stock region
            $stock_available=$row['stock_level'];
            $stock_remaining=$stock_available+$quantity;
            $sqlUpdateStock="UPDATE stock SET stock_level='$stock_remaining' WHERE product_id='$product_id'";
            $resUpdateStock=mysqli_query($con, $sqlUpdateStock) or die(mysqli_error($con));
            //update stock region ends

            if($res && $resUpdateStock)
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
    <h2>Purchase Bill</h2>
</div>
<div class="container" id="bill_form">
    <form action="" method="POST">
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" name="date" id="date" placeholder="Enter Date">
        </div>
        <div class="form-group" >
            <label for="client">Client</label>
            
            <select class="form-control" name="client" id="client">

            </select>

        </div>
        <div class="form-group" id="panNumDiv">
            <label for="pan-number">PAN Number</label>
            <input type="text" class="form-control" id="pan_number" placeholder="Enter PAN Number">
        </div>
        <div id="error-message" style="display: none;"></div>
        <div id="success-message" style="display: none;"></div>
        <div class="row ">

            <label class="col p-2" for="particular">Select Products</label>
            <img src="../images/plus-icon.png" style="width: 65px;" class="col-1" onclick="addProductField();">
        </div>
        <div class="product-info" id="product-info">
            <div class="row border mt-1 mx-2 p-2 rounded">
                <div class="col">
                <label for="particular">Product</label>
                    <div class="form-group">                    
                        <select class="form-control" name="product" id="product">
        
                        </select>
        
                    </div>
                </div>  
                <div class="col">
                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="text" class="form-control" name="rate" id="rate" placeholder="Enter Rate">
        
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity">
                    </div>
                </div>
            </div>
        </div>

        
        
        <div class="container-fluid d-flex justify-content-center m-3">
        <input type="submit" class="btn btn-primary" name="submit">
    </div>
    </form>
    
</div>
<script src="../js/bill-client.js"></script>
<script src="../js/get-purchase-price.js"></script>
<script src="../js/add-product-field.js"></script>
<?php include('../partials/footer.inc.php'); ?>
