<?php

    require('../config/connection.inc.php');
    //1. get the id of admin to be deleted
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];
        // if image file is present then we are going to remove the image file
        if($image_name!="")
        {
            $path="../images/client/".$image_name;

            $remove= unlink($path); //unlink function returns true if the file is removed

            if(!$remove)
            {
                $_SESSION['remove']='

                <div id="delete" class="alert alert-danger" role="alert">
                    Failed to remove Client
                
              </div>
              ';
              header("location:".SITEURL."forms/customer.php");
              die();
            }
        }
     
        // then we will remove the food from the database

        // echo $id;
        //2. execute the query to delete
        $sqlAddr="DELETE FROM address WHERE client_id=$id";
        $resAddr=mysqli_query($con, $sqlAddr) or die(mysqli_error($con));

        $sql="DELETE FROM client WHERE client_id=$id";
        $res= mysqli_query($con, $sql) or die(mysqli_error($con));

        
        if($res && $resAddr)
        {
            // echo "food deleted succesfully";
            // create session variable to display message
            $_SESSION['delete']='

            <div id="delete" class="alert alert-danger" role="alert">
            Client Deleted Successfully
            
            </div>
            ';
            header('location:'.SITEURL.'sites/customer.php');
        }
        else
        {
            // echo "category deletion unsuccessfully";
            $_SESSION['delete']='

            <div id="delete" class="alert alert-danger" role="alert">
            Client Not Deleted
            
            </div>
            ';            
            header('location:'.SITEURL.'sites/customer.php');

        }
    }


?>