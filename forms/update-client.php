<?php
    include("../partials/header.inc.php");
?>

<div class="container-fluid d-flex justify-content-center mt-4 ">
        <h2>Update Client</h2>
    </div>
    <?php
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];
        
        // echo($id);
        // echo($image_name);
        // die();

        //running query to select existing data from database
        $sql="SELECT * FROM client WHERE client_id='$id'";
        $sqlAddr="SELECT * FROM address WHERE client_id='$id'";

        $res=mysqli_query($con, $sql);
        $resAddr=mysqli_query($con, $sqlAddr);

        if($res && $resAddr)
        {
            $count= mysqli_num_rows($res);
           

            if($count==1)
            {
                $row=mysqli_fetch_assoc($res);
                $rowAddr=mysqli_fetch_assoc($resAddr);

                $name=$row['name'];
                $firm_name=$row['firm_name'];
                $pan_number=$row['pan_number'];
                $email=$row['email'];
                $phone_number=$row['phone_number'];
                $province=$rowAddr['province'];
                $district=$rowAddr['district'];
                $city=$rowAddr['city'];
                $curr_image=$row['client_img'];
            }
            // echo($name);
            // echo($firm_name);
            // echo($pan_number);
            // echo($email);
            // echo($phone_number);
            // echo($province);
            // echo($district);
            // echo($city);
            // echo($curr_image);
            // die();

            else
            {
                $_SESSION['client-not-exist']=
                '<div id="add" class="alert alert-danger" role="alert">
                Client Not found.
                </div>';
                header('location:'.SITEURL.'sites/customer.php');
            }
        }
        else
        {
            $_SESSION['client-not-exist']=
                '<div id="add" class="alert alert-danger" role="alert">
                Client Not found.
                </div>';
                header('location:'.SITEURL.'sites/customer.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'sites/customer.php');

    }

    ?>
<?php 
   //updating price of product\
   if(isset($_POST['submit']))
   {
        $id=get_safe_value($con, $_POST['id']);
        $name=get_safe_value($con, $_POST['name']);
        $firm_name=get_safe_value($con, $_POST['firm_name']);
        $province=get_safe_value($con, $_POST['province']);
        $district=get_safe_value($con, $_POST['district']);
        $city=get_safe_value($con, $_POST['city']);
        $pan_number=get_safe_value($con, $_POST['pan_number']);
        $email=get_safe_value($con, $_POST['email']);
        $phone_number=get_safe_value($con, $_POST['phone_number']);
        $image_name=get_safe_value($con, $_POST['image']);


        if(isset($_FILES['image']['name']))
        {
            $image_name=$_FILES['image']['name'];
            if($image_name!='')
            {
                $ext=pathinfo($image_name, PATHINFO_EXTENSION);
                $image_name="client_".time().".".$ext;
                $source_path=$_FILES['image']['tmp_name'];
                $destination_path='../images/client/'.$image_name;
                // upload image
                $upload=move_uploaded_file($source_path, $destination_path);

                if(!$upload)
                {
                    $_SESSION['upload']=
                    '<div id="add" class="alert alert-danger" role="alert">
                    Failed to upload image.
                    </div>';
                    header("location:".SITEURL."admin/manage-food.php");
                    die();
                }
                
                if($curr_image!='')
                {
                    $path="../images/client".$curr_image;
                    $remove= unlink($path);

                    if(!$remove)
                    {
                        $_SESSION['remove']='
    
                        <div id="delete" class="alert alert-danger" role="alert">
                            Failed to remove food
                        
                        </div>
                        ';
                        header("location:".SITEURL."admin/manage-food.php");
                        die();
                    }
                }
            }

            else
            {
                $image_name=$curr_image; // when button is clicked but image is not selected
            }
        }
        else
        {
            $form_image_name=$curr_image; //when button is clicked
        }

        //sql query to insert value

        $sql="UPDATE client SET 
        name='$name',
        firm_name='$firm_name',
        pan_number='$pan_number',
        email='$email',
        phone_number='$phone_number',
        client_img='$image_name'
        WHERE client_id='$id'";

        $sqlAddr="UPDATE address SET 
        province='$province',
        district='$district',
        city='$city'
        WHERE client_id='$id'";


        $res= mysqli_query($con, $sql) or die(mysqli_error($con));
        $resAddr= mysqli_query($con, $sqlAddr) or die(mysqli_error($con));

        if($res && $resAddr)
        {
            $_SESSION['update']='<div id="add" class="alert alert-info" role="alert">
                        Data Updated Successfully</div>';

            header("location:".SITEURL."sites/customer.php");
        }
        else
        {
            $_SESSION['update']="Failed to update";
            header("location:".SITEURL."forms/update-client.php");

        }
   }
?>

<div class="container border border-warning border-3 rounded p-5 my-3">

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name;?>"  placeholder="Enter Name">
        </div>
        <div class="form-group">
            <label for="firm">Firm Name</label>
            <input type="text" class="form-control" id="firm" name="firm_name" value="<?php echo $firm_name;?>"  placeholder="Enter Name">
        </div>
        <label for="address">Address</label>"
        <div class="row border m-2 p-2 rounded">
            <div class="col">

    
                <label for="state" class="form-label">Province:</label>
                <input class="form-control" list="states" name="province" value="<?php echo $province;?>" id="state" oninput="populateDistricts()">
                <datalist id="states">
                    <option value="">Select a state</option>
                    <option value="Koshi"></option>
                    <option value="Madhesh"></option>
                    <option value="Bagmati"></option>
                    <option value="Gandaki"></option>
                    <option value="Lumbini"></option>
                    <option value="Karnali"></option>
                    <option value="Sudurpaschim"></option>
                </datalist>
            </div>
    
            <div class="col">
    
                <label for="district" class="form-label">District:</label>
                <input class="form-control" list="districts" name="district" value="<?php echo $district;?>" id="district">
                <datalist id="districts">
                    <option value="">Select a district</option>
    
                </datalist>
            </div>
            <div class="col">
                <label for="city" class="form-label">City:</label>
                <input class="form-control" name="city" value="<?php echo $city;?>" id="city">
            </div>
        </div>
        <div class="form-group">
            <label for="PAN-Number">PAN-Number</label>
            <input type="text" class="form-control" id="PAN-Number" name="pan_number" value="<?php echo $pan_number;?>"  placeholder="Enter PAN-Number">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email;?>"  placeholder="Enter Email">
    
        </div>
        <div class="form-group">
            <label for="phone-number">Phone-Number</label>
            <input type="text" class="form-control" id="phone-number" name="phone_number" value="<?php echo $phone_number;?>"  placeholder="Enter phone-number">
    
        </div>

        <div class="form-group">
            <label for="current-image">Current Image:</label>
            <!-- Image will be displayed here -->
            <?php
                if($image_name==$curr_image)
                {
                    if($curr_image!='')
                    {
                        ?>
                        <img src="<?php echo SITEURL;?>images/client/<?php echo $curr_image;?>" style="border-radius:50%; margin:2%;"  width="200px" alt="Image">
                        <?php
                    }
                    else
                    {
                        echo '<p style="color:red;">Image not Added </p>';
                    }
                }
                else
                {
                    $_SESSION['food-not-exist']=
                    '<div id="add" class="alert alert-danger" role="alert">
                    Image changed.
                    </div>';
                    header('location:'.SITEURL.'sites/customer.php');
        
                }
            ?>
        </div>

        <div class="form-group">

            <label for="image">Select Image</label>

            <input type="file" id="image" name="image" accept="image/*" class="form-control" >
    
        </div>

        <div class="container-fluid d-flex justify-content-center m-3">
            <input type="submit" class="btn btn-primary" value="Update client" name="submit">
        </div>
    </form>
</div>
<?php include('../partials/footer.inc.php'); ?>
