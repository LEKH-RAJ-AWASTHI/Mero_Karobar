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

<div class="container-fluid d-flex justify-content-center mt-4 ">
        <h2>Add Product</h2>
    </div>

<div class="container border border-warning border-3 rounded p-5 my-3">

    <form action="" method="POST">
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name">
        </div>
        
        <div class="container-fluid d-flex justify-content-center m-3">
            <input type="submit" value="Add Product" name="submit" class="btn btn-primary"></input>
        </div>
    </form>
</div>

<?php 
   //updating price of product\
   if(isset($_POST['submit']))
   {
        $product_name=get_safe_value($con,$_POST['product_name']);
        // echo($product_name);
        // die();
    

        $sql="INSERT INTO product (product_name) VALUES('$product_name')";
        $res=mysqli_query($con,$sql) or die(mysqli_error());

        if($res)
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

        }
        
    }
?>

<?php include('../partials/footer.inc.php'); ?>
