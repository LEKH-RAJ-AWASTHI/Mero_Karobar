<?php
    include("../partials/header.inc.php");
    
?>

<div class="container-fluid d-flex justify-content-center mt-4 ">
        <h2>Update Price</h2>
    </div>

<?php
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
            <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group container">
            
                <?php
                    while($rows= mysqli_fetch_assoc($res))
                    {
                        $id=$rows['product_id'];
                        $name=$rows['product_name'];
                ?>
                    <div class="row">
                        <div class="col-1 pt-2">
                            <label for="name">Name</label>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" id="name" name="name" placeholder="Enter Price">
                        </div>
                    </div>
                <?php
                    }
                }
    }

?>
            </div>
        
        <div class="container-fluid d-flex justify-content-center m-3">
            <input type="submit" value="Update" name="submit" class="btn btn-primary"></input>
        </div>
    </form>
</div>

<?php 
   //updating price of product
?>

<?php include('../partials/footer.inc.php'); ?>
