<?php
    include("../partials/header.inc.php");
?>

<div class="container-fluid d-flex justify-content-center mt-4 ">
        <h2>Stock Level</h2>
    </div>
    <?php

?>
<?php
    $sn=0;
    // getting product name and existing price
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
                        <th>Stock Level</th>
                    </thead>   
                <?php
                    while($rows= mysqli_fetch_assoc($res))
                    {
                        $sn++;
                        $id=$rows['product_id'];
                        $name=$rows['product_name'];
                        $sql_stock="SELECT stock_level FROM stock WHERE product_id='$id'";

                        $res_stock=mysqli_query($con, $sql_stock) or die(mysqli_error($con));
                        // or die(mysqli_error($con));
                        $rows_stock=mysqli_fetch_assoc($res_stock);
                ?>
                    <tr>
                        <td>
                            <?php echo $sn; ?>
                        </td>
                        <td>

                            <label for="name"><?php echo $name;?></label>
                        </td>
                        <td>  
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <!-- the above line contains last product id when submit is clicked because of the loop  -->
                            <label for=""><?php echo $rows_stock['stock_level'] ?></label>
                        </td>
                    </tr>      
                <?php
                    }
                }
    }

?>
    </form>
</table>
</div>

<?php include('../partials/footer.inc.php'); ?>
