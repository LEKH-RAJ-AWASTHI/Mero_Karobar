<?php
    include("../partials/header.inc.php");
    
?>
<?php
 if(isset($_SESSION['add']))
 {
    echo $_SESSION['add'];
    unset($_SESSION['add']);
 }
 ?>
 <?php 
   //updating price of product\
   if(isset($_POST['submit']))
   {
        $product_name=get_safe_value($con,$_POST['product_name']);
        $purchase_price=get_safe_value($con, $_POST['purchase_price']);
        $sales_price=get_safe_value($con, $_POST['sales_price']);
        $stock=get_safe_value($con, $_POST['stock']);
        $date=date("Y-m-d H:i:s");

        // echo $product_name."<br>";
        // echo $purchase_price."<br>";
        // echo $sales_price."<br>";
        // echo $date."<br>";
        // die();
    

        $sql="INSERT INTO product (product_name) VALUES('$product_name')";
        $res=mysqli_query($con,$sql) or die(mysqli_error($con));
        if($res)
        {
            $product_id=mysqli_insert_id($con);
            $sqlPrice="INSERT INTO price SET
                        product_id='$product_id',
                        purchase_price='$purchase_price',
                        sales_price='$sales_price',
                        effective_date='$date'";
            $resPrice=mysqli_query($con, $sqlPrice);
            if($resPrice)
            {
                $sqlStock="INSERT INTO stock SET 
                            stock_level ='$stock',
                            product_id='$product_id'";
                $resStock=mysqli_query($con, $sqlStock);
                if($resStock)
                {
                    $_SESSION['add']='
                
                    <div id="add" class="alert alert-success" role="alert">
                    Product Added Successfully
                    
                    </div>
                    ';
                    header("location:".SITEURL."sites/product.php");
                }
                else
                {
                    $_SESSION['add']='
                    
                    <div id="add" class="alert alert-danger" role="alert">
                    Product Addition Failed
                    
                    </div>
                    ';  
                    header("location:".SITEURL."forms/add-product.php");
                    die();

                }
            }
        }
    }
?>

<div class="container-fluid d-flex justify-content-center mt-4 ">
        <h2>Add Product</h2>
    </div>

<div class="container border border-warning border-3 rounded p-5 my-3 mb-5">

    <form action="" method="POST">
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name">
        </div>
        <div class="form-group">
            <label for="purchase_price">Purchase Price</label>
            <input type="text" class="form-control" id="purchase_price" name="purchase_price" placeholder="Enter Product purchase price">
        </div>
        <div class="form-group">
            <label for="sales_price">Sales Price</label>
            <input type="text" class="form-control" id="product_name" name="sales_price" placeholder="Enter Product sales price">
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="text" class="form-control" id="stock" name="stock" placeholder="Enter Stock Available in KG">
        </div>
        <div class="container-fluid d-flex justify-content-center m-3">
            <input type="submit" value="Add Product" name="submit" class="btn btn-primary"></input>
        </div>
    </form>
</div>



<?php include('../partials/footer.inc.php'); ?>
