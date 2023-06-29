<?php include('../partials/header.inc.php'); ?>


<?php
if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
if(isset($_SESSION['delete']))
{
    echo $_SESSION['delete'];//Displaying session message
    unset($_SESSION['delete']);// removing session message
}
?>
<br>
    <!-- Bootstrap Modal Form was here-->



    <div class="container-fluid d-flex justify-content-center mt-4 ">
        <h2>Product Page</h2>
    </div>
    <div class="container my-2">
        <div class="buttons" style="width: 300px;">
            <div class="d-grid">
                <a href="<?php echo SITEURL; ?>forms/add-product.php" class="btn btn-primary mt-3">Add Product

                </a>
            </div>
            <br>
        </div>
    </div>

    <?php //search button ?>
    <!-- <div class="container">
        <div class="container search-box pb-3 fs-5">

            <input style="width: 800px" class="p-2" type="search" name="" id="">
            <button class="p-2 px-5" type="submit">Search</button>
        </div> -->
        <div class="container">


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Product Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql="SELECT * FROM product";
                    $res=mysqli_query($con, $sql);
                    if($res)
                    {
                        $count=mysqli_num_rows($res);
                        if($count>0)
                        {
                            $sn=1;
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                $product_id= $rows['product_id'];
                                $product_name=$rows['product_name'];
                          
                    ?>

                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $product_name ?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>forms/delete-product.php?id=<?php echo $product_id?>" type="button" class="btn btn-danger btn-block"> Delete</a>
                        </td>
                    </tr>
                    <?php
                      }
                    }
                }
                ?>
                </tbody>
            </table>
        </div>


<?php include('../partials/footer.inc.php'); ?>  