<?php
    include("../partials/header.inc.php");
?>

<div class="container-fluid d-flex justify-content-center mt-4 ">
        <h2>Update Price</h2>
    </div>
    <?php
    if(isset($_POST['submit'])) 
    {
        $sql="SELECT product_id FROM product";
        $res=mysqli_query($con,$sql);
        while($rows= mysqli_fetch_assoc($res))
        {
            $id=$rows['product_id'];
            $purchase_price=get_safe_value($con, $_POST["product_purchase_price_$id"]);
            $sales_price=get_safe_value($con, $_POST["product_sales_price_$id"]);
            $date= date("Y-m-d");

            $sqlPrice="INSERT INTO price SET 
                        effective_date='$date',
                        purchase_price='$purchase_price',
                        sales_price='$sales_price',
                        product_id='$id'";
            
            $resPrice=mysqli_query($con, $sqlPrice);
            // or die(mysqli_error($con));
            
            
            
            // echo $purchase_price."<br>";
            // echo $sales_price."<br>";
            // echo $id;
        }
        if($resPrice)
        {
            $session['price-update']=$_SESSION['update']='<div id="add" class="alert alert-info" role="alert">
            Prices Updated Successfully</div>';

            header("location:".SITEURL."sites");
        } 
        else
        {
            $_SESSION['update']='<div id="add" class="alert alert-danger" role="alert">
                    Price not updated Error</div>';

            header("location:".SITEURL."sites");
        }

    }
?>
<?php
$sn=0;
// getting product name and existing price


//
    $sql="SELECT product_id, product_name FROM product";
    $res=mysqli_query($con, $sql);

    if($res)
    {
        $count=mysqli_num_rows($res);
        if($count)
        {

?>

<div class="container">
                <table class="table table-bordered">
                    <form action="" method="POST" enctype="multipart/form-data">
                    <thead>
                        <th>S.No</th>
                        <th>Product Name</th>
                        <th>Purchase Price</th>
                        <th>Sales Price</th>
                    </thead>   
                <?php
                
                    while($rows= mysqli_fetch_assoc($res))
                    {
                        $sn++;
                        $id=$rows['product_id'];
                        $name=$rows['product_name'];
                        $sql_curr_price="SELECT purchase_price, sales_price FROM price WHERE product_id='$id' ORDER BY id DESC LIMIT 1";

                        $res_curr_price=mysqli_query($con, $sql_curr_price);
                        // or die(mysqli_error($con));
                        $rows_curr_price=mysqli_fetch_assoc($res_curr_price);
                ?>
                    <tr>
                        <td>
                            <?php echo $sn; ?>
                        </td>
                        <td>

                            <label for="name"><?php echo $name;?></label>
                        </td>
                        <td>  
                            <input type="hidden" name="id" value="<?php echo $id; ?>" required>
                            <!-- the above line contains last product id when submit is clicked because of the loop  -->
                            <input type="number" class="form-control" id="name" name="product_purchase_price_<?php echo $id;?>" placeholder="Enter Purchase Price" value="<?php echo $rows_curr_price['purchase_price']?>" required>
                        </td>
                        <td>
                            <input type="number" class="form-control" id="name" name="product_sales_price_<?php echo $id;?>" placeholder="Enter Sales Price" value="<?php echo $rows_curr_price['sales_price']?>" required>
                        </td> 
                    </tr>      
                <?php
                    }
                }
    }

?>

        <tr>
            <td colspan="4">

                <div class="container-fluid d-flex justify-content-center m-3">
                    <input type="submit" value="Update" name="submit" class="btn btn-primary"></input>
                </div>
            </td>
        </tr>
    </form>
</table>
</div>

<?php include('../partials/footer.inc.php'); ?>
