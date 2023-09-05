<?php
    require('../partials/header.inc.php');
    //1. get the id of admin to be deleted
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
     
        // then we will remove the food from the database

        // echo $id;
        //2. execute the query to delete
        

        $sql="DELETE FROM users WHERE uid=$id";
        $res= mysqli_query($con, $sql) or die(mysqli_error($con));

        
        if($res)
        {
            // echo "food deleted succesfully";
            // create session variable to display message
            $_SESSION['delete']='

            <div id="delete" class="alert alert-danger" role="alert">
            User Deleted Successfully
            
            </div>
            ';
            header('location:'.SITEURL.'sites/index.php');
        }
        else
        {
            // echo "category deletion unsuccessfully";
            $_SESSION['delete']='

            <div id="delete" class="alert alert-danger" role="alert">
            User Not Deleted
            
            </div>
            ';            
            header('location:'.SITEURL.'sites/index.php');

        }
    }


?>