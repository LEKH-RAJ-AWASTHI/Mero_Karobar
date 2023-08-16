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
            if($_POST['product']=="Select Product")
            {
                $product_id=0;
            }
            else
            {
                $product_id=get_safe_value($con, $_POST['product']);
            }
            $rate=(float)get_safe_value($con, $_POST['rate']);
            $quantity=(float)get_safe_value($con, $_POST['quantity']);
            $amount=$rate*$quantity;
            if($_POST['client']=="Select Client")
            {
                $client_id=0;
            }
            else
            {
                $client_id=get_safe_value($con, $_POST['client']);
            }

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

            $sql="INSERT INTO sales_bill SET
                    date='$date',
                    product_id='$product_id',
                    rate='$rate',
                    quantity='$quantity',
                    amount='$amount',
                    client_id='$client_id'
                    ";
            $sql="SELECT stock_level FROM stock WHERE product_id='$product_id'";
            $res=mysqli_query($con, $sql) or die(mysqli_error($con));
            $row=mysqli_fetch_assoc($res);
            $stock_available=$row['stock_level'];
            $stock_remaining=$stock_available-$quantity;
            $sqlUpdateStock="UPDATE stock SET stock_level='$stock_remaining' WHERE product_id='$product_id'";
            $resUpdateStock=mysqli_query($con, $sqlUpdateStock) or die(mysqli_error($con));
            $res=mysqli_query($con, $sql) or die(mysqli_error($con));
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
    <h2>Sales Bill</h2>
</div>
<div class="container">
    <form action="" method="POST">
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" name="date" id="date" placeholder="Enter Date">
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
            <label for="particular">product</label>
            
            <select class="form-control" name="product" id="product">

            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity">

        </div>
        <div class="form-group" id="rateDiv">
            <label for="rate">Rate</label>
            <input type="text" class="form-control" id="rate" name="rate" placeholder="Enter Rate">

        </div>
        <!-- my unsuccesfull attempt to make rate input field hidden until the product is selected -->
        <!-- <script type="text/javascript">

            var selectProduct=document.getElementById("product");
            var rateDiv=document.getElementById("rateDiv");
            rateDiv.style.display="none";
            selectProduct.setAttribute('onchange', 'changeRateDisplay()');
            function changeRateDisplay()
            {
                console.log("Hello world")
                if(selectProduct.value==="")
                {
                    rateDiv.style.display="none";
                }
                else
                {
                    rateDiv.style.display="block";
                }
            }
        </script> -->
        <div class="container-fluid d-flex justify-content-center m-3">
        <input type="submit" name="submit" class="btn btn-primary">
    </div>
    </form>
</div>
<script src="../js/bill-client.js"></script>
<script src="../js/get-sales-price.js"></script>
<?php include('../partials/footer.inc.php'); ?>
