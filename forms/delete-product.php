<?php

    require('../config/connection.inc.php');
    //1. get the id of admin to be deleted
    $id=$_GET['id'];
    // echo $id;
    //2. execute the query to delete
    $sqlPrice="DELETE FROM price WHERE product_id=$id";
    $sql="DELETE FROM product WHERE product_id=$id";
    $resPrice=mysqli_query($con, $sqlPrice);
    $res= mysqli_query($con, $sql);
    if($res && $resPrice){
        // echo "admin deleted succesfully";
        // create session variable to display message
        $_SESSION['delete']='

        <div id="delete" class="alert alert-danger" role="alert">
        Data Deleted Successfully
        
      </div>
      ';
      header('location:'.SITEURL.'sites/product.php');
    }
    else{
        // echo "admin deletion unsuccessfully";
        $_SESSION['delete']='Product Deletion failed';
        header('location:'.SITEURL.'sites/product.php');

    }

?>